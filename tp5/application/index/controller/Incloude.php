<?php
/**
 * Created by PhpStorm.
 * User: XXL
 * Date: 2018/1/28
 * Time: 10:10
 * 引入方法
 */

namespace app\index\controller;


class Incloude extends UserController
{
    /**
     * 头部
     * @return \think\response\View
     */
    public function head(){
        return view();
    }

    /**
     * 个人中心栏目框框
     * @return \think\response\View
     */
    public function manLeft(){
        return view();
    }

    /**
     * 底部信息
     * @return \think\response\View
     */
    public  function footer(){
        return view();
    }

    /**
     * 头部
     * @return \think\response\View
     */
    public function heads(){
        return view();
    }
}