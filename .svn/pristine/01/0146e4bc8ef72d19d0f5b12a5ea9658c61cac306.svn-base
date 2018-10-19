<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/25
 * Time: 15:29
 */

namespace app\webman\validate;

use think\Validate;

class Webman extends Validate
{
    protected $rule = [
        'user_login'=>'regex:[0-9a-zA-Z]{6,15}',
        'user_pwd'=>'regex:[0-9a-zA-Z]{6,15}',
        'nickname'=>'chsDash',
        'avatar'=>'alphaNum',
        'phone'=>'regex:^1[0-9]{10}'
    ];
    protected $message = [
        'user_login.require'=>2006,
        'user_login.regex'=> 3006,
        'user_pwd.require'=>2007,
        'user_pwd.regex'=> 3006,
        'nickname.require'=> 2013,
        'nickname.chsDash'=> 3008,
        'avatar.alphaNum'=> 3009,
        'phone.regex'=> 3001
    ];

}