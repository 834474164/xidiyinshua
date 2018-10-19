<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/29 0029
 * Time: 下午 3:31
 */
namespace app\common\model\toolsClass;

class ParseMsg {
    public $info;

    public function __construct($info)
    {
        $this->info = $info;
    }

    public function order_submit()
    {
        $info = $this->info;
        $temp = [
            'touser'=>$info['wx_openid'],
            'template_id'=>'X1I1iUn_24unGuZUQy0QysvWNpmR17-U-YJVMt6dyCE',
            'url'=>'',
            'topcolor'=>'',
            'data'=>[
                'first'=>[
                    'value'=>'提交订单成功',
                    'color'=>''
                ],
                'keyword1'=>[
                    'value'=>date('Y-m-d H:i:s'),
                    'color'=>''
                ],
                'keyword2'=>[
                    'value'=>$info['order_sn'],
                    'color'=>'#0000ff'
                ],
                'keyword3'=>[
                    'value'=>$info['goods'],
                    'color'=>''
                ],
                'keyword4'=>[
                    'value'=>$info['shippig_status'],
                    'color'=>''
                ],
                'keyword5'=>[
                    'value'=>$info['status'],
                    'color'=>''
                ],
                'remark'=>[
                    'value'=>'请及时完成支付！',
                    'color'=>'#008000'
                ],
            ],
        ];
        return $temp;
    }
    public function order_cancel()
    {
        $temp = $this->order_submit();
        $temp['data']['remark'] = [
            'value'=>'欢迎选购其他商品！',
            'color'=>'#008000'
        ];
        $temp['data']['first'] = [
            'value'=>'取消订单成功！',
            'color'=>'#008000'
        ];

        return $temp;
    }
    public function order_upload()
    {
        $temp = $this->order_submit();
        $temp['data']['remark'] = [
            'value'=>'请等待管理员审核！',
            'color'=>'#008000'
        ];
        $temp['data']['first'] = [
            'value'=>'提交转账证明成功！',
            'color'=>'#008000'
        ];
        return $temp;
    }
    public function order_pay()
    {
        $temp = $this->order_submit();
        $temp['data']['remark'] = [
            'value'=>'请等待发货！',
            'color'=>'#008000'
        ];
        $temp['data']['first'] = [
            'value'=>'支付成功！',
            'color'=>'#008000'
        ];
        return $temp;
    }
    public function order_send()
    {
        $temp = $this->order_submit();
        $temp['data']['remark'] = [
            'value'=>'请注意接收！',
            'color'=>'#008000'
        ];
        $temp['data']['first'] = [
            'value'=>'订单已发货！',
            'color'=>'#008000'
        ];
        return $temp;
    }
    public function order_recive()
    {
        $temp = $this->order_submit();
        $temp['data']['remark'] = [
            'value'=>'欢迎下次光临！',
            'color'=>'#008000'
        ];
        $temp['data']['first'] = [
            'value'=>'订单已收货！',
            'color'=>'#008000'
        ];
        return $temp;
    }
    public function order_refound()
    {
        $temp = $this->order_submit();
        $temp['data']['remark'] = [
            'value'=>'欢迎选购其他商品！',
            'color'=>'#008000'
        ];
        $temp['data']['first'] = [
            'value'=>'退款申请已提交，请等待管理员审核！',
            'color'=>'#008000'
        ];
        return $temp;
    }

    public function order_refound_res()
    {
        $temp = $this->order_submit();
        $temp['data']['remark'] = [
            'value'=>'感谢您的选购！',
            'color'=>'#008000'
        ];
        $temp['data']['first'] = [
            'value'=>'退款已处理完成！',
            'color'=>'#008000'
        ];

        return $temp;
    }
    public function order_refound_fail()
    {
        $temp = $this->order_submit();
        $temp['data']['remark'] = [
            'value'=>'感谢您的选购！',
            'color'=>'#008000'
        ];
        $temp['data']['first'] = [
            'value'=>'退款已驳回！',
            'color'=>'#008000'
        ];
        return $temp;
    }
    public function contract_upload()
    {
        $info = $this->info;
        $temp = [
            'touser'=>$info['wx_openid'],
            'template_id'=>'pXZazfF4PNiQOhFT2biIekYROUNoD_8X-zLIzFVHdXA',
            'url'=>'',
            'topcolor'=>'',
            'data'=>[
                'first'=>[
                    'value'=>'上传合同成功',
                    'color'=>''
                ],
                'keyword1'=>[
                    'value'=>'本地合同',
                    'color'=>''
                ],
                'keyword2'=>[
                    'value'=>$info['sn'],
                    'color'=>'#0000ff'
                ],
                'keyword3'=>[
                    'value'=>date('Y-m-d H:i:s'),
                    'color'=>''
                ],
                'remark'=>[
                    'value'=>'请等待管理员回签！',
                    'color'=>'#008000'
                ],
            ],
        ];
        return $temp;
    }
    public function contract_comfirm()
    {
        $info = $this->info;
        $temp = [
            'touser'=>$info['wx_openid'],
            'template_id'=>'pXZazfF4PNiQOhFT2biIekYROUNoD_8X-zLIzFVHdXA',
            'url'=>'',
            'topcolor'=>'',
            'data'=>[
                'first'=>[
                    'value'=>'合同签署成功',
                    'color'=>''
                ],
                'keyword1'=>[
                    'value'=>$info['contract_name'],
                    'color'=>''
                ],
                'keyword2'=>[
                    'value'=>$info['sn'],
                    'color'=>'#0000ff'
                ],
                'keyword3'=>[
                    'value'=>date('Y-m-d H:i:s'),
                    'color'=>''
                ],
                'remark'=>[
                    'value'=>'合同签署成功！',
                    'color'=>'#008000'
                ],
            ],
        ];
        return $temp;
    }
    public function contract_forbidden()
    {
        $info = $this->info;
        $temp = [
            'touser'=>$info['wx_openid'],
            'template_id'=>'pXZazfF4PNiQOhFT2biIekYROUNoD_8X-zLIzFVHdXA',
            'url'=>'',
            'topcolor'=>'',
            'data'=>[
                'first'=>[
                    'value'=>'合同驳回',
                    'color'=>''
                ],
                'keyword1'=>[
                    'value'=>$info['contract_name'],
                    'color'=>''
                ],
                'keyword2'=>[
                    'value'=>$info['sn'],
                    'color'=>'#0000ff'
                ],
                'keyword3'=>[
                    'value'=>date('Y-m-d H:i:s'),
                    'color'=>''
                ],
                'remark'=>[
                    'value'=>'合同驳回！',
                    'color'=>'#008000'
                ],
            ],
        ];
        return $temp;
    }


}