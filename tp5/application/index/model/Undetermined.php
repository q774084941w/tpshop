<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/2
 * Time: 18:17
 */
namespace app\index\Model;
use app\index\controller\Begin;
use think\Db;
use think\Model;
use think\Session;
class Undetermined extends Model{
    /**
     * 加载前端订单管理页面
     */
    public function order($u_id)
    {
        $row = Db::table('tp_order')->where('u_id',$u_id)->where('or_show_index',1)->select();
//        print_r($row);exit;
        $arr=[];
        for($i=0;$i<count($row);$i++)
        {
            if(!empty($row[$i]['order_num'])){
                $row1 = Db::table('tp_order')->where('order_num',$row[$i]['order_num'])->find();
                $row2 = Db::table('tp_goods')->where('g_id',$row1['good_id'])->find();
                $row3 = Db::table('tp_goods_spec')->where('spec_id',$row1['spec_id'])->find();
                $arr['order_num']      =   $row1['order_num'];
                $arr['order_time']     =   $row1['order_time'];
                $arr['good_num']       =   $row1['good_num'];
                $arr['good_img']       =   $row1['good_img'];
                $arr['total_money']    =   $row1['total_money'];
                $arr['good_name']      =   $row2['g_name'];
                $arr['good_price']     =   $row3['spec_price'];
                $arr['spec_name']      =   $row3['key'];
                $arr['order_id']      =   $row1['order_id'];
                $brr[] = $arr;
            }else{
                continue;
            }
        }
        return $brr;
    }
}