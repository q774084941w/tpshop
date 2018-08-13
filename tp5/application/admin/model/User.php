<?php
/**
 * Created by PhpStorm.
 * User: XXL
 * Date: 2018/1/24
 * Time: 17:09
 */

namespace app\admin\model;


use think\Db;
use think\Model;

class User extends Model
{
    /**
     * @param array $date
     * @throws \think\Exception
     * 删除用户数据
     */
    public function dropMen($date)
    {
        foreach ($date as $val) {
            Db::table('tp_user_address')->where('u_id', $val)->delete();
            Db::table('tp_user_means')->where('u_id', $val)->delete();
            Db::table('tp_user')->where('u_id', $val)->delete();
        }
    }

    /**
     * @param array $date
     * @return bool
     * 关闭用户
     */
    public function closeMen($date)
    {
        foreach ($date as $val) {
            $data = array(
                'u_state' => 0
            );
            $this->where('u_id', $val)->update($data);
        }
    }

    /**
     * @param array $date
     * @return bool
     * 关闭用户
     */
    public function openMen($date)
    {
        foreach ($date as $val) {
            $data = array(
                'u_state' => 1
            );
            $this->where('u_id', $val)->update($data);
        }
    }

}