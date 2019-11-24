<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Index extends Controller
{
    public function index(){

        return $this->fetch('index');
    }
    public function showLogin(){
        return $this->fetch('user/user_login');
    }
    public function showRegister(){
        return $this->fetch('user/user_register');
    }

}
