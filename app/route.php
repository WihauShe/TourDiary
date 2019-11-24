<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    'index' => 'index/Index/index',
    'diaries'=> 'index/Diary/diaries',
    'search' => 'index/Diary/searchDiaries',
    'showDiary' => 'index/Diary/showDiary',
    'isLogin' => 'index/Diary/isLogin',
    'showEdit' => 'index/Diary/showEdit',
    'showLogin' => 'index/Index/showLogin',
    'showRegister' => 'index/Index/showRegister',

    'isValid' => 'index/User/isValid',
    'userRegister' => 'index/User/register',
    'userLogin' => 'index/User/login',

    'isAdmin' => 'index/User/isAdmin',
    'personal' => 'index/User/person',
    'updateUser' => 'index/User/updatePerson',
    'changePass' => 'index/User/changePass',
    'uploadDiary' => 'index/Diary/getDiary',


    'adminIndex' => 'admin/Index/index',
    'forbid' => 'admin/Index/userForbid',
    'deluser' => 'admin/Index/userDelete',
    'delDiary' => 'admin/Index/diaryDelete',
    'logout' => 'index/User/logout'
];
