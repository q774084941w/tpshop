<?php
/**
 * Created by PhpStorm.
 * User: XXL
 * Date: 2018/1/17
 * Time: 15:34
 * 权限分配方法
 */

namespace app\Admin\controller;


use think\Db;
use think\Request;

class Power extends NowController
{

    /**
     * @return \think\response\View
     * 分配权限页面
     */
    public function index($id){
        $have = Db::table('tp_power_fun')->alias('f')->join('tp_power_have h','h.fun_id=f.fun_id')->field('f.fun_id,fun_name')->where('pow_id',$id)->select();
        $all  = Db::table('tp_power_fun')->field('fun_id,fun_name')->select();
        $had  = $this->found($have);
        $all  = $this->found($all);
        $not  = array_diff($all,$had);
        $had  = $this->roback($had);
        $not  = $this->roback($not);
        $this->assign('had',$had);
        $this->assign('not',$not);
        return view('take');
    }

    /**
     * @param  array $arr
     * @return array
     * 降维处理
     */
    protected function found($arr){
        $narr = array();
        foreach($arr as $val){
            $v = implode(',',$val);
            $narr[] = $v;
        }
        return $narr;
    }

    /**
     * @param  array $arr
     * @return array
     * 升维
     */
    protected function roback($arr){
        $narr = array();
        foreach($arr as $val){
            $v = explode(',',$val);
            $narr[] = $v;
        }
        return $narr;
    }
    /**
     * 添加权利
     */
    public function addpow(){
        $request      = Request::instance();
        $pow_describe = $request->param('pow_describe');
        $pow_name     = $request->param('pow_name');
        $data = array(
            'pow_describe' => $pow_describe,
            'pow_name'     => $pow_name,
        );
        $validate = validate('Another');
        if(!$validate->scene('power')->batch()->check($data)){
            echo implode(',',$validate->getError());
            exit;
        }
        $model = model('power');
        $model->table('tp_power')->insert($data);
        echo 1100;
    }

    /**
     * 分配权利
     * @return bool
     */
    public function gethave(){
        $request = Request::instance();
        $name    = json_decode($request->param('name'));
        $id      = $request->param('id');
        if(isset($id)){
           $model = model('power');
           $model->takehave($name,$id);
            echo 1100;
        }else{
            echo '出错啦';
        }

    }


}