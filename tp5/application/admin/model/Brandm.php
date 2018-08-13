<?php
/**
 *品牌处理
 */
namespace app\admin\model;

use think\Db;
use think\Model;

class Brandm extends Model
{
    /**
     * @param array $data
     * @return int|string
     * 添加品牌
     */
    public function brand_add($data=array())
    {
        $re = Db::name('goods_brand')->insert($data);
        return $re;
    }

    /**
     * @return array|false|\PDOStatement|string|\think\Collection
     * 查询所有品牌
     */
    public function brand_select_all()
    {
        $re = Db::name('goods_brand')->select();
        return $re;
    }
    /**
     * @return \think\Paginator
     * 品牌分页查询
     */
    public function brand_select()
    {
        $re = Db::name('goods_brand')->paginate(10);
        return $re;
    }

    /**
     * @param $id
     * @return false|int|string
     * 修改状态为不推荐
     */
    public function brand_check($id)
    {
        $re = Db::name('goods_brand')->where('b_id',$id)->update(['b_choose'=>0]);
        return $re;
    }

    /**
     * @param $id
     * @return false|int|string
     * 修改状态为推荐
     */
    public function brand_check_b($id)
    {
        $re = Db::name('goods_brand')->where('b_id',$id)->update(['b_choose'=>1]);
        return $re;
    }

    /**
     * @param $id
     * @return false|int
     * 品牌单个删除
     */
    public function brand_delete($id)
    {
        $re = Db::name('goods_brand')->where('b_id',$id)->delete();
        return $re;
    }

    /**
     * @param $id
     * @return array|false|mixed|null|\PDOStatement|string|Model
     * 品牌单个查询
     */
    public function brand_select_f($id)
    {
        $re = Db::name('goods_brand')->where('b_id',$id)->find();
        return $re;
    }

    /**
     * @param array $data
     * @param $id
     * @return false|int|string
     * 品牌修改
     */
    public function brand_updata($data=array(),$id)
    {
        $re = Db::name('goods_brand')->where('b_id',$id)->update($data);
        return $re;
    }

    /**
     * @param $name
     * @return array|false|mixed|\PDOStatement|string|\think\Collection
     * 品牌模糊查询
     */
    public function brand_select_once($name)
    {
        $re = Db::name('goods_brand')->where("b_name",'like','%'.$name.'%')->paginate(10);
        return $re;
    }
}