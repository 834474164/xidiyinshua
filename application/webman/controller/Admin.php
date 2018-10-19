<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/25
 * Time: 17:03
 */

namespace app\webman\controller;

use app\common\controller\WebmanBase;
use think\App;

class Admin extends WebmanBase
{
    private $tree;
    private $id;
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $data = model('Privileges')->column('*','id');
        $id = $this->request->param('id',false);
        $tree = model('tools')->generateRebulid($data,$id);
        $this->tree = $tree;
        $this->id = $id;
        $this->assign('tree',$tree);
    }

    public function index()
    {
        if ($this->request->isAjax()) {
            $data = model('Privileges')->paginate();
            return $this->showCode(1001,'',$data->itemsDo());
        }
        return $this->fetch();
    }

    // 方便权限管理
    public function add()
    {
        if ($this->request->isAjax()) {
            $unset = ['id'];
            return  $this->addEdit('Privileges');
        }
        $this->assign('info',[]);
        return $this->fetch();
    }

    public function edit()
    {
        if ($this->request->isAjax()) {
            return $this->addEdit('Privileges.edit');
        }
        $id = $this->request->param('id','0','intval');
        $info = model('Privileges')->where('id',$id)->find();

        $this->assign('info',$info);
        return $this->fetch('add');
    }

    private function addEdit($validate,$unset=[])
    {
        $trans = [
            'name'=>'a',
            'path'=>'b',
            'is_ajax'=>'c',
            'show'=>'d',
            'pid'=>'e',
            'id'=>'id'
        ];
        foreach ($unset as $v) {
            if (isset($trans[$v])) {
                unset($trans[$v]);
            }
        }
        $pid = $this->request->param('e');
        if ($pid) {
            foreach ($this->tree as $v) {
                if ($v['id']==$pid&&$v['disable']==1) {
                    return $this->showCode(3005);
                }
            }
        }

        return $this->editData($trans,$validate,'webman/Privileges');
    }

    public function del()
    {
        $id = $this->request->param('id',0,'intval');
        $son = model('webman/Privileges')->where('pid',$id)->count();
        if ($son>0) {
            return $this->showCode(5001);
        }

        $res = model('webman/Privileges')->where('id',$id)->delete();
        return $this->showCode($res?1001:1002);
    }

}