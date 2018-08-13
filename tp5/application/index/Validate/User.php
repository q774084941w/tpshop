<?php
/**
 * Created by PhpStorm.
 * User: XXL
 * Date: 2018/1/6
 * Time: 10:39
 */

namespace app\index\Validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'u_name'     =>  'require|max:50',
        'm_name'     =>  'require|max:50',
        'address'    =>  'require',
        'm_birthday' =>  'require|date',
        'm_sex'      =>  'require|in:男,女,保密',
        'u_email'    =>  'require|email',
        'u_phone'    =>  'require|max:11|/^1[3-8]{1}[0-9]{9}$/',
        'pass'       => 'require|max:25',
    ];
    protected $message = [
      'u_email.require'     => '邮箱不能为空',
      'u_name.require'      => '用户名不能为空',
      'm_name.require'      => '姓名不能为空',
      'address.require'     => '地址不能为空',
      'm_birthday.require'  => '生日不能为空',
      'm_birthday.date'     => '生日格式错误',
      'm_sex.require'       => '性别不能为空',
      'm_sex.in:男,女,保密' => '性别格式错误',
      'm_name.max:50'       => '姓名长度过长',
      'u_email.email'       => '邮箱格式错误',
      'pass.require'        => '密码不能为空',
      'u_phone.require'     => '请输入手机号码',
      'u_phone.max:11'      => '手机号码最多不能超过11个位',
      'pass.max:25'         => '密码超过限制位数',
      'u_name.max:50'       => '用户名超过限制位数',
      'u_phone./^1[3-8]{1}[0-9]{9}$/'  => '手机号码格式不正确',
    ];
    protected $scene = [
        'u_email' => ['u_email','pass'],
        'u_phone' => ['u_phone','pass'],
        'u_name'  => ['u_name','pass'],
        'means'   => ['m_name','m_sex','m_birthday','u_phone','u_email','address'],
        'address' => ['m_name','u_phone','address'],
    ];

}