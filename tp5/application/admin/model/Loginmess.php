<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/13
 * Time: 14:52
 */

namespace app\admin\model;


use think\Model;
use think\Session;

class Loginmess extends Model
{
    /**
     * @param array $data
     * 记录登录的时间 IP
     */
    public function take($data){
        $name=$this->table('tp_power')->where('pow_id',$data['pow_id'])->find();
        $arr = array(
            'pow_name'   => $name['pow_name'],
            'ad_id'      => $data['ad_id'],
            'login_time' => date('Y-m-d H:i:s'),
            'login_ip'   => $_SERVER['SERVER_ADDR']
        );
        $id=$this->table('tp_loginmess')->insert($arr,false,true);
        Session::set('lo_id',$id);
    }
}