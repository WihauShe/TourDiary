<?php
namespace app\admin\Model;

use think\Model;
use traits\model\SoftDelete;

class User extends Model
{
    use SoftDelete;

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