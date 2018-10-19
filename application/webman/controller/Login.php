<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/25
 * Time: 13:57
 */

namespace app\webman\controller;

use think\Controller;
use think\Validate;

class Login extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function doLogin()
    {
        $data = $this->request->param();
        $rule = [
            'user'=>'require|token|regex:[0-9a-zA-Z]{6,15}',
            'pwd'=>'require|regex:[0-9a-zA-Z]{6,15}',
        ];
        $msg = [
            'user.require'=>2006,
            'user.regex'=>2002,
            'pwd.require'=>2007,
            'pwd.regex'=>2002,
        ];


        $validate = new Validate($rule,$msg);
        if (!$validate->check($data)) {
            return $this->showCode($validate->getError());
        }
        $webmanModel = model('Webman');
        $uinfo = $webmanModel->where('user_login',$data['user'])->field('id,salt,user_pwd')->find();
        if (!$uinfo) {
           return $this->showCode(2002);
        }
        $pwd = $data['pwd'];
        $tools = model('Tools');

        if ($uinfo['user_pwd']!==$tools::pwdEncode($pwd,$uinfo['salt'])) {
            return $this->showCode(2002);
        } else {
            $ip = $this->request->ip();
            $token_pre = md5(json_encode($uinfo).time().$ip.rand(0,9999));
            $token = $tools::tokenEncode($token_pre,$ip);
            $webmanModel->signLogin([
                'uid' => $uinfo['id'],
                'token_pre' => $token_pre,
                'token' => $token,
                'ip' => $ip,
                'id' => $uinfo['id']
            ]);
            return $this->showCode(1001,'',['token'=>$token]);
        }
    }

    public function logout()
    {
        session('ADMIN_ID',null);
        header("Location:".url('index'));
        ;exit;
    }

}