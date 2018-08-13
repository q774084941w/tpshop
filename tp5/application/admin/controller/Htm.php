<?php

/**
 * Created by PhpStorm.
 * User: XXL
 * Date: 2018/1/14
 * Time: 14:57
 * 个人信息
 */
namespace app\admin\controller;

use think\Db;
use think\Request;
use think\Session;
use think\Validate;

class Htm extends NowController
{
    protected $head;
    /**
     * @return \think\response\View
     * 个人信息首页
     */
    public function index(){
        $id   = Session::get('ad_id');
        $rest = Db::table('tp_admin')->alias('a')->join('tp_admin_data d','a.da_id=d.da_id')->join('tp_power p','a.pow_id=p.pow_id')->where('ad_id',$id)->find();
        //dump($rest);exit;
        $this->head = $this->gethead($rest['da_head']);
        $head = 'http://'.$_SERVER['HTTP_HOST'].'/'.$this->head;
        $this->assign('head',$head);
        $this->assign('my',$rest);
        return view('personal_info');
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
     * 更改个人信息
     */
    public function change()
    {
        $request = Request::instance();
       $da_id   = $request->param('da_id');
        $ad_name = $request->param('ad_name');
        $da_name = $request->param('da_name');
        $da_sex  = $request->param('da_sex');
        $da_age  = $request->param('da_age');
        $data = array(
            'ad_name' => $ad_name,
            'da_id'   => $da_id,
            'da_name' => $da_name,
            'da_sex'  => $da_sex,
            'da_age'  => $da_age,

        );
         $validate = validate('Data');
         if(!$validate->scene('data')->batch()->check($data)){
             echo implode('|',$validate->getError());
             exit;
         }
        if(isset($_FILES["da_head"])){
            $da_head = $request->file("da_head");
            if($da_head){
                $info    = $da_head->move(ROOT_PATH.'public/men/'.$ad_name,$ad_name.'head');
                if($info){
                    $url     = 'men/'.$ad_name.'/'.$info->getSaveName();
                    $ad_head = json_encode(explode('/',$url));
                }else{
                    echo '图片处理失败';
                    exit;
                }
                if($this->head){
                    unlink(ROOT_PATH.'public'.$this->head);
                }
            }else{
                echo '图片过大，请从新上传';
                exit;
            }
        }

        $data = array(
            'ad_name' => $ad_name,
            'da_id'   => $da_id,
            'da_name' => $da_name,
            'da_sex'  => $da_sex,
            'da_age'  => $da_age,
            'da_head' => isset($ad_head)?$ad_head:json_encode(explode('/',$this->head)),
        );
        $model = model('Admin');
         $ret=$model->change($data);
        echo 1100;
    }

    /**
     * 修改密码
     */
    public function pass(){
        $request = Request::instance();
        $pass    = $request->param('pass');
        $Npass   = $request->param('Npass');
        $Npass2  = $request->param('Npass2');
        $validate = new Validate();
        $data     = array(
            'pass'   => $pass,
            'Npass'  => $Npass,
            'Npass2' => $Npass2,
        );
        if(!$validate->scene('pass')->batch()->check($data)){
            echo implode('|',$validate->getError());
            exit;
        }
        if($Npass!=$Npass2){
            echo '密码不相同';
            exit;
        }
        $model = model('admin');
        $ret=$model->pass($data);
        if($ret){
            echo 1100;
        }else{
            echo $ret;
        }

    }
}