<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 14:50
 */
namespace app\index\Model;

use app\index\controller\Begin;
use think\Db;
use think\Model;
use think\Session;

class User extends Model
{
    /**
     * @param  array $data
     * @return bool|int|string
     * 注册
     */
    public function register($data){
        if(isset($data['u_email'])){
            $ret = $this->ishave('u_email',$data['u_email']);
            if(!$ret){
                $id = Db::name('user')->insert($data,false,true);
                $this->takeMeans($id);
                Session::set('e_name',$data['u_email']);
                $mail = new Begin();
                return $mail->mail($data['u_email'],$id);
            }else{
                return '用户已经存在';
            }
        }elseif(isset($data['u_phone'])){
            $ret = $this->ishave('u_phone',$data['u_phone']);
            if(!$ret){
                $id = Db::name('user')->insert($data);
                $this->setUid($id,$data['u_phone']);
                return $this->takeMeans($id);
            }else{
                return '用户已经存在';
            }
        }else{
            return '数据格式不符合';
        }
    }

    /**
     * @param int $id
     * @return int|string
     * 添加资料库
     */
    protected function takeMeans($id){
        $data = array(
            'u_id'=>$id
        );
        return Db::table('tp_user_means')->insert($data);
    }
    /**
     * @param string $name
     * @param string $val
     * @return array|false|\PDOStatement|string|Model
     * 判断用户是否存在
     */
    protected function ishave($name,$val){
        return Db::name('user')->where($name,$val)->find();
    }

    /**
     * @param int $id
     * @return bool|string
     * @throws \think\Exception
     * 邮箱激活
     */
    public function takestate($id){
        $all   = Db::table('tp_user')->field('u_id,u_time')->select();
        $yesid = null;
        $true  = false;
        foreach($all as $val) {
            if(md5($val['u_id'])===$id){
                $b = time()-strtotime($val["u_id"]);
                if($b<12*60*60*100000){
                    $name = Session::get('e_name');
                    if(!isset($name)){
                        return '您的连接已经过时';
                    }
                    $this->setUid($val['u_id'],$name);
                    $data  = array(
                        'u_state' =>1
                    );
                    Db::table('tp_user')->where('u_id',$val['u_id'])->update($data);
                    $true=true;
                    break;
                }else{
                    return '您的连接已经过时';
                }
            }
        }
        if(!$true){
            return '该用户不存在';
        }else{
            return $true;
        }
    }

    /**
     * @param array $data
     * @param string $key
     * @return bool|string
     * 验证登录
     */
    public function login($data,$key){
        $pass = Db::table('tp_user')->where($key,$data[$key])->field('u_id,pass,u_state')->find();
        if($pass){
            if($pass['u_state']==0){
                return '您已经被冻结';
            }else{
                if($pass['pass']==md5($data['pass'])){
                    $this->setUid($pass['u_id'],$data[$key]);
                    return true;
                }else{
                    return '账号或者密码错误';
                }
            }
        }else{
            return '该用户未注册';
        }
    }

    /**
     * @param int $id
     * @param string $name
     * 登录保存信息
     */
    protected function setUid($id,$name){
        Session::set('u_id',$id);
        Session::set('name',$name);
    }

    /**
     * 获取用户账户信息
     * @param int $id
     * @return array|false|\PDOStatement|string|Model
     */
    public function getUser($id){
        return Db::name('user')->where('u_id',$id)->find();
    }
}