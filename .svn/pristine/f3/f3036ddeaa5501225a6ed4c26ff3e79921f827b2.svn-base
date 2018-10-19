<?php
/**
 * Created by PhpStorm.
 * User: daoyankong
 * Date: 2018/9/1
 * Time: 16:10
 */

namespace app\webman\controller;

use app\common\controller\WebmanBase;

class Article extends WebmanBase
{
    public function index()
    {
        $search = [
                    'title'=>[
                        'type'=>'0',
                        'name'=>'标题'
                    ],
                    'status'=>[
                        'type'=>'1',
                        'style'=>'width:100px',
                        'name'=>'状态',
                        'val'=>[
                            '1'=>'状态一',
                            '2'=>'状态二',
                            '3'=>'状态三',
                        ]
                    ]
                    ];
        $field = [
            'id'=>[ 'name'=>'ID'],
            'list_order'=> ['name'=>'排序'],
            'title'=>['name'=>'标题','width'=>300],
            'create_time'=>['name'=>'创建时间','width'=>150],
            'update_time'=>['name'=>'更新时间','width'=>150],
            'do'=>['name'=>'操作','width'=>300]
        ];
        $config = compact('search','field');
        return $this->common($config);
    }

    public function add()
    {
        return $this->addEdit();
    }

    public function edit()
    {

        return $this->addEdit();
    }

    private function addEdit($info='')
    {
        $field = [
            [
                'title'=>['name'=>'标题','type'=>0],
                ''=>''
            ],
            [
                'desc'=>['name'=>'摘要','type'=>2,'style'=>'height:100px','colspan'=>2]
            ],
            ['content'=>['name'=>'内容','type'=>3,'style'=>'height:400px','colspan'=>2]]
        ];
        $trans = ['title'=>'a','desc'=>'b','content'=>'c'];
        if ($info) {
            $title = '文章编辑';
        } else {
            $title = '文章新增';
        }

        $config = compact('field','trans','info','title');
        return $this->common($config,'edit');
    }

}