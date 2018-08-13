<?php
/**
 * Created by PhpStorm.
 * User: XXL
 * Date: 2018/1/28
 * Time: 11:03
 * 密码修改
 */

namespace app\index\controller;


use think\Request;
use think\Session;

class Menpass extends UserController
{
    protected $u_phone;//用户手机号码
    protected $u_email;//用户邮箱
    protected $myLogin;//用户登录信息

    /**
     * 对手机邮箱加密
     * Menpass constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $model = model('user');
        $this->myLogin = $model->getUser($this->user['u_id']);
        $this->u_phone = substr($this->myLogin['u_phone'],0,3).'****'.substr($this->myLogin['u_phone'],-4,4);
        $this->u_email = substr($this->myLogin['u_email'],0,4).'****'.strstr($this->myLogin ['u_email'],'@');
    }

    /**
     * 密码修改页面
     * @return \think\response\View
     */
    public function index(){
        return view();
    }

    /**
     * 修改密码操作
     */
    public function pass(){
        $request  = Request::instance();
        $oldPass  = $request->param('oldPass');
        $newPass  = $request->param('newPass');
        $pass2    = $request->param('pass2');
        $validate = validate('Pass');
        $id       = $this->user['u_id'];
        $data     = array(
            'pass'   => $oldPass,
            'Npass'  => $newPass,
            'Npass2' => $pass2,
        );
        if(!$validate->scene('pass')->batch()->check($data)){
            echo implode(',',$validate->getError());
            exit;
        }
        if(isset($id)){
            if($newPass!=$pass2){
                echo '两次密码不一致';
                exit;
            }
            $model = model('home');
            $ret=$model->pass($data,$id);
            if($ret===true){
                echo 1100;
            }else{
                echo $ret;
            }
        }else{
            echo '请登录';
        }
    }

    /**
     * 支付密码
     * @return \think\response\View
     */
    public function setpay(){
        return view();
    }

    /**
     * 绑定手机页面
     * @return \think\response\View
     */
    public function bindphone(){
        $this->assign('u_phone',$this->u_phone);
        $this->assign('old_phone',$this->myLogin['u_phone']);
        return view();
    }

    /**
     * 绑定邮箱页面
     * @return \think\response\View
     */
    public function email(){
        $this->assign('u_email',$this->u_email);
        return view();
    }

    /**
     * 实名认证页面
     * @return \think\response\View
     */
    public function idcard(){
        return view();
    }

    /**
     * 安全问题页面
     * @return \think\response\View
     */
    public function question(){
        return view();
    }

    /**
     * 添加银行卡页面
     * @return \think\response\View
     */
    public function cardmethod(){
        return view();
    }

    /**
     * 账单页面
     * @return \think\response\View
     */
    public function billlist(){
        return view();
    }
}