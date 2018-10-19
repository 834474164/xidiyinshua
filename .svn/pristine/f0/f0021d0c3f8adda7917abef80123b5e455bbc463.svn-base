<?php
/**
 * Created by PhpStorm.
 * User: daoyankong
 * Date: 2018/8/1
 * Time: 17:08
 */

namespace app\webman\controller;

use app\common\controller\WebmanBase;

class Role extends WebmanBase
{
    public function index()
    {
        if ($this->request->isAjax()) {
            $data = model('Role')->paginate();
            return $this->showCode(1001,'',$data->itemsDo(),'',$data->total());
        }
        return $this->fetch();
    }

    public function add()
    {
        if ($this->request->isAjax()) {
            $unset = ['id'];
            return  $this->addEdit('Role');
        }

        $this->assign('info',[]);
        return $this->fetch();
    }

    public function edit()
    {
        if ($this->request->isAjax()) {
            return $this->addEdit('Role.edit');
        }
        $id = $this->request->param('id','0','intval');
        $info = model('Role')->where('id',$id)->find();

        $this->assign('info',$info);
        return $this->fetch('add');
    }

    private function addEdit()
    {

    }

    public function menu()
    {
        if ($this->request->isAjax()) {
            $data = model('Privileges')->limit(999999)->select();
            foreach ($data as $k=>$v) {
                $data[$k]['LAY_CHECKED'] = true;
            }
            return $this->showCode(1001,'',$data);
        }
    }



}