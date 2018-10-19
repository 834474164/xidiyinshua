<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/21
 * Time: 17:17
 */

namespace app\common\model\toolsClass;


class picCombine
{
    static public function longPic($imgArr,$savePath,$baseLength)
    {
        $bg_w = $baseLength*2;
        $bg_h = $baseLength*3;
        $background = imagecreatetruecolor($bg_w,$bg_h);
        $color = imagecolorallocate($background, 202, 201, 201);
        imagefill($background, 0, 0, $color);
        imageColorTransparent($background, $color);

        $url = 'https://img.alicdn.com/imgextra/i2/2150972988/TB2d0A0jmxjpuFjSszeXXaeMVXa_!!2150972988.jpg';
        $hurg = 'http://img.pconline.com.cn/images/upload/upc/tx/pcdlc/1612/07/c347/31720929_1481117981509.jpg';
        $resource = imagecreatefromjpeg($url);
        $hurgSource = imagecreatefromjpeg($hurg);
        imagecopyresized($background,$resource,0,0,0,0,$baseLength,$baseLength,imagesx($resource),imagesy($resource));
        imagecopyresized($background,$resource,$baseLength,0,0,0,$baseLength,$baseLength,imagesx($resource),imagesy($resource));
        imagecopyresized($background,$resource,0,$baseLength,0,0,$baseLength*2,$baseLength*2,imagesx($resource),imagesy($resource));
        imagecopyresized($background,$hurgSource,$baseLength/4*3.5,$baseLength/4*3.5,0,0,$baseLength/4,$baseLength/4,imagesx($hurgSource),imagesy($hurgSource));
        header("Content-type: image/jpg");
        imagejpeg($background);
    }
}