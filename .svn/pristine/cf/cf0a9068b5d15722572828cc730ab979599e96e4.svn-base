<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/29 0029
 * Time: 下午 3:31
 */
namespace app\common\model\toolsClass;

class ParseWhere {

    private  $where=[];

    public  function run($param,$allow,$trans=[])
    {
        foreach ($param as $k=>$v) {
            /*axios发不了数组，做此处理*/
            if (!is_array($v)) {
                $aioxs = json_decode($v,true);
                if (is_array($aioxs)&&count($aioxs)>0) {
                    $v = $aioxs;
                }
            }
            if (method_exists($this,$k)&&is_array($v)) {
                foreach ($v as $k1=>$v1) {
                    if (in_array($k1,$allow)&&$v1!=='') {
                        $v1 = isset($trans[$k1])?$this->transIt($trans[$k1],$v1):$v1;
                        $this->doit($k1,$v1,$k);
                    }
                }
            }
        }
        // 根据tp5.1作相应更改
        $where = $this->where;
        $whereNew = [];
        foreach ($where as $k=>$v) {
            $whereNew[] = [$k,$v[0],$v[1]];
        }
        return $whereNew;
    }

    private function doit($k,$v,$fun)
    {

        $this->$k = isset($this->$k)?intval($this->$k):0;

        if ($this->$k==0) {
            $this->where[$k] = $this->$fun($v);
        } elseif ($this->$k=1) {
            $o = $this->where[$k];
            $this->where[$k] = [];
            $this->where[$k][] = $o;
            $this->where[$k][] = $this->$fun($v);
        } else {
            $this->where[$k][] = $this->$fun($v);
        }
        $this->$k++;
    }

    private function eq($v)
    {
        return ['=',$v];
    }
    private function in($v)
    {
        return ['in',$v];
    }

    private function lt($v)
    {

        return ['<',$v];
    }
    private function gt($v)
    {
        return ['>',$v];
    }

    private function like($v)
    {
        return ['like','%'.$v.'%'];
    }
    private function between($v)
    {
        return ['between',$v];
    }

    private function exp($v)
    {
        return ['exp',$v];
    }

    private function transIt($func,$v)
    {
        if (method_exists($this,$func)) {
            return $this->$func($v);
        }
        if (function_exists($func)) {
            return $func($v);
        }
    }



}