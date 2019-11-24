<?php
namespace app\index\Controller;

use think\Controller;
use think\Loader;
use think\Request;
use think\Session;

class Diary extends Controller
{
    public function isLogin(){
        if(Session::get('user_id')!=null)
            return true;
        else
            return false;
    }
    public function showEdit(){
        if($this->isLogin()){
            return $this->fetch('diary/diary_edit');
        }else
            return $this->fetch('user/user_login');
    }
    public function searchDiaries($place){
        $diary = Loader::model('Diary');
        $diaries = $diary::where('place','like','%'.$place.'%')->with(["UserInfo"=>function($query){
            $query->field(['id','name']);
        }])->field(['id','title','place','create','author','general'])->paginate(8);
        $page = $diaries->render();
        return $this->fetch('diary/diary_all',[
            'diaries' => $diaries,
            'page' => $page
        ]);
    }
    public function diaries(){
        $diary = Loader::model('Diary');
        $diaries = $diary::with(["UserInfo"=>function($query){
          $query->field(['id','name']);
        }])->field(['id','title','place','create','author','general'])->paginate(8);
        $page = $diaries->render();
        return $this->fetch('diary/diary_all',[
            'diaries' => $diaries,
            'page' => $page
        ]);
    }
    public function getDiary(Request $request){
        $data = $request->post();
        $content = $data['content'];
        $tmp = strstr($content,"</p>",true);
        while(strpos($tmp,"<img")){
            $tmp = preg_replace("/<img\b.*?(?:\>|\/>)/i","",$tmp);
        }
        if(strlen($tmp)>153){
            $general = mb_substr($tmp,3,150,'utf-8');
        }else{
            $general = mb_substr($tmp,3,'utf-8');
        }
        $author = Session::get('user_id');
        $diary = Loader::model('Diary');
        $res = $diary->save([
            'title' => $data['title'],
            'place' => $data['place'],
            'author' => $author,
            'general' => $general,
            'content' => $content
        ]);
        if($res==0)
            return false;
        else
            return true;
    }
    public function showDiary($id){
        $diary = Loader::model('Diary');
        $data = $diary::where('id',$id)->with(["UserInfo"=>function($query){
            $query->field(['id','name']);
        }])->field(['id','title','place','create','author','content'])->find();
        $this->assign('diary',$data);
        return $this->fetch('diary/diary_detail');
    }
}