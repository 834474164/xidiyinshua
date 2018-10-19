<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/26
 * Time: 15:36
 */

namespace app\webman\model;

use think\Model;

class Privileges extends Model
{
    protected function getIsAjaxAttr($val)
    {
         return $val?'是':'否';
    }
    protected function getShowAttr($val)
    {
         return $val?'是':'否';
    }

    public function editData($data)
    {
        if (isset($data['id'])&&$data['id']) {
            $res = $this->isUpdate(true)->allowField(true)->save($data);
        } else {
            $res = $this->isUpdate(false)->allowField(true)->save($data);
        }
        return $res?1001:1002;
    }
}