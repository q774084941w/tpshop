<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/28
 * Time: 15:26
 */
namespace app\index\controller;
use think\Session;
use think\View;
use think\Request;
use think\model;
use think\Db;
class Order extends UserController
{
    /**加载订单生成的页面
     * @return View
     */
        public function order_show()
        {
            $model = model('home');
            $model1 = model('order');
            $thedress=$model->getAllAdress($this->user['u_id']);
            $thedress1=$model1->getaddr1($this->user['u_id']);
            $thecat = $model1->get_shop_cat($this->user['u_id']);//显示购物车信息的数据
            $this->assign('address',$thedress);//显示上面的地址
            $this->assign('shop_cat',$thecat);//显示购物车的全部信息
            $this->assign('address1',$thedress1);//显示提交按钮处的默认地址
            return View("pay");
        }
     public function pay_now()
     {
         $info = [
                      'img'        =>   Request::instance()->param('img'),
                      'spec_id'   =>   Request::instance()->param('spec_id'),
                      'gname'     =>   Request::instance()->param('gname'),
                      'gprice'    =>   Request::instance()->param('gprice'),
                      'pec'       =>   Request::instance()->param('pec'),
                      'num'       =>   Request::instance()->param('num'),
                      'method'    =>   Request::instance()->param('method'),
                 ];
         $model = model('order');
         $result = $model->pay_now($info,$this->user['u_id']);
         var_dump($result);
     }
    /**
     * 显示购物车中的信息
     */
    public function cateinfo_show()
        {
            $model = model('order');
            $thecat = $model->get_shop_cat($this->user['u_id']);//显示购物车信息的数据
        }

    /**
     * @return mixed
     * 生成订单号的方法
     */

    public function order_create()
       {
           $pay_method      =   Request::instance()->param('pay_method');
           $recei_method    =   Request::instance()->param('recei_method');
           $leave_word      =   Request::instance()->param('leave_word');
           $recei_user      =   Request::instance()->param('recei_user');
           $recei_phone     =   Request::instance()->param('recei_phone');
           $recei_addr      =   Request::instance()->param('recei_addr');
           $all_pay         =   Request::instance()->param('all_pay');

           $good_num     =   Request::instance()->param('good_num');
           $tp_good_someinfo     =   Request::instance()->param('tp_good_someinfo');
           $total_money     =   Request::instance()->param('total_money');

           $goodsnum = json_decode($good_num);
           $goodsinfo = json_decode($tp_good_someinfo);
           $totalsmoney = json_decode($total_money);
           $goodinfo = [];
           $model = model('order');
           for($i=0;$i<count($goodsnum);$i++)
           {
               $goodinfo[]=
               [
                   'pay_method'       =>      $pay_method,
                   'recei_method'     =>      $recei_method,
                   'leave_word'       =>      $leave_word,
                   'recei_user'       =>      $recei_user,
                   'recei_phone'      =>      $recei_phone,
                   'recei_addr'       =>      $recei_addr,
                   'goodinfo'         =>      $goodsinfo[$i],
                   'good_num'         =>      $goodsnum[$i],
                   'total_money'      =>      $totalsmoney[$i],
               ];
           }
           $result = $model->order_create($goodinfo,$this->user['u_id'],$recei_phone);
           return $result;
       }

    /**
     * @return View
     * 交易成功减库存
     */
    public function order_success()
    {
        $total = json_decode(Request::instance()->param('ordernum'));
//        echo "<pre>";
//        print_r($order_num);exit;
        $model = model('order');
        $arr = $model-> order_success($this->user['u_id']);

            $result = Db::table("tp_order")->where('u_id',$this->user['u_id'])->select();

            foreach($result as $val)
            {

            }

        $total = $total.'.00';
        $useraddr[] =
            [
                're_name' =>$val['recei_name'],
                're_addr' =>$val['recei_addr'],
                're_phone' =>$val['recei_phone']
            ];
        $this->assign('useraddr',$useraddr);
        $this->assign('total',$total) ;
        return View("success");
    }

    /**
     * 处理购物车结算信息
     */
    public function intocart(){
        $request = Request::instance();
        $data = json_decode($request->param("data"));
        $arr = Session::get('mygoods');
        $narr = array();
        $order = new \app\index\Model\Order();
        date_default_timezone_set('Asia/Shanghai');
        foreach ($arr as $key=>$vl){
            $narr[] = $vl;
            for($i=0;$i<count($data[0]);$i++){
                if($vl['spec_id']==$data[0][$i]){
                    $narr[$key]['num']=$data[1][$i];
                    continue;
                }
            }
        }
        $ndata = [];
        $nshu = [];
        foreach($narr as $val){
            $ndata['u_id']=Session::get('u_id');
            $ndata['spec_id']=$val['spec_id'];
            $ndata['g_id']= $order->select_gid($val['spec_id'])[0];
            $ndata['good_num']=$val['num'];
            $ndata['total_money']=$val['num']*$val['gprice'];
            $ndata['card_time']=date("Y-m-d");
            $nshu[] = $ndata;
        }

        foreach($nshu as $da){
            $re = $order->add_shopcart($da);
            if(!$re){
                break;
            }
        }
        Session::set('mygoods',null);
        $this->success('正在为您跳转到结算页面','http://www.tpshop.com/Index/order/order_show');
        //print_r($nshu);
    }
}