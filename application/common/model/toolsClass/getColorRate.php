<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/13
 * Time: 11:06
 */

namespace app\common\model\toolsClass;


class getColorRate
{
    private $img;

    public function run($imgSrc,$rgbArr = [])
    {
        if (!$this->createImg($imgSrc)) {
            return false;
        }
        if (!$rgbArr) {
            return false;
        }
        if (!is_array($rgbArr)) {
            return false;
        }
        foreach ($rgbArr as $v) {
            if (count($v)!=3) {
                return false;
            }
        }
        return $this->getRate($rgbArr);

    }

    protected function createImg($fileName)
    {
        try {
            if (filesize($fileName)/1024/1024>1) {
                return false;
            }
            $type = getimagesize($fileName);
            $func = 'imagecreatefrom'.str_replace('image/','',$type['mime']);
            $this->img = $func($fileName);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    protected function getRate($rgbArr)
    {
        $i = $this->img; //图片路径
        $color = [];

        foreach ($rgbArr as $k=>$v) {
                $color[$k] = 0;
        }

        $total = 1;

        $imagesX = imagesx($i);
        $imagesY = imagesy($i);
        for ($x = 0; $x < $imagesX; $x++) {
            for ($y = 0; $y < $imagesY; $y++) {
                $rgb = imagecolorat($i, $x, $y);
                $r   = ($rgb >> 16) & 0xFF;
                $g   = ($rgb >> 8) & 0xFF;
                $b   = $rgb & 0xFF;

                foreach ($rgbArr as $k=>$v) {
                    if ($r==$v[0]&&$g==$v[1]&&$b==$v[2]) {
                        $color[$k]++;
                    }

                }
                $total++;
            }
        }

        $rate = [];
        foreach ($color as $k=>$v) {
            $rate[$k] = $v/$total;
        }
        return $rate;
    }
}