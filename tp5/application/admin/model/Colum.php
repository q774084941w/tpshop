<?php
namespace app\admin\model;
use think\Model;
use \think\Db;
class Colum extends Model
{
    public function sey()
    {
        $re = Db::name('navbar')->select();

        return $re;
    }

    public function col($data=array()){

            $re=Db::name('navbar')->insert($data);
       return $re;
    }
    //删除
    public function del_c($id){
        $re = Db::name('navbar')->where('nav_id',$id)->delete();
        return $re;
    }
    //修改状态  1为显示o为不显示
    public function updack($id){
        $re = Db::name('navbar')->where('nav_id',$id)->update(['nav_show'=>1]);
        return $re;
    }
    public function chece($id){
        $re = Db::name('navbar')->where('nav_id',$id)->update(['nav_show'=>0]);
        return $re;
    }

    public function select_ify_one($id)
    {
        $re = Db::name('navbar')->where('nav_id',$id)->find();
        return $re;
    }
    public function updata_ify($data=array(),$id)
    {
        $re = Db::name('navbar')->where('nav_id',$id)->update($data);
        return $re;
    }

}