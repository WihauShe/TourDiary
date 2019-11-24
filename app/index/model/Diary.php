<?php
namespace app\index\Model;

use think\Model;

class Diary extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    protected $createTime = 'create';
    protected $updateTime = 'update';

    public function userInfo(){
        return $this->belongsTo('UserInfo','author','id');
    }

    public function user(){
        return $this->belongsTo('User','author','id');
    }

}