<?php
/**
 * Created by PhpStorm.
 * User: xxl
 * Date: 2018/1/23
 * Time: 15:17
 * 前台个人
 */

namespace app\index\controller;


use think\Db;
use think\Request;
use think\Session;

class Home extends UserController
{
    /**
     * 个人中心页面
     * @return \think\response\View
     */
    public function index(){
        $this->assign('man',$this->user);
        return view();
    }

    /**
     *  个人信息
     * @return \think\response\View
     */
    public function information(){
        $man = Db::table('tp_user')->where('u_id',$this->user['u_id'])->find();
        $this->assign('user',$man);
        $this->assign('man',$this->user);
        $this->assign('address',implode(',',json_decode($this->user['m_address'])));
        return view();
    }

    /**
     * 更改个人信息
     */
    public function changeMy(){
        //var_dump($_POST);exit;
        $request    = Request::instance();
        $m_name     = $request->param('m_name');
        $m_sex      = $request->param('m_sex');
        $m_birthday = $request->param('m_birthday');
        $u_phone    = $request->param('u_phone');
        $u_email    = $request->param('u_email');
        $address    = $request->param('address');
        $data       = array(
            'u_phone'  => $u_phone,
            'u_email'  => $u_email,
            'address'  => $address,
            'm_name' => $m_name,
            'm_sex'  => $m_sex,
            'm_birthday'  => $m_birthday,
        );
        $validate = validate('user');
        if(!$validate->scene('means')->batch()->check($data)){
            echo implode(',',$validate->getError());
            exit;
        }
        if(isset($_FILES["m_img"])){
            $m_img = $request->file("m_img");
            if($m_img){
                $info    = $m_img->move(ROOT_PATH.'public/user/'.$u_phone);
                if($info){
                    $url     = 'user/'.$u_phone.'/'.$info->getSaveName();
                    $da_head = json_encode(explode('/',$url));
                }else{
                    echo '图片处理失败';
                    exit;
                }
            } else{
                echo '图片过大，请从新上传';
                exit;
            }
        }

        $data       = array(
            'u_phone'     => $u_phone,
            'u_email'     => $u_email,
            'address'     => $address,
            'm_name'      => $m_name,
            'm_sex'       => $m_sex,
            'm_birthday'  => $m_birthday,
            'm_img'       => isset($da_head)?$da_head:$this->user['m_img'],
        );
        $model  = model('home');
        $uid    = Session::get('u_id');
        $model ->chengemeans($data,$uid);
        echo 1100;
    }

    /**
     * 个人账户安全
     * @return \think\response\View
     */
    public function safety(){
        $model = model('user');
        $user  = $model->getUser($this->user['u_id']);
        $u_phone = substr($user['u_phone'],0,3).'****'.substr($user['u_phone'],-4,4);
        $u_email = substr($user['u_email'],0,4).'****'.strstr($user['u_email'],'@');
        $this->assign('u_phone',$u_phone);
        $this->assign('u_email',$u_email);
        return view();
    }

    /**
     * 地址栏管理页面
     * @return \think\response\View
     */
    public function address(){
        $model = model('home');
        $thedress=$model->getAllAdress($this->user['u_id']);
        $this->assign('address',$thedress);
        return view();
    }
    /**
     * 添加收获地址
     */
    public function addAddress(){
        $request    = Request::instance();
        $a_name     = $request->param('a_name');
        $a_phone    = $request->param('a_phone');
        $address    = $request->param('address');
        $data       = array(
            'u_phone'  => $a_phone,
            'address'  => $address,
            'm_name' => $a_name,
        );
        $validate   = validate('user');
        if(!$validate->scene('address')->batch()->check($data)){
            echo implode(',',$validate->getError());
            exit;
        }
        $model  = model('home');
        $model ->addAddress($data,0);
        echo 1100;
    }
    public function dropAddress(){
        $request = Request::instance();
        $a_id    = $request->param('a_id');
        if(isset($a_id)){
            $model   = model('home');
            $model -> dropAddress($a_id);
            echo 1100;
        }else{
            echo '不符合规则';
        }

    }

    /**
     * 地址栏管理页面
     * @return \think\response\View
     */
    public function cardlist(){
        return view();
    }

    /**
     * 退出
     */
    public function goodBye()
    {
        parent::goodBye();
        $this->redirect(request()->domain());
    }
}