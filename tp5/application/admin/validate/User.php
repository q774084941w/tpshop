<?php

/**
 * Created by PhpStorm.
 * User: XXL
 * Date: 2018/1/12
 * Time: 22:01
 *
 */
namespace app\admin\validate;
use think\Validate;

class User extends Validate
{
    protected $rule = array(
        'ad_name'  => 'require|max:20',
        'pass'     => 'require|max:20',
        'Npass'    => 'require|max:20',
        'Npass2'   => 'require|max:20',
        'captcha'  => 'require|captcha',
        'discount' => 'require',
    );
    protected $message = array(
        'ad_name.require'  => '用户名不能为空',
        'ad_name.max:20'   => '用户名不能超过20个',
        'pass.max:20'      => '密码不能超过20个',
        'Npass.max:20'     => '密码不能超过20个',
        'Npass2.max:20'    => '密码不能超过20个',
        'pass.require'     => '密码不能为空',
        'Npass.require'    => '密码不能为空',
        'Npass2.require'   => '密码不能为空',
        'captcha.require'  => '验证码不能为空',
        'discount.require' => '优惠不能为空',
        'captcha.captcha'  => '验证码不符',
    );
    protected $scene = array(
        'login' => array('ad_name', 'pass', 'captcha'),
        'pass'  => array('pass', 'Npass', 'Npass2'),
        'new'   => array('ad_name', 'pass', 'Npass'),
        'vip'   => array('ad_name','discount'),
    );
}