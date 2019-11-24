<?php
namespace app\admin\Model;

use think\Model;

class UserInfo extends Model
{
    public function getSexAttr($val){
        switch ($val){
            case 0:return "未知";
            case 1:return "男";
            case 2:return "女";
            default : break;
        }
    }

    public function User(){
        return $this->belongsTo("User",'id','id');
    }
    public function diary(){
        return $this->hasMany('Diary','author','id');
    }
}