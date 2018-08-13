<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/12
 * Time: 11:04
 */
namespace app\admin\model;
use think\Model;
use think\Session;
use think\Db;
class Advertise
{
    public function addAdvertising()
    {
          return view("add_Advertising");
    }
}