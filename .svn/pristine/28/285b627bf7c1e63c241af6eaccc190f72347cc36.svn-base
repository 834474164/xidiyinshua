<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/19
 * Time: 11:08
 */

namespace app\common\model;

use think\Model;

class File extends Model
{
    protected $autoWriteTimestamp = true;
    public function exist($hash)
    {
        return $this->where('hash',$hash)->field('path')->find();
    }

    public function insertNewFile($fullPath,$hash)
    {
        $md5 = md5($hash);
        $res = $this->isUpdate(false)->save([
            'hash'=>$hash,
            'path'=>$fullPath,
            'md5'=>$md5
        ]);
        return $res;
    }
}