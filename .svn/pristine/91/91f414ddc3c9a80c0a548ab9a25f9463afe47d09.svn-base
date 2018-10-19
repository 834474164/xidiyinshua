<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function hook($name = '',$param = [])
{
    think\facade\Hook::listen($name,$params);
}


// 账号密码加密

function encrypt($password,$salt)
{
    $encrypt_password=md5(md5($password).md5($salt));
    return $encrypt_password;
}

//生成token
function createToken()
{
    $token=md5(rand(1000000,9999999).time().str_shuffle('fgdfsdsdfas'));
    return $token;
}