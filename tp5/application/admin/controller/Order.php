<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1
 * Time: 20:47
 */
namespace app\Admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\View;
class Order extends NowController
{
    public function order_list()
    {
        $result = Db::table("tp_order")->where("or_show_admin",1)->select();
        $this->assign('result',$result);
        return view("order_list");
    }
    public function order_admin_show()
    {
        $id = Request::instance()->param('order_id');
        $data =
        [
            'or_show_admin'=>0,
        ];
       $result = Db::table('tp_order')->where("order_id",$id)->update($data);
        return $result;
    }
}