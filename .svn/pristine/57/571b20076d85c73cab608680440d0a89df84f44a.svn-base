<?php

namespace app\admin\controller;

use app\admin\model\Admintoken;
use app\admin\model\Manager;
use think\Controller;
use think\Request;
use think\Validate;

class Login extends Controller
{
    /**
     * 管理员登录
     *
     * @return \think\Response
     */
    public function login()
    {
        $info=request()->param();

        //定义验证器
        $rules=[
            'username'=>'require',
            'password'=>'require'
        ];

        //定义提示信息
        $msg=[
            'username.require'=>'请输入账号',
            'password.require'=>'请输入密码',
        ];

        $validate=new Validate($rules,$msg);

        if($validate->batch()->check($info)){
            //登录验证
            $manager=new Manager();

            $username=addslashes($info['username']);

            $password=addslashes($info['password']);

            //查用户数据
            $result=$manager->getManager($username);

            $truePassword=$result['password'];

            $salt=$result['salt'];

            //加密
            $password=encrypt($password,$salt);

            if($password==$truePassword){
                //登录成功

                $manager_id=$result['id'];

                $token=new Admintoken();

                $rel=$token->getToken($manager_id);

                if($rel){
                    //用户登录过

                    //刷新token
                    $res=$token->resetToken($manager_id);

                }else{
                    //用户没有登录过

                    $username=$result['username'];

                    //添加token数据
                    $res=$token->addToken($manager_id,$username);
                }

                //获取登录用户信息
                $managerInfo=$token->getToken($manager_id);

                $managerInfo->visible(['token','info']);

                $this->showCode('1001','',$managerInfo);
            }else{
                //登录失败
                $this->showCode('2002','');

            }

        }else{
            $error=$validate->getError();

            $error=implode(',',$error);

            $this->showCode('3004',$error);
        }
    }

}
