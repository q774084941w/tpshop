<?php
/**
 * Created by PhpStorm.
 * User: xxl
 * Date: 2018/1/23
 * Time: 11:35
 * 判断是否登录
 */

namespace app\index\controller;
use app\index\Model\Lidex;
use think\Controller;
use think\Db;
use think\Session;

class UserController extends Controller
{
    protected $user          = null;//用户个人信息
    protected $userImg       = null;//用户个人头像
    protected $userName      = null;//用户个人名称
    protected $AllController = array('Home','Order','Menpass');  //需要限定的控制器名
        public function __construct()
    {
        parent::__construct();
        $class= $this->getWheretoGo();
        $controller = trim(strstr($class,'/',true),'/');
        $ret=$this->isLogin();
        if(in_array($class,$this->AllController)||in_array($controller,$this->AllController)){ //特定的页面没登录不能访问
            if(!$ret){
                header("Refresh:0.5;url=".request()->domain()."/index/user");
                exit;
            }
        }
        $this->assignUser();
    }

    /**
     * 页面固定信息
     */
    protected function assignUser(){
        if($this->user){
            $this->assign('userMan','<img src='.$this->userImg.' style="width: 30px;height: 30px"><span>'.$this->userName.'</span>&ensp;<a href="/index/home/goodBye"  class="h">退出</a>');
        }else{
            $this->assign('userMan','<a href="/index/user" target="_top" class="h">亲，请登录</a><a href="/index/user/register" target="_top">免费注册</a>');
        }
        $this->assign('img',$this->userImg);
        $this->assign('name',$this->userName);
        //网站信息
        $arr=new Lidex();
        $re = $arr->sey();

        $this->assign('re', $re);
        $re=$arr->sele(1);
        $this->assign('sit_id', $re[0]['sit_id']);
        $this->assign('sit_filing', $re[0]['sit_filing']);
        $this->assign('sit_name', $re[0]['sit_name']);
        $this->assign('sit_logo', $re[0]['sit_logo']);
        $this->assign('sit_user_logo', $re[0]['sit_user_logo']);
        $this->assign('sit_title', $re[0]['sit_title']);
        $this->assign('sit_describe', $re[0]['sit_describe']);
        $this->assign('sit_key', $re[0]['sit_key']);
        $this->assign('sit_phone', $re[0]['sit_phone']);
        $this->assign('sit_tel', $re[0]['sit_tel']);
        $this->assign('sit_site', $re[0]['sit_site']);
        $this->assign('sit_qq', $re[0]['sit_qq']);
        $arr = Session::get('mygoods');
        if(isset($arr)){
            $num = count($arr);
        }else{
            $num = 0;
        }
        $this->assign('num',$num);
    }
    /**
     * 判断是否登录
     */
    protected function isLogin(){
        $id = Session::get('u_id');
//        var_dump($id);exit;
        if(isset($id)){
            if(!$this->user){
                $this->user     = Db::table('tp_user_means')->where('u_id',$id)->find();
                $this->userImg  = request()->domain().'/'.implode('/',json_decode($this->user['m_img']));
                $this->userName = Session::get('name');
                if($this->user['m_name']!='匿名用户'){
                    $this->userName = $this->user['m_name'];
                }
            }
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return string
     * 获取地址栏信息
     */
    protected function getWheretoGo(){
        $url      = $_SERVER['REQUEST_URI'];
        $position = strpos($url,'?');
        $url      = $position==false?$url:substr($url,0,$position);
        $url= trim($url, '/');
        return ucfirst(trim(strstr($url,'/'),'/'));
    }

    /**
     * 退出
     */
    protected function goodBye(){
        $this->user     = null;
        $this->userImg  = null;
        $this->userName = null;
        Session::clear();
    }
}