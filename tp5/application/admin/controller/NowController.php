<?php
/**
 * Created by PhpStorm.
 * User: xxl
 * Date: 2018/1/13
 * Time: 11:17
 * 权限控制器
 */

namespace app\Admin\controller;

use think\Controller;
use think\Db;
use think\Session;

class NowController extends Controller
{
    protected $allpower=null;//该用户拥有的所有权利
    protected $state=null;//该用户拥有的所有权利
    protected $hompower = array('Htm','Hom','Shopdata');//主页页面，个人信息页面
    /**
     * NowController constructor.
     * @user xxl
     * 检查是否登录  是否有权限操作
     */
    public function __construct()
    {
        parent::__construct();
        $id = Session::get('pow_id');
        //登录时保存了session
        if(isset($id)){
            //超级管理员不检查
            if($id!=1){
                $this->isState();
                $url    =  ucfirst($this->getWheretoGo());
                $class  =  explode('/',$url);
                //访问主页
                if(!in_array($class[0],$this->hompower)){
                    if(!$this->allpower){
                        $this->getAllPower($id);
                    }
                    if(!in_array($class[0],$this->allpower)&&!in_array($url,$this->allpower)){
                        echo '您没有访问的权限';
                        exit;
                    }
                }

            }
        }else{
            echo '您还未登录',"<script>window.setInterval(function() {
  window.location.href='/admin'
},3000)</script>";
            exit;
        }
    }

    /**
     * 判断启用停用
     */
    protected function isState(){
        if(!isset($this->state)){
            $this->state=Db::name('admin')->field('ad_state')->where('ad_id',Session::get('ad_id'))->find();
        }
        if(!$this->state){
            echo '你被停用了';
            exit;
        }
    }

    /**
     * @param int $id
     * 获取用户所有权利
     */
    protected function getAllPower($id){
        $allpower = Db::table('tp_power_have')->alias('h')->join('tp_power_fun f','h.fun_id=f.fun_id')->field('fun_val')->where('pow_id',$id)->select();
        foreach($allpower as $val){
            $this->allpower[] = implode($val);
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
        return trim(strstr(trim($url, '/'),'/'),'/');
    }

    /**
     * 清空记录
     */
    public function clearAllThing(){
        $this->allpower = null;
        $this->state = null;
    }
}