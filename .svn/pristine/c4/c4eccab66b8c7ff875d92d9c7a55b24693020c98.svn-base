<?php

namespace app\admin\model;

use think\Model;

class Manager extends Model
{
    //用户数据
    public function getManager($username)
    {
        //查用户信息
        $data=Manager::where('username',$username)->find();

        return $data;
    }

    //查token数据
    public function getToken($manager_id)
    {
        $data=Manager::where(['manager_id'=>$manager_id])->find();

        return $data;
    }

    //查用户数据
    public function getManagerById($id)
    {
        $manager=Manager::find($id);
        return $manager;
    }

    //修改密码
    public function changePasswordm($id,$password,$salt)
    {
        $result=Manager::update(['id'=>$id,'password'=>$password,'salt'=>$salt]);

        return $result;
    }
}
