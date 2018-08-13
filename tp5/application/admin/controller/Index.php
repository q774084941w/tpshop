<?php
/**
 * Created by PhpStorm.
 * User: xxl
 * Date: 2017/12/28
 * Time: 14:51
 *
 * 后台系统登录
 *
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;

class Index extends Controller
{
    /**
     * @return \think\response\View
     * 登录主页面
     */
    public function index()
    {
        return view('login');
    }

    /**
     * 处理登录信息
     */
    public function login(){

        $request = Request::instance();
        $pass    = $request->param('userpwd');
        $user    = $request->param('username');
        $captcha = $request->param('Codes_text');
        $data  = array(
            'ad_name' => $user,
            'pass' => $pass,
            'captcha' => $captcha
        );
        $validate = validate('User');
        if(!$validate->scene('login')->batch()->check($data)){
            //var_dump($validate->getError());
            echo implode('|',$validate->getError());
            exit;
        }
        $data = array(
            'ad_name' => $user,
            'pass' => md5($pass),
        );
        $admin = model('Admin');
       echo $admin->login($data);
    }

}
