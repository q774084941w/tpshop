<?php
/**
 * 后台主页面
 */
namespace app\Admin\controller;

use think\Db;
use think\Session;

class Hom extends NowController
{
    /**
     * @return \think\response\View
     * 主页面整体框架
     */
    public function index(){
        $id   = Session::get('ad_id');
        $rest = Db::name('admin')->alias('a')->join('tp_admin_data d','a.da_id=d.da_id')->join('tp_power p','a.pow_id=p.pow_id')->where('ad_id',$id)->find();
        //dump($rest);exit;
        $head = $this->gethead($rest['da_head']);
        $head = 'http://'.$_SERVER['HTTP_HOST'].'/'.$head;
        $this->assign('head',$head);
        $this->assign('my',$rest);
        return view();
    }

    /**
     * @param string $str
     * @return string
     * 处理图片信息
     */
    protected function gethead($str){
        $arr = json_decode($str);
        if(!$arr){
            return 0;
        }else{
            return implode('/',$arr);
        }
    }

    /**
     * 退出操作
     */
    public function takeout(){
        (new NowController())->clearAllThing();
        Session::clear();
        $this->redirect(request()->domain().'/admin');
    }

}