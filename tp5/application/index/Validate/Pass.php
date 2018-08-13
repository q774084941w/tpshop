<?php

/**
 * Created by PhpStorm.
 * User: XXL
 * Date: 2018/1/12
 * Time: 22:01
 *
 */
namespace app\index\Validate;
use think\Validate;

class Pass extends Validate
{
    protected $rule = array(
        'ad_name'  => 'require|max:20',
        'pass'     => 'require|max:20',
        'Npass'    => 'require|max:20',
        'Npass2'   => 'require|max:20',
        'captcha'  => 'require|captcha',
    );
    protected $message = array(
        'ad_name.require'  => '用户名不能为空',
        'ad_name.max:20'   => '用户名不能超出限制个数',
        'pass.max:20'      => '密码不能超出限制个数',
        'Npass.max:20'     => '密码不能超出限制个数',
        'Npass2.max:20'    => '密码不能超出限制个数',
        'pass.require'     => '密码不能为空',
        'Npass.require'    => '密码不能为空',
        'Npass2.require'   => '密码不能为空',
        'captcha.require'  => '验证码不能为空',
        'captcha.captcha'  => '验证码不符',
    );
    protected $scene = array(
        'login' => array('ad_name', 'pass', 'captcha'),
        'pass'  => array('pass', 'Npass', 'Npass2'),
        'new'   => array('ad_name', 'pass', 'Npass'),
    );
}