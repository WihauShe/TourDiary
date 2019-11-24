<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Loader;

use app\admin\model\User;
use app\admin\model\UserInfo;
use app\admin\model\Diary;

class Index extends Controller
{
	public function index(Request $request){
        $userId = Session::get("user_id");
        $authority = User::where('id',$userId)->value('authority');
        if($authority==0)
            return $this->fetch('404');
        $res = UserInfo::get($userId);
        $result = $res->toArray();
        $this->assign([
            'username' => $result['name'],
            'usersex' => $res->sex,
            'userage' => $result['age'],
            'usermood'=> $result['mood']
        ]);
        //读取所有用户
        $users = User::with(["UserInfo" =>function($UserInfo){
            $UserInfo->field(['id','name']);
        }])->field(['id','account','forbid'])->paginate(6,false,[
            'var_page' => 'page1'
		]);
        $page1 = $users->render();
        //读取所有上传日记
        $diaries = Diary::with(["UserInfo"=>function($query){
            $query->field(['id','name']);
        }])->field(['id','title','create','author','general'])->paginate(4,false,[
            'var_page' => 'page2'
        ]);
        $page2 = $diaries->render();
        if($request->get('page1')!=null)
            $this->assign('goPage',1);
        if($request->get('page2')!=null)
            $this->assign('goPage',2);
		return $this->fetch('index',[
            'users' => $users,
            'page1' => $page1,
            'diaries' => $diaries,
            'page2' => $page2
        ]);
	}

	public function userForbid($id){
	    $res = User::where('id',$id)->update([
	        'forbid' => 1
        ]);
	    if($res==0)
	        return false;
	    return true;
    }

    public function userDelete($id){
        $res = User::destroy($id);
        if($res==0)
            return false;
        return true;
    }

    public function diaryDelete($id){
	    $res = Diary::where('id',$id)->delete();
	    if($res==0)
	        return false;
	    return true;
    }
}