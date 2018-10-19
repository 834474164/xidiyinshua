<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/25
 * Time: 11:15
 */

namespace app\webman\controller;

use app\common\controller\WebmanBase;
use think\Validate;


class Index extends WebmanBase
{
    public function _empty()
    {

    }

    public function index()
    {
        if ($this->request->isAjax()) {
            $data = model('Privileges')->where('show', 1)->order('list_order desc,id asc')->column('*', 'id');
            $tree = model('Tools')->generateTree($data);
            return $this->showCode(1001, '', $tree);
        }
        return $this->fetch();
    }

    public function welcome()
    {
        $mysqlVersion = model('Role')->query('select VERSION() as a');
        $this->assign('mysqlv',$mysqlVersion[0]['a']);
        return $this->fetch();
    }


    public function adminInfo()
    {
        if ($this->request->isAjax()) {
            $data = $this->buildParam([
                'nickname'=>'a',
                'avatar'=>'piclist',
                'phone'=>'b'
            ]);
            $data['id'] = session("ADMIN_ID");
            return $this->editData(false,'Webman.info','webman/Webman',$data);
        }
        $info = model('webman')->where('id',session('ADMIN_ID'))->field('avatar,nickname,phone')->find();

        $this->assign('config',json_encode([
            'maxImg'=>1,
            'imgList'=>$info['avatar']
        ]));

        $this->assign('info',$info);
        return $this->fetch();
    }

    public function editPwd()
    {
        if ($this->request->isAjax()) {
            $data = $this->buildParam([
                'user_pwd'=>'a',
                'new_pwd'=>'b',
                'new_pwd_c'=>'c'
            ]);
            $rules = [
                'user_pwd'=>'require|regex:[0-9a-zA-Z]{6,16}',
                'new_pwd'=>'require|regex:[0-9a-zA-Z]{6,16}',
                'new_pwd_c'=>'require|regex:[0-9a-zA-Z]{6,16}'
            ];
            $validate = new Validate($rules);
            if (!$validate->check($data)) {
                return $this->showCode(1028);
            }
            if ($data['new_pwd']!=$data['new_pwd_c']) {
                return $this->showCode(1002,'两次密码不一致！');
            }
            if ($data['new_pwd']==$data['user_pwd']) {
                return $this->showCode(1002,'并未更改密码！');
            }
            $webmanModel = model('webman');
            $checkPwd = $webmanModel->checkPwd($data['user_pwd']);
            if (!$checkPwd) {
                return $this->showCode(2013);
            }

            $res = $webmanModel->updatePwd($data['new_pwd']);
            return $this->showCode($res?1001:1002);
        }
        return $this->fetch();
    }

    public function sysconfig()
    {
        if ($this->request->isAjax()) {
            $cfgModel = model('config');
            $data = $this->request->param();
            // $data['album'] = $data['piclist'];
            foreach ($data as $k=>$v) {
                $cfgModel->where('key',$k)->update([
                    'value'=>$v
                ]);
            }

            return $this->showCode(1001);
        }
        $config = model('config')->getCfg();
        unset($config[count($config)-1]);
        $this->assign('cfg',$config);
        $this->assign('config',json_encode([
            'maxImg'=>5,
            'imgList'=>$config[count($config)-1]['value']
        ]));
        return $this->fetch();
    }
}