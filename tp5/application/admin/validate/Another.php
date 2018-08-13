<?php
/**
 * Created by PhpStorm.
 * User: XXL
 * Date: 2018/1/17
 * Time: 18:31
 */

namespace app\admin\validate;


use think\Validate;

class Another extends Validate
{
    protected $rule = array(
        'pow_describe' => 'require|chsDash',
        'pow_name'     => 'require|max:20|chsDash',

    );
    protected $message = array(
        'pow_describe.require'   => '描述不能为空',
        'pow_describe.chsDash' => '描述格式不符合',
        'pow_name.chsDash'   => '名称格式不符合',
        'pow_name.max:20'    => '名称超过限制个数',
        'pow_name.require'   => '名称不能为空',
    );
    protected $scene = array(
        'power' => array('pow_describe','pow_name')
    );
}