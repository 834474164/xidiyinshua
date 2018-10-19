<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use \app\admin\controller\Base;
use think\Validate;
use \app\admin\model\Manager as ManagerModel;
class Manager extends Base
{
    /**
     * 修改密码
     *
     * @return \think\Response
     */
    public function changePassword()
    {
        $info=request()->param();

        //定义验证器
        $rules=[
            'oldpassword'=>'require',
            'newpassword'=>'require',
            'oncepassword'=>'require',
        ];

        //定义提示信息
        $msg=[
            'oldpassword.require'=>'请输入原始密码',
            'newpassword.require'=>'请输入新密码',
            'oncepassword.require'=>'请再次输入新密码',
        ];

        $validate=new Validate($rules,$msg);

        if($validate->batch()->check($info)){
            //验证原密码
            $manager=new ManagerModel();

            $id=$this->manager_id;

            //查用户数据
            $result=$manager->getManagerById($id);

            $password=addslashes($info['oldpassword']);

            $truePassword=$result['password'];

            $salt=$result['salt'];

            //加密
            $password=encrypt($password,$salt);

            if(!($password==$truePassword)){
                //原始密码不正确
                $this->showCode('2018');
            }

            if(!($info['newpassword']==$info['oncepassword'])){
                //两次输入的新密码不一致
                $this->showCode('2017');
            }

            $salt=rand(1000,9999).str_shuffle('abcde');

            $newpassword=encrypt($info['newpassword'],$salt);

            //更新密码
            $res=$manager->changePasswordm($id,$newpassword,$salt);

            if($res){
                //修改成功

                $this->showCode('1001');
            }else{
                //修改失败

                $this->showCode('1002');
            }

        }else{
            $error=$validate->getError();

            $error=implode(',',$error);

            $this->showCode('3004',$error);
        }
    }


}
