<?php
namespace app\index\Model;
use think\Model;
use think\Session;
use think\Db;



class Lidex extends Model{


    public function sey()
    {
        $re = Db::name('navbar')->select();
        return $re;
    }
    public function sele($id)
    {
        $re = Db::name('siteinfo')->where('sit_id',$id)->select();
        return $re;
    }



}