<?php

namespace  app\index\Controller;

use think\Controller;
use think\Validate;
use think\Request;
use think\Loader;
use think\Session;
use think\Cookie;

use app\index\model\UserInfo;


class User extends  Controller
{
    public function isValid($userAccount){
        $user = Loader::model('User');
        $res = $user::where("account",$userAccount)->count();
        if($res==0)
            return true;
        return false;
    }
    public function register(Request $request){
        $data = $request->post();
        $id = uniqid();
        $user = Loader::model('User');
        $user->data([
            'id' => $id,
            'account' => $data['userAccount'],
        ]);
        $user->password = $data['userPass'];
        $res1 = $user->save();
        $userInfo = new UserInfo;
        $userInfo->data([
            'id' => $id,
            'name' => $data['userName'],
            'sex' => $data['userSex'],
            'age' => $data['userAge']
        ]);
        $res2 = $userInfo->save();
        $res = $res1&&$res2;
        return $res;
    }
    public function login(Request $request){
        $data = $request->post();
        $user = Loader::model('User');

        if(Validate::token('__token__','',['__token__'=>$data['__token__']])){
            if(Session::get('user_id')!=null){
                $ret = [
                    'status' => 5,
                    'token' => $request->token()
                ];
                return $ret;
            }
            $res1 = $user::where('account', $data['userAccount'])->find();
            if($res1['delete_time']!=null){
                $ret = [
                    'status' => 4,
                    'token' => $request->token()
                ];
                return $ret;
            }
            if($res1['forbid']==1){
                $ret = [
                    'status' => 3,
                    'token' => $request->token()
                ];
                return $ret;
            }
            $userpass = md5($data['userPass']);
            if($userpass==$res1['password']){
                Session::set('user_id',$res1['id']);
                $res2 = UserInfo::where("id",$res1['id'])->find();
                Cookie::set('username',$res2['name']);
                $ret = [
                    'status' => 1
                ];
                return $ret;
            }else{
                $ret = [
                    'status' => 2,
                    'token' => $request->token()
                ];
                return $ret;
            }
        }else{
            $ret = [
                'status' => 0,
                'token' => $request->token()
            ];
            return $ret;
        }
    }
    public function isAdmin(){
        $userId = Session::get("user_id");
        $user = Loader::model('User');
        $authority = $user::where("id",$userId)->value('authority');
        if($authority==1)
            return true;
        else
            return false;
    }
    public function person(Request $request){
        $userId = Session::get("user_id");
        $res = UserInfo::get($userId);
        $result = $res->toArray();
        $this->assign([
            'username' => $result['name'],
            'usersex' => $res->sex,
            'userage' => $result['age'],
            'usermood'=> $result['mood']
        ]);
        $diary = Loader::model('Diary');
        $diaries = $diary::where('author',$userId)->field(['id','title','place','create','general'])->paginate(4);
        $page = $diaries->render();
        if($request->get('page')!=null)
            $this->assign('goPage',true);
        return $this->fetch('user/user_person',[
            'diaries' => $diaries,
            'page' => $page,
        ]);
    }
    public function updatePerson(Request $request){
        $data = $request->post();
        $userId = Session::get("user_id");
        $res = UserInfo::where("id",$userId)->update([
            'name' => $data['userName'],
            'sex' => $data['userSex'],
            'age' => $data['userAge'],
            'mood' => $data['userMood']
        ]);
        if($res==0)
            return false;
        return true;
    }
    public function changePass($newPass){
        $userId = Session::get("user_id");
        $user = Loader::model('User');
        $res = $user->save([
            'password' => $newPass
        ],['id'=> $userId]);
        if($res==0)
            return false;
        return true;
    }
    public function deleteDiary($id){

    }
    public function logout(){
        Session::delete("user_id");
        Cookie::delete("username");
        return $this->fetch('index/index');
    }

}