<?php
/**
 * Created by PhpStorm.
 * User: XXL
 * Date: 2018/2/2
 * Time: 12:25
 * 各种前台页面
 */

namespace app\index\controller;
use think\model;
use think\Request;
use think\Db;
class Undetermined extends UserController
{
    public function order()
    {
        $model = model('Undetermined');
        $Allorder = $model ->order($this->user['u_id']);
        $totalnum  = count($Allorder);
        $totalpage = ceil($totalnum/3);
        $this->assign('total',$totalpage);
        $Request = Request::instance();
        $page = $Request->param('page');
        if(!empty($page))
        {
            $currentPage=$Request->param('page');
        }else{
            $currentPage = 1;
        }
        if($currentPage==1)
        {
            $next = 2;
            $last = 1;
            $this->assign('next',$next>$totalpage?$next=1:$next=2);
            $this->assign('last',$last);
        }
        if($currentPage>1&&$currentPage<$totalpage)
        {
            $next = $currentPage+1;
            $last = $currentPage-1;
            $this->assign('next',$next);
            $this->assign('last',$last);
        }
        if($currentPage==$totalpage&&$totalpage!=1)
        {
            $next = $currentPage;
            $last = $currentPage-1;
            $this->assign('next',$next);
            $this->assign('last',$last);
        }
        $result = array_chunk($Allorder,3);
        $this->assign('Allorder',$result[$currentPage-1]);
        return view();
    }
    public function del_order_index()
    {
        $data =
        [
            'or_show_index'=> 0,
        ];
        $result = Db::table("tp_order")->where('order_id',Request::instance()->param('id'))->update($data);
        return $result;
    }
    public function change(){
        return view();
    }
    public function comment(){
        return view();
    }
    public function points(){
        return view();
    }
    public function coupon(){
        return view();
    }
    public function bonus(){
        return view();
    }
    public function walletlist(){
        return view();
    }
    public function bill(){
        return view();
    }
    public function collection(){
        return view();
    }
    public function foot(){
        return view();
    }
    public function consultation(){
        return view();
    }
    public function suggest(){
        return view();
    }
    public function news(){
        return view();
    }

}