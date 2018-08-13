<?php
/**
 * 商城数据
 */
namespace app\Admin\controller;
use think\Db;
use think\Session;

class Shopdata extends NowController
{
    /**
     * @return \think\response\View
     * @assign loginmess是登录的记录信息
     */
    public function index()
    {
        $rest  = Db::table('tp_Loginmess')->where('ad_id',Session::get('ad_id'))->order('login_time desc')->limit(5)->select();
        //dump($rest);exit;
        $this->assign('Loginmess',$rest);
        return view('index');
    }
}
