<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/25
 * Time: 11:17
 */

namespace app\common\controller;

use think\App;

class WebmanBase extends Base
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);

        $webmanModel = model('webman/webman');
        $checkLogin = $webmanModel->checkLogin();

        if (is_numeric($checkLogin)) {
            return $this->showCode($checkLogin,'',[],"webman/login/index");
        } else {
            if (!$this->checkAccess($checkLogin['id'])) {
                $this->showCode("2004");
            }
            $this->assign('admin', $checkLogin);
        }
        $this->assign('url',urldecode($this->request->url()));
    }

    private function checkAccess($admin_id)
    {
        if ($admin_id==1) {
            return true;
        }
        return false;
    }

    /**
     * @param array $config
     * @param string $action
     * type 0 字符串 1 下拉选择 2 文本框 3 编辑器
     * @return mixed|void
     */
    protected function common($config=[],$action='index')
    {
        $param = $this->request->param();
        if ($this->request->isAjax()) {

            return $this->showCode(0);
        }
        foreach ($config as $k=>$v) {
            $this->assign($k,$v);
        }
        $this->assign('param',$param);

        return $this->fetch('common/'.$action);
    }



}