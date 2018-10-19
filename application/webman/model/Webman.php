<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/25
 * Time: 11:43
 */

namespace app\webman\model;

use think\Model;

class Webman extends Model
{
    public $autoWriteTimestamp = true;

    protected function getAvatarAttr($val)
    {
        if ($val) {
            $picInfo = model('File')->where('md5',$val)->field('hash,path')->find();
            if ($picInfo) {
                return [
                    'hash'=>$picInfo['hash'],
                    'path'=>$picInfo['path']
                ];
            } else {
                return '';
            }

        } else {
            return '';
        }
    }
    /*
     * 验证登录
     */
    public function checkLogin()
    {
        if (!session('ADMIN_ID')) {
            return 2001;
        }
        $info = $this->where('id',session('ADMIN_ID'))->field('id,status,nickname,avatar,single_login,token')->find();
        if (!$info) {
            return 2001;
        }
        // 验证是否被封禁
        if ($info['status']!=1) {
            return 2003;
        }
        // 验证是否单点登录
        if ($info['single_login']==1&&session("webman_token")!=$info['token']) {
            return 2011;
        }
        return $info;
    }

    public function editData($data)
    {
        if (isset($data['avatar'])&&$data['avatar']) {
            $data['avatar'] = md5($data['avatar']);
        }
        if (isset($data['id'])&&$data['id']>0) {
            $id = $data['id'];
            unset($data['id']);
            unset($data['user_login']);
            $res = $this->isUpdate(true)->allowField(true)->save($data,[
                'id'=>$id
            ]);
        } else {
            unset($data['id']);
            $res = $this->allowField(true)->save($data);
        }
        return $res?1001:1002;
    }

    public function signLogin($data)
    {
        /*session记录用户ID和token验证参数*/
        session('ADMIN_ID',$data['uid']);
        /*cookie记录token*/
        cookie('admin',$data['token_pre'],[
            'expire'=>3600*2,
            'path'=>'/'
        ]);
        session("webman_token",$data['token']);
        $this->isUpdate(true)->allowField(true)->save([
            'token'=>$data['token'],
            'last_login_ip'=>$data['ip'],
            'last_login_time'=>time(),
        ],['id'=>$data['id']]);
    }

    public function updatePwd($pwd)
    {
        $salt = rand(1000,9999);
        $tools = model('tools');
        $res = $this->where('id',session('ADMIN_ID'))->update([
            'salt'=>$salt,
            'user_pwd'=>$tools::pwdEncode($pwd,$salt)
        ]);
        return $res;
    }
    public function checkPwd($pwd)
    {
        $info = $this->where('id',session('ADMIN_ID'))->field('salt,user_pwd')->find();
        $tools = model('tools');
        if ($tools::pwdEncode($pwd,$info['salt'])!==$info['user_pwd']) {
            return false;
        } else {
            return true;
        }
    }


}