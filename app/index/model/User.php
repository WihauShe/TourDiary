<?php
namespace app\index\Model;

use think\Model;

class User extends Model
{

    public function setPasswordAttr($val){
        return md5($val);
    }

    public function UserInfo(){
        return $this->hasOne('UserInfo','id','id');
    }
    public function diary(){
        return $this->hasMany('Diary','author','id');
    }
}