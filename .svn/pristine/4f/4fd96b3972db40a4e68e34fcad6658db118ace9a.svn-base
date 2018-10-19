<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/26
 * Time: 15:30
 */

namespace app\webman\validate;

use think\Validate;

class Privileges extends Validate
{
    protected $rule = [
        'name'=> 'require|chsAlphaNum',
        'path'=> 'require',
        'is_ajax'=>'between:0,1|integer',
        'show'=>'between:0,1|integer',
        'pid'=> 'integer'
    ];
    protected $message = [
        'name.require'=>3004,
        'path.require'=>3004,
        'name.chsAlphaNum'=>3005,
        'is_ajax.between'=>3005,
        'is_ajax.integer'=>3005,
        'show.between'=>3005,
        'show.integer'=>3005,
        'pid.integer'=>3005,
    ];

}