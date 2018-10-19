<?php

namespace app\admin\model;

use think\Model;

class Admintoken extends Model
{
    //查token数据
    public function getToken($manager_id)
    {
        $res=Admintoken::where('manager_id',$manager_id)->find();

        return $res;
    }

    //刷新token
    public function resetToken($manager_id)
    {
        $token=createToken();

        $res=Admintoken::where('manager_id',$manager_id)->update(['token'=>$token,'expire_at'=>time()+30*3600*24]);

        return $res;
    }

    //添加token数据
    public function addToken($manager_id,$username)
    {
        $token=createToken();

        $res=Admintoken::save(['manager_id'=>$manager_id,'token'=>$token,'info'=>$username,'expire_at'=>time()+30*3600*24]);

        return $res;
    }


    //验证token
    public function checkToken($token)
    {
        $data=Admintoken::where(['token'=>$token])->find();

        return $data;
    }
}
