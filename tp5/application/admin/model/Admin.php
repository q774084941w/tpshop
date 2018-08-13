<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/13
 * Time: 9:26
 */

namespace app\admin\model;


use think\Db;
use think\Model;
use think\Session;

class Admin extends Model
{
    /**
     * @param array $data
     * @return int|string
     * 处理账号
     */
    public function login($data){
        $result=$this->where('ad_name',$data['ad_name'])->find();
        //return $result;
        if(!$result){
            return '用户还未注册';
        }else{
            if($result['pass']==$data['pass']){
                Session::set('ad_name',$result['ad_name']);
                Session::set('ad_id',$result['ad_id']);
                Session::set('pow_id',$result['pow_id']);
                $login = model('loginmess');
                $login->take($result);
                return 1100;
            }else{
                return '账号或者密码错误';
            }
        }
    }

    /**
     * @param array $data
     * 更改个人信息，和账号
     */
    public function change($data){
        $arr = array(
            'ad_name' => $data['ad_name']
        );
        $id = Session::get('ad_id');
        if(!$id){
            return '数据不足';
        }
        $this->where('ad_id',$id)->update($arr);
        array_shift($data);
        $id = $data['da_id'];
        array_shift($data);
        $this->table('tp_admin_data')->where('da_id',$id)->update($data);
        return true;
    }

    /**
     * @param array $data
     * 更改密码
     */
    public function pass($data){
        $id   = Session::get('ad_id');
        if(!$id){
            return '数据不足';
        }
        $pass = Db::table('tp_admin')->field('pass')->where('ad_id',$id)->find();
        if($pass['pass']!=$data['pass']){
            return '密码错误';
        }else{
            $data = array('pass'=>md5($data['Npass']));
            Db::table('tp_admin')->where('ad_id',$id)->update($data);
            return true;
        }

    }

    /**
     * @param array $date
     * @return int|string
     * 添加新用户个人资料
     */
    public function addNew($date){
        return $this->table('tp_admin_data')->insert($date,false,true);
    }

    /**
     * @param array $user
     * @return bool
     * 添加用户登录资料
     */
    public function addlogin($user){
         if($this->insert($user)){
            return true;
         }else{
             return false;
         }
    }

    /**
     * @param int $id
     * 删除用户信息
     */
    public function dropAdmin($id){
        $this->table('tp_admin_data')->where('da_id',$id)->delete();
        $this->where('da_id',$id)->delete();
    }
}