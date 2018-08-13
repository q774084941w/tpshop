<?php
/**
 * Created by PhpStorm.
 * User: xxl
 * Date: 2018/1/27
 * Time: 16:09
 * 前台用户个人信息操作
 */

namespace app\index\Model;

use think\Db;
use think\Model;
use think\Session;

class Home extends  Model
{
    /**
     * 修改个人信息
     * @param array $data
     * @return bool
     */
    public function chengemeans($data,$id){
            $this->chenguser($data,$id);
            $this->FAddress($data,$id);
            $this->meansCh($data,$id);
            return true;
    }

    /**
     *  更改手机邮箱
     * @param array $data
     */
    public function chenguser($data,$id){
        $newdata = array(
            'u_phone' => $data['u_phone'],
            'u_email' => $data['u_email'],
        );
        Db::name('user')->where('u_id',$id)->update($newdata);
    }

    /**
     * 添加收货地址
     * @param $data
     * @return int|string
     */
    public function addAddress($data,$int){
        $address = json_encode(explode(',',$data['address']));
        $new = array(
            'a_name'    => $data['m_name'],
            'a_address' => $address,
            'a_phone'   => $data['u_phone'],
            'u_id'      => Session::get('u_id'),
            'a_default' => $int,
        );
        Db::name('user_address')->insert($new);
    }

    /**
     * 第一个地址
     * @param array $data
     */
    public function FAddress($data,$id){
        $arr=Db::name('user_address')->where('u_id',Session::get('u_id'))->find();
        if(!$arr){
            $this->addAddress($data,1);
        }else{
            $address = json_encode(explode(',',$data['address']));
            $new = array(
                'a_name'    => $data['m_name'],
                'a_address' => $address,
                'a_phone'   => $data['u_phone'],
                'a_default' => 1,
            );
            Db::name('user_address')->where('u_id',$id)->update($new);
        }
    }

    /**
     * 修改个人信息
     * @param array $data
     */
    public function meansCh($data,$id){
        $address = json_encode(explode(',',$data['address']));
        $means = array(
            'm_address'  => $address,
            'm_name'     => $data['m_name'],
            'm_sex'      => $data['m_sex'],
            'm_img'      => $data['m_img'],
            'm_birthday' => $data['m_birthday'],
        );
        Db::name('user_means')->where('u_id',$id)->update($means);
    }

    /**
     * 修改密码
     * @param $data
     * @param $id
     * @return int|string
     * @throws \think\Exception
     */
    public function pass($data,$id){
        $pass=Db::name('user')->where('u_id',$id)->field('pass')->find();
        if($pass==$data['pass']){
            $arr = array(
                'pass'=> $data['Npass'],
            );
            Db::name('user')->where('u_id',$id)->update($arr);
            return true;
        }else{
            return '密码错误';
        }
    }

    /**
     * 查询客户的收货地址
     * @param int $u_id
     * @return array
     */
    public function getAllAdress($u_id)
    {
        $address = Db::name('user_address')->where('u_id',$u_id)->select();
        return $this->getAddress($address,'a_');
    }

    /**
     * 处理地址
     * @param array $data
     * @param string $auto
     * @return array
     */
    public function getAddress($data,$auto){
        $arr = array();
        foreach($data as $k=>$val){
            foreach($val as $key=>$value){
                $arr[$k][$key] = $value;
                if($key==$auto.'address'){
                    $arr[$k][$key] = json_decode($value);
                }
            }
        }
        return $arr;
    }

    /**
     * 删除地址
     * @param int $a_id
     * @return int
     * @throws \think\Exception
     */
    public function dropAddress($a_id){
        return Db::name('user_address')->where('a_id',$a_id)->delete();

    }
}