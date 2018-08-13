<?php
/**
 * Created by PhpStorm.
 * User: xxl
 * Date: 2018/1/16
 * Time: 13:34
 * 用户权限管理
 */

namespace app\Admin\controller;

use think\Db;
use think\Request;
use think\Validate;

class Admin  extends NowController
{
    protected $power; //权限数据

    /**
     * @return \think\response\View
     * 管理员列表主页面
     */
    public function administrator_list(){
        if(!$this->power){
            $this->power = Db::table('tp_power')->select();
        }
        $this ->assign('power',$this->power);
        $rest = Db::table('tp_admin')->alias('a')->join('tp_admin_data d','a.da_id=d.da_id')->join('tp_power p','a.pow_id=p.pow_id')->paginate(10);
        //dump($rest);exit;
        $this->assign('admin',$rest);
        return view();
    }

    /**
     * 更改状态
     */
    public function takeState(){
        $request = Request::instance();
        $state   = $request->param('state');
        $ad_id   = $request->param('ad_id');
        $data    = array(
            'ad_state' => $state
        );
        Db::table('tp_admin')->where('ad_id',$ad_id)->update($data);
    }

    /**
     * @return \think\response\View
     * 添加管理员表格页面
     */
    public function add_administrator(){
            if(!$this->power){
                $this->power = Db::table('tp_power')->select();
            }
            $this ->assign('power',$this->power);
            return view();
    }

    /**
     * 添加管理员处理数据
     */
    public function addnew(){
        echo "<meta charset='utf-8'>";
            $request    = Request::instance();
            $ad_name    = $request->param('ad_name');
            $pow_id     = $request->param('pow_id');
            $pass       = $request->param('pass');
            $newpass    = $request->param('newpass');
            $da_name    = $request->param('da_name');
            $da_sex     = $request->param('da_sex');
            $da_age     = $request->param('da_age');
            $da_ramarks = $request->param('da_ramarks');

            $user       = array(
                'ad_name' => $ad_name,
                'pass' => $pass,
                'Npass' => $newpass,
            );

            $validate = validate('user');
            if(!$validate->scene('new')->batch()->check($user)){
                echo implode(',',$validate->getError());
                exit;
            }
            $data     = array(
                'da_name'    => $da_name,
                'da_sex'     => $da_sex,
                'da_age'     => $da_age,
                'da_remarks' => $da_ramarks,
            );
            //dump($data);exit;
            $validate = validate('data');
            if(!$validate->scene('new')->batch()->check($data)){
                echo implode(',',$validate->getError());
                exit;
            }
        $da_head    = request()->file('da_head');
        $info       = $da_head->move(ROOT_PATH.'public/men'.DS.$ad_name);
        if($info){
            $url     = 'men/'.$ad_name.'/'.$info->getSaveName();
            $da_head = json_encode(explode('/',$url));
        }else{
            echo '图片处理失败';
            exit;
        }
            $data     = array(
                'da_name'    => $da_name,
                'da_sex'     => $da_sex,
                'da_age'     => $da_age,
                'da_remarks' => $da_ramarks,
                'da_head'    => $da_head,
                'da_time'    => date('Y-m-d H:i:s'),
            );
            $model = model('admin');
            $da_id=$model-> addNew($data);
            //var_dump($da_id);exit;
            if(!$da_id){
                unlink($url);
                echo '资料保存失败';
                exit;
            }
            $user       = array(
                'ad_name' => $ad_name,
                'pass'    => $pass,
                'pow_id'  => $pow_id,
                'da_id'   => $da_id,
            );
            $ret = $model->addlogin($user);
            if($ret){
                echo 1100;
            }else{
                unlink($url);
                $model->table('tp_admin_data')->where('da_id',$da_id)->delete();
                echo '资料上传了一半失败了';
            }

    }

    /**
     * 删除管理员
     */
    public function dropAdmin(){
        $request = Request::instance();
        $id      = $request->param('id');
        if(isset($id)){
            $model   = model('admin');
            $model  -> dropAdmin($id);
            echo "1100";
        }else{
            echo '按顺序办事';
        }
    }

    public function changeAdmin(){
        $request = Request::instance();
        $pow_id  = $request->param('pow_id');
        $ad_id   = $request->param('ad_id');
        $data    = array(
            'pow_id'=>$pow_id
        );
        Db::table('tp_admin')->where('ad_id',$ad_id)->update($data);
    }

    /**
     * @return \think\response\View
     * 添加权利职位主页面
     * @admin 用户信息
     */
    public function add_Competence(){
        $rest  = Db::table('tp_admin')->paginate(10);
        $this->assign('admin',$rest);
        return view();
    }
    /**
     * @return \think\response\View
     * 权限设置
     */
    public function admin_Competence(){
        $db   = Db::table('tp_power');
        $rest = $db->select();
        //dump($rest);exit;
        $this->assign('pow',$rest);
        return view();
    }
    /**
     * 删除权限
     */
    public function droppower(){
        $request = Request::instance();
        $pow_id    = $request->param('pow_id');
        $result=Validate::is($pow_id,'number');
        if(!$result){
            echo '格式不符';
            exit;
        }
        $arr = array(1,2);
        if(!in_array($pow_id,$arr)){
           $model = model('power');
            $model->droppower($pow_id);
            echo 1100;

        }
        else{
            echo '你无权删除';
        }
    }
    /**
     * 更改权限名
     */
    public function powName(){
        $request      = Request::instance();
        $pow_id       = $request->param('pow_id');
        $pow_name     = $request->param('pow_name');
        $pow_describe = $request->param('pow_describe');
        if(empty($pow_id)||empty($pow_name)||empty($pow_describe)){
            echo '信息不能为空';
            exit;
        }
        $data  = array(
            'pow_id'       => $pow_id,
            'pow_name'     => $pow_name,
            'pow_describe' => $pow_describe,
        );
        $model = model('power');
        $model->powerName($data);
    }
}