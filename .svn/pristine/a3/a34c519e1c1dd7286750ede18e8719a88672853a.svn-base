<?php

namespace app\admin\controller;

use app\admin\model\Admintoken;
use think\App;
use think\Controller;
use think\Request;

class Base extends Controller
{
    public $manager_id;

    //构造方法
    public function __construct(App $app = null)
    {
        parent::__construct($app);

        $this->authorization();
    }

    //token验证
    protected function authorization(){

        $server=isset($_SERVER['HTTP_AUTHORIZATIONS'])?$_SERVER['HTTP_AUTHORIZATIONS']:null;

        if($server==null){

            $this->showCode('2005');
        }

        //验证token

        $token=new Admintoken();

        $result=$token->checkToken($server);

        $this->manager_id=$result['manager_id'];

        if(!$result){
            //验证失败

            $this->showCode('2005');
        }

    }
}
