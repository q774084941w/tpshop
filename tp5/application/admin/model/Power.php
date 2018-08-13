<?php
/**
 * Created by PhpStorm.
 * User: XXL
 * Date: 2018/1/17
 * Time: 13:05
 * 权限表操作
 */

namespace app\admin\model;


use think\Db;
use think\Model;

class Power extends Model
{
    /**
     * @param int $pow_id
     * 删除权利
     */
    public function droppower($pow_id){
        $this->changeid($pow_id);
        $this->drophave($pow_id);
        $this->where('pow_id',$pow_id)->delete();
    }

    /**
     * @param int $pow_id
     * @throws \think\Exception
     * 将永远该权利的用户全部改成最低权利
     */
    public function changeid($pow_id){
        $arr = array(
            'pow_id' => '2'
        );
        $ad_id = Db::table('tp_admin')->field('ad_id')->where('pow_id',$pow_id)->select();
        foreach($ad_id as $val){
            Db::table('tp_admin')->where('ad_id',$val['ad_id'])->update($arr);
        }
    }

    /**
     * @param  int $pow_id
     * @throws \think\Exception
     * 删除权限拥有权限记录
     */
    public function drophave($pow_id){
        $DB  = Db::table('tp_power_have');
        $DB->where('pow_id',$pow_id)->delete();
    }

    /**
     * @param array $data
     * 更改权限名称
     */
    public function powerName($data){
        $id = array_shift($data);
        $this->where('pow_id',$id)->update($data);
    }

    /**
     * @param array $name
     * @param int $id
     * @return bool
     * 分配权利
     */
    public function takehave($name,$id){
        $this->clear($id);
        foreach($name as $val){
            $data = array(
                'pow_id' => $id,
                'fun_id' => $val,
            );
            Db::table('tp_power_have')->insert($data);
        }
        return true;
    }


    /**
     * @param int $id
     * 清空所有权利
     */
    protected function clear($id){
        Db::table('tp_power_have')->where('pow_id',$id)->delete();
    }
}