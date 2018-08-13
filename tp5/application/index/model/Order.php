<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/30
 * Time: 21:29
 */
namespace app\index\Model;
use app\index\controller\Begin;
use think\Db;
use think\Model;
use think\Session;
class Order extends Model{
    /**
     * 结算页面的结算按钮上面的默认地址显示值
     * @param $u_id
     * @return array
     */
    public function getaddr1($u_id)
    {
        $address1 = Db::name('user_address')->where('u_id',$u_id)->find();
        $addr = json_decode($address1['a_address']);
        $data = array('arr'=>array(
            'name'     =>   $address1['a_name'],
            'phone'    =>   $address1['a_phone'],
            'addr'     =>    $addr[0],
            'addr1'    =>   $addr[1],
            'addr2'    =>   $addr[2],
            'addr3'    =>   $addr[3]
           ));
        return $data;
    }

    /**立即购买数据添加
     * @param $info
     */
    public function pay_now($info,$u_id)
    {
//        return  trim($info['gname']);
        $date = Date("Y-m-d H:i:s");
        $result = Db::table('tp_goods')->where('g_name',trim($info['gname']))->find();
        $total_money = $info['num']*$info['gprice'];
        $data =
        [
            'g_id'           =>   $result['g_id'],
            'u_id'           =>   $u_id,
            'spec_id'        =>   $info['spec_id'],
            'good_num'       =>   $info['num'],
            'total_money'    =>   $total_money,
            'card_time'      =>   $date,
        ];
        $result1 = Db::table("tp_shopping_cart")->insert($data);
        return  $result1;
    }
    /**
     * 显示购物车中的信息；
     */
    public function get_shop_cat($u_id)
    {
         $shop_cat = Db::table('tp_shopping_cart')->where('u_id',$u_id)->select();
//       print_r($shop_cat);exit;
         return ($this->loop($shop_cat));
    }

    /**
     * 重新构建输出购物车全面的信息
     * @param $shop_cat
     * @return array
     */
    public function loop($shop_cat)
    {
        $arr=[];
        $arr1=[];
        foreach($shop_cat as $val)
        {
                $arr[] = Db::table('tp_goods_spec')->where('spec_id',$val['spec_id'])->find();
                $arr1[] = Db::table('tp_goods')->where('g_id',$val['g_id'])->find();
        }
        for($i=0;$i<count($shop_cat);$i++)
        {
            $arr[$i]['good_num']          =   $shop_cat[$i]['good_num'];
            $arr[$i]['total_money']       =   $shop_cat[$i]['total_money'];
            $arr[$i]['g_name']            =   $arr1[$i]['g_name'];

        }
        return $arr;
    }

    /**
     * 订单生成的模块
     */
    public function order_create($arr,$u_id,$phone)
    {
        //生成订单号；
//        print_r($arr);exit;
//        print_r( $arr); exit;
        $totals =0;
        for($i=0;$i<count($arr);$i++)
        {
            $time = time();
            $date1= Date("Y-m-d H:i:s");
            $date = Date("YmdHis");
            $m1 = substr( md5($date),mt_rand(0,10),5);
            $m2 = substr(md5($u_id),mt_rand(0,10),5);
            $m3 = substr(md5($phone),mt_rand(0,10),4);
            //订单号
            $order_num = $m1.$m2.$m3.$time.mt_rand(100000,999999);
            $chuli = explode(',',$arr[$i]["goodinfo"]);
            $arr[$i]['spec_id'] =  $chuli[0];
            $arr[$i]['g_id'] =  $chuli[1];
            $arr[$i]['sto_count'] =  $chuli[2];
            $arr[$i]['g_name'] =  $chuli[4];
            $arr[$i]['key'] =  $chuli[3];
            $arr[$i]['good_img'] =  $chuli[5];
            $arr[$i]['order_num'] = $order_num;
            $totals = $totals+ $arr[$i]['total_money'];
            $data =
            [
               'order_num'             =>     $arr[$i]['order_num'],
                'u_id'                  =>     $u_id,
                'order_time'           =>     $date1,
                'good_num'             =>     $arr[$i]['good_num'],
                'sto_count'            =>     $arr[$i]['sto_count'],
                'total_money'          =>     $arr[$i]['total_money'],
                'spec_id'              =>     $arr[$i]['spec_id'],
                'good_id'              =>     $arr[$i]['g_id'],
                'send_method'          =>     $arr[$i]['recei_method'],
                'pay_method'           =>     $arr[$i]['pay_method'],
                'recei_name'           =>     $arr[$i]['recei_user'],
                'recei_addr'           =>     $arr[$i]['recei_addr'],
                'recei_phone'          =>     $arr[$i]['recei_phone'],
                'good_img'             =>     $arr[$i]['good_img'],
                'user_leave_word'     =>     $arr[$i]['leave_word'],
            ];
        if(!empty($arr[$i]['recei_addr'])&&!empty($arr[$i]['pay_method'])&&!empty($arr[$i]['recei_method']) )
                    {
                        if(Db::table("tp_order")->insert($data))
                        {
                            $brr = [];
                            $flog = Db::table('tp_shopping_cart')->where('spec_id',$arr[$i]['spec_id'])->delete();
                        }
                    }
                    else{
                        $flog = 0;
                    }
              }
        if(isset($brr))
        {
            return $totals;
        }else{
            return $flog;
        }
    }

    /**
     * 减库存
     */
    public function order_success($u_id)
    {
        $result = Db::table("tp_order")->where('u_id',$u_id)->select();
        $arr=[];
        foreach($result as $val)
        {
            //用于便利循环减库存的数组
           $arr[] =
               [
                   'spec_id'    =>   $val['spec_id'],
                   'sto_count'  =>   $val['sto_count'],
                   'good_num'   =>   $val['good_num'],
                   'g_id'       =>   $val['good_id']
               ];
        }
        foreach($arr as $val1)
        {
            $data =
                   [
                       'sto_count'=>$val1['sto_count']-$val1['good_num']
                   ];
            $result = Db::table("tp_goods_spec")->where('spec_id',$val1['spec_id'])->update($data);
            $this->updata_goodsCount($val1['g_id']);
        };
        return $result;
    }
    /**
     * @param $id
     * @return false|int|string
     * 修改 商品库存
     */
    public function updata_goodsCount($id)
    {
        $cuo = Db::name('goods_spec')->where('g_id',$id)->column('sto_count');
        $num = 0;
        if(!empty($cuo)){
            for($i=0;$i<count($cuo);$i++){
                $num += $cuo[$i];
            }
        }
        $data = [
            'sto_num'=>$num
        ];
        $re = Db::name('goods')->where('g_id',$id)->update($data);
        return $re;
    }

    /**
     * @param $id
     * @return array
     * 根据规格ID查询商品ID
     */
    public function select_gid($id)
    {
        $re = Db::name('goods_spec')->where('spec_id',$id)->column('g_id');
        return $re;
    }

    /**
     * @param $data
     * @return int|string
     * 添加购物车信息
     */
    public function add_shopcart($data)
    {
        $re = Db::name('shopping_cart')->insert($data);
        return $re;
    }
}