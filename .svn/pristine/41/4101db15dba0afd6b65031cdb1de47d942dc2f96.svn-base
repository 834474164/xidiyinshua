<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/25
 * Time: 13:50
 */

namespace app\common\controller;

use think\Controller;
use think\App;

class Base extends Controller
{
    /**
     * 数据库字段 网页字段转换
     * 标识为数据库字段 值为浏览器提交字段
     * @param $array 标识为数据库字段 值为浏览器提交字段
     * @param bool $uuid 是否追加UUID信息
     * @return array
     */
    protected function buildParam($array,$uuid=false)
    {
        $data=[];
        foreach( $array as $item=>$value ){
            $data[$item] = $this->request->param($value);
        }
        if ($uuid && isset($this->uuid)){
            $data['uuid'] = $this->uuid;
        }
        return $data;
    }

    /**
     * 快速修改
     * @param bool|false $parameter
     * @param bool|false $validate_name
     * @param bool|false $model_name
     * @param array $save_data
     * @return array
     */
    protected function editData($parameter = false, $validate_name = false, $model_name = false, $save_data = [])
    {
        if (empty($save_data)) {
            if ($parameter != false && is_array($parameter)) {
                $data = $this->buildParam($parameter);
            } else {
                $data = $this->request->post();
            }
        } else {
            $data = $save_data;
        }

        if (!$data) return $this->showCode(1004);

        if ($validate_name != false) {

            $result = $this->validate($data, $validate_name);

            if (true !== $result) return $this->showCode($result);
        }

        $loader = new App();
        $model_edit = $loader->model($model_name);
        if (!$model_edit) return ['code' => 1010];

        return $this->showCode($model_edit->editData($data));
    }

    protected function commonDel($model='')
    {
        $id = $this->request->param('id');
        if (!$id||!$model) {
            return $this->showCode(1002);
        }
        $res = model($model)->where('id',$id)->delete();
        return $this->showCode($res?1001:1002);
    }
}