<?php
/**
 * Created by PhpStorm.
 * User: xxl
 * Date: 2018/1/20
 * Time: 16:55
 * 用户登录注册
 */

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Validate;

class User extends UserController
{
    /**
     * @return \think\response\View
     * 用户登录
     */
    public function index(){
        return view();
    }

    /**
     * @return \think\response\View
     * 用户注册
     */
    public function register(){
        return view();
    }

    /**
     * 处理邮箱注册
     */
    public function email(){
        $request = Request::instance();
        $pass = $request->param('password');
        $e_mail = $request->param('email');
        $data = array(
            'u_email' => $e_mail,
            'pass'    => $pass,
        );
        $validate = validate('User');
        if(!$validate ->scene('u_email')->batch()->check($data)){
            echo implode(',',$validate->getError());
            exit;
        };
        $data = array(
            'u_email'   => $e_mail,
            'pass'      => md5($pass),
            'u_state'   => '0',
            'u_time'    => date('Y-m-d H:i:s'),
        );
        $user = model('User');
        $ret=$user -> register($data);
        if($ret===true){
            echo 1100;
        }else{
            echo $ret;
        }
    }

    /**
     * 激活邮箱账号
     */
    public function takemaile($id){

        $id       = substr($id,20,32);
        $model    = model('user');
        $ko = $model->takestate($id);
        if($ko===true){
            $this->redirect(request()->domain());
        }else{
            echo $ko;
        }
    }

    /**
     * 处理手机注册
     */
    public function phone(){
        $request = Request::instance();
        $pass    = $request->param('password');
        $phone   = $request->param('phone');
        $code    = $request->param('code');
        $myCode  = Session::get('code');
        if($code!=$myCode){
            Session::delete('code');
            echo "验证失败，请从新获取";
            exit;
        }
        $data = [
            'u_phone' => $phone,
            'pass'   => $pass,
        ];

        $validate = validate('User');
        if(!$validate->scene('u_phone')->batch()->check($data)){
            echo implode(',',$validate->getError());
            exit;
        };
        $data = [
            'u_phone' => $phone,
            'pass'    => md5($pass),
            'u_time'  => date('Y-m-d H:i:s'),
        ];
        $user = model('User');
        $ret=$user -> register($data);
        if($ret){
            echo 1100;
        }else{
            echo $ret;
        }
    }

    /**
     * 登录处理
     */
    public function login(){
        $request = Request::instance();
        $u_name  = $request->param('u_name');
        $pass    = $request->param('pass');
        $key     = $this->whichType($u_name);
        $data    = array(
            $key   => $u_name,
            'pass' => $pass,
        );
        $validate  = validate('user');
        if(!$validate->scene($key)->batch()->check($data)){
            echo implode(',',$validate->getError());
            exit;
        };
        $model = model('user');
        $ret=$model->login($data,$key);
        if($ret===true){
            echo 1100;
        }else{
            echo $ret;
        }
    }

    /**
     * @param string $u_name
     * @return string
     * 判断是那种类型
     */
    protected function whichType($u_name){
        if(Validate::is($u_name,'/^1[3-8]{1}[0-9]{9}$/')){
            return 'u_phone';
        }elseif(Validate::is($u_name,'email')){
            return 'u_email';
        }else{
            return  'u_name';
        }
    }
}