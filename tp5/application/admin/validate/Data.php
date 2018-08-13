<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 15:27
 */

namespace app\admin\validate;


use think\Validate;

class Data extends Validate
{
    protected $rule = array(
        'da_id'      => 'require|number',
        'ad_name'    => 'require|max:20|alphaDash',
        'da_name'    => 'require|max:20|chsDash',
        'da_sex'     => 'require|chs',
        'da_age'     => 'require|number',
        'da_remarks' => 'require',
    );
    protected $message = array(
        'da_id.number'       => '号数类型不符合',
        'da_id.require'      => '号数不能为空',
        'ad_name.require'    => '账号不能为空',
        'ad_name.max:20'     => '账号超过限制个数',
        'ad_name.alphaDash'  => '账号格式不符合',
        'da_name.chsDash'    => '昵称格式不符合',
        'da_name.max:20'     => '昵称超过限制个数',
        'da_name.require'    => '昵称不能为空',
        'da_age.require'     => '年龄不能为空',
        'da_age.number'      => '年龄格式错误',
        'da_sex.require'     => '性别不能为空',
        'da_sex.chs'         => '性别格式错误',
        'da_remarks.require' => '没有备注',
    );
    protected $scene = array(
        'data' => array('da_id','ad_name','da_name','da_sex','da_age'),
        'new'  => array('da_name','da_sex','da_age','da_remarks'),
    );
}