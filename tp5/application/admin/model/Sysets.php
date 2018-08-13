<?php
namespace app\admin\model;
use think\Model;
use \think\Db;
class Sysets extends Model
{
    public function sele($id)
     {
        $re = Db::name('siteinfo')->where('sit_id',$id)->select();
        return $re;
        }
    public function star($date=array())
    {

        $re= Db::name('siteinfo')->where('sit_id',1)->update($date);
          return $re;

        }
}