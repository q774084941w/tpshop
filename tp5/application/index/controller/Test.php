<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26 0026
 * Time: 11:34
 */
namespace app\index\controller;

use think\Db;

class Test
{
    public function index()
    {
        $re = Db::name('goods_cla')->where('choose',1)->select();
        $fe = Db::name('goods_cla')->where('cla_fid',0)->where('choose',1)->select();
        $data = [];
        foreach($fe as $val){
            $arr = [];
            $son = [];
            foreach($re as $vals){
                if($vals['cla_fid']==$val['cla_id']){
                    $arr[] = $vals;
                }
            }

            foreach($arr as $v){
                $son1 = [];
                $shop = [];
                foreach($re as $vs){
                    if($vs['cla_fid']==$v['cla_id']){
                        $son1[]=$vs;
                        $shop[]= Db::name('goods')->where('cla_id',$vs['cla_id'])->where('is_recommend',1)->select();
                    }
                }
                $v['son1']=$son1;
                $v['shop']=$shop;
                $son[] = $v;
            }
            $val['son']=$son;
            $data[] = $val;
        }

        print_r($data);
    }

}
