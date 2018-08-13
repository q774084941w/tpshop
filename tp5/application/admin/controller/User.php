<?php
/**
 * Created by PhpStorm.
 * User: xxl
 * Date: 2018/1/20
 * Time: 16:39
 * 前台用户管理
 */

namespace app\Admin\controller;


use think\Db;
use think\Request;

class User extends NowController
{
    /**
     * @return \think\response\View
     * 用户列表
     */
    public function index(){
        $all=Db::table('tp_user')->alias('u')->join('tp_user_means m','u.u_id=m.u_id')->join('tp_user_vip v','v.v_id=m.v_id')->select();
        $this->assign('user',$all);
        return view();
    }

    /**
     * 删除用户处理
     */
    public function dropMen(){
        $request = Request::instance();
        $all     = json_decode($request->param('str'));
        //var_dump($all);
        if(!is_int($all[0])){
            array_shift($all);
        }
        if($all!=array()){
            $model   = model('user');
            $model->dropMen($all);
            echo 1100;
        }else{
            echo '没有删除的数据';
        }

    }

    /**
     * 关闭用户
     */
    public function closeMen(){
        $request = Request::instance();
        $all     = json_decode($request->param('str'));
        if(!is_int($all[0])){
            array_shift($all);
        }
        if($all!=array()){
            $model   = model('user');
            $model->closeMen($all);
            echo 1100;
        }else{
            echo '没有删除的数据';
        }
    }

    /**
     * 关闭用户
     */
    public function openMen(){
        $request = Request::instance();
        $all     = json_decode($request->param('str'));
        if(!is_int($all[0])){
            array_shift($all);
        }
        if($all!=array()){
            $model   = model('user');
            $model->openMen($all);
            echo 1100;
        }else{
            echo '没有删除的数据';
        }
    }

    /**
     * @return \think\response\View
     * vip列表
     */
    public function vip(){
        $vip=Db::table('tp_user_vip')->select();
        $this->assign('vip',$vip);
        return view();
    }

    /**
     * 添加vip
     */
    public function addvip(){
        $request = Request::instance();
        $v_name  = $request->param('v_name');
        $v_grade = $request->param('v_grade');
        $validate = validate('user');
        $data     = array(
            'ad_name'  => $v_name,
            'discount' => $v_grade,
        );
        if(!$validate->scene('vip')->batch()->check($data)){
            echo implode($validate->getError());
            exit;
        }
        $data     = array(
            'v_name'  => $v_name,
            'v_grade' => $v_grade,
        );
        $model = model('power');
        $ret   = $model->table('tp_user_vip')->insert($data);
        if($ret){
            echo 1100;
        }else{
            echo $ret;
        }
    }

    /**
     * 删除vip
     */
    public function dropVip(){
        $request = Request::instance();
        $id      = $request->param('id');
        if(empty($id)){
            echo '数据接收失败';
            exit;
        }
        $model = model('user');
        $ret   = $model->table('tp_user_vip')->where('v_id',$id)->delete();
        if($ret){
            echo 1100;
        }else{
            echo $ret;
        }
    }

    /**
     * 更改vip
     */
    public function changeVip(){
        $request = Request::instance();
        $v_id    = $request->param('v_id');
        $v_name  = $request->param('v_name');
        $v_grade = $request->param('v_grade');
        if(empty($v_name)||empty($v_id)||empty($v_grade)){
            echo '信息不能为空';
            exit;
        }
        $data = array(
            'v_name'  => $v_name,
            'v_grade' => $v_grade,
        );
        $model = model('user');
        $ret   = $model->table('tp_user_vip')->where('v_id',$v_id)->update($data);
        if($ret){
            echo 1100;
        }else{
            echo $ret;
        }
    }
}