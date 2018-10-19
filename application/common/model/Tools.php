<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/27 0027
 * Time: 下午 3:08
 */
namespace app\common\model;

/**
 * 工具类命名空间
 */
use app\common\model\toolsClass;

class Tools
{
    /**
     * 统一密码加密方式
     * @param $pwd
     * @param $salt
     * @return string
     */
    static function pwdEncode($pwd, $salt)
    {
        return '###' . md5(md5($pwd) . $salt);
    }

    /**
     * 登录状态查询前的加密
     * @param $token
     * @param $ip
     * @return string
     */
    static function tokenEncode($token, $ip)
    {
        return md5($ip . $token);
    }
    /**
     * 解析数据城where条件
     * @param array $param
     * @param array $allow
     * @return array
     */
    static function parseWhere($param = [], $allow = [], $trans = [])
    {
        $obj = new toolsClass\ParseWhere();

        return $obj->run($param, $allow, $trans);
    }

    /**
     * 数组排序转字符串
     * @param array $order asc 0 asc 1 desc
     * @param array $allow
     * @return array
     */
    static function parseOrder($order = [], $table = '', $allow = [])
    {
        $order_str = '';
        foreach ($order as $v) {
            if (isset($v['order']) && in_array($v['order'], $allow)) {
                $asc = isset($v['asc']) && $v['asc'] > 0 ? 'asc' : 'desc';
                $table && $v['order'] = $table . '.' . $v['order'];
                $order_str .= ' ' . $v['order'] . ' ' . $asc;
            }
        }
        return $order_str;
    }

    /**
     * 无限级分类获取树
     * @param $items
     * @param $key 如果为是,则返回id为键值
     * @return array
     */
    static function generateTree($items,$key=false)
    {
        $tree = array();

        foreach ($items as $item) {
            if (isset($items[$item['pid']])) {
                if ($key) {
                    $items[$item['pid']]['children'][$item['id']] = &$items[$item['id']];
                } else {
                    if (!isset($items[$item['pid']]['children'])) {
                        $items[$item['pid']]['children'] = [];
                    }
                    $items[$item['pid']]['children'][] = &$items[$item['id']];
                }
            } else {
                if ($key) {
                    $tree[$item['id']] = &$items[$item['id']];
                } else {
                    $tree[] = &$items[$item['id']];
                }
            }
        }
        return $tree;
    }

    /**
     * 无限级分类按层级关系排序
     * @param $items
     * @param $key 如果为是,则返回id为键值
     * @return array
     */
    static function generateRebulid($items,$disId=false)
    {

        $tree = array();
        $org = $items;
        $tree = self::generateTree($items);
        $jsonTree = json_encode($tree,JSON_UNESCAPED_UNICODE);
        preg_match_all('/"id":"([0-9]{1,})"\,/',$jsonTree,$tress);
        $tress = $tress[1];
        // 兼容PHP7
        if (!$tress) {
            preg_match_all('/"id":([0-9]{1,})\,/',$jsonTree,$tress);
            $tress = $tress[1];
        }

        foreach ($tress as $k=>$v) {
            if ($org[$v]['pid']==0) {
                $org[$v]['layer'] = 0;
                $org[$v]['layer_targ'] = '';
                if ($disId&&$disId==$v) {
                    $org[$v]['disable'] = 1;
                } else {
                    $org[$v]['disable'] = 0;
                }
            } else {
                $org[$v]['layer'] = $org[$org[$v]['pid']]['layer'] + 1;
                if ($disId&&$disId==$v) {
                    $org[$v]['disable'] = 1;
                } else {
                    $org[$v]['disable'] = $org[$org[$v]['pid']]['disable'];
                }

                $org[$v]['layer_targ'] = $org[$org[$v]['pid']]['layer_targ'] . '::';
            }
            $tress[$k] = &$org[$v];
        }
        return $tress;
    }


    public function is_idcard($id)
    {
        $id = strtoupper($id);
        $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
        $arr_split = array();
        if (!preg_match($regx, $id)) {
            return FALSE;
        }
        if (15 == strlen($id)) //检查15位
        {
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";

            @preg_match($regx, $id, $arr_split);
            //检查生日日期是否正确
            $dtm_birth = "19" . $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            if (!strtotime($dtm_birth)) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else      //检查18位
        {
            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
            @preg_match($regx, $id, $arr_split);
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            if (!strtotime($dtm_birth)) //检查生日日期是否正确
            {
                return FALSE;
            } else {
                //检验18位身份证的校验码是否正确。
                //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
                $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
                $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
                $sign = 0;
                for ($i = 0; $i < 17; $i++) {
                    $b = (int)$id{$i};
                    $w = $arr_int[$i];
                    $sign += $b * $w;
                }
                $n = $sign % 11;
                $val_num = $arr_ch[$n];
                if ($val_num != substr($id, 17, 1)) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
        }
    }

    /**
     * curl
     * @param $url
     * @return mixed
     */
    static public function httpGet($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    /**
     * curl
     * @param $url
     * @return mixed
     */
    static public function httpPost($url, $param)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
        $res = curl_exec($ch);

        curl_close($ch);

        return $res;
    }


    static public function imgCombine($param)
    {
        $imgArr = isset($param['imgArr']) ? $param['imgArr'] : [];
        $savePath = isset($param['savePath']) ? $param['savePath'] : '';
        $baseLength = isset($param['baseLength']) ? $param['baseLength'] : 400;
        toolsClass\picCombine::longPic($imgArr, $savePath, $baseLength);
    }

    static public function urlToParam($url)
    {
        $urlParse = parse_url($url);
        if (isset($urlParse['query'])) {
            parse_str($urlParse['query'],$data);
            return $data;
        }
        return [];

    }


}