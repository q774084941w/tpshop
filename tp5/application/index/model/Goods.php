<?php
/**
 * 商品查询
 */

namespace app\index\Model;
use think\Model;
use think\Db;

class Goods extends Model
{
    /**
     * @return array
     * 主页显示推荐商品信息
     */
    public function select_goods()
    {
        $re = Db::name('goods_cla')->where('choose',1)->select();
        $fe = Db::name('goods_cla')->where('cla_fid',0)->where('choose',1)->select();
        $data = [];
        foreach($fe as $val){
            $arr = [];
            $son = [];
            foreach($re as $vals){
                if($vals['cla_fid']==$val['cla_id']){
                    $arr[] = $vals;
                }
            }

            foreach($arr as $v){
                $son1 = [];
                $shop = [];
                foreach($re as $vs){
                    if($vs['cla_fid']==$v['cla_id']){
                        $son1[]=$vs;
                        $shop[]= Db::name('goods')->where('cla_id',$vs['cla_id'])->where('is_recommend',1)->select();
                    }
                }
                $v['son1']=$son1;
                $v['shop']=$shop;
                $son[] = $v;
            }
            $val['son']=$son;
            $data[] = $val;
        }

        return $data;
    }

    /**
     * @param $id
     * @return array|false|\PDOStatement|string|Model
     * 商品详情信息查询
     */
    public function select_goodsm($id)
    {
        $re = Db::name('goods')->where('g_id',$id)->find();
        return $re;
    }

    /**
     * @param $id
     * @return false|\PDOStatement|string|\think\Collection
     * 商品图片查询
     */
    public function select_goodsimg($id)
    {
        $re = Db::name('goods_img')->where('g_id',$id)->select();
        return $re;
    }

    /**
     * @param $id
     * @return false|\PDOStatement|string|\think\Collection
     * 商品规格查询
     */
    public function select_goodsspec($id)
    {
        $re = Db::name('goods_spec')->where('g_id',$id)->select();
        return $re;
    }

    /**
     * @param $id
     * @return false|\PDOStatement|string|\think\Collection
     * 根据分类查询推荐商品
     */
    public function select_clagoods($id)
    {
        $re = Db::name('goods')->where('cla_id',$id)->where('is_recommend',1)->select();
        return $re;
    }

    /**
     * @param $id
     * @return false|\PDOStatement|string|\think\Collection
     * 根据分类ID查询品牌
     */
    public function select_brand($id)
    {
        $re = Db::name('goods_brand')->where('cla_id',$id)->select();
        return $re;
    }

    /**
     * @param $id
     * @return false|\PDOStatement|string|\think\Collection
     * 根据分类查询所有商品
     */
    public function select_clagoodsn($id)
    {
        $re = Db::name('goods')->where('cla_id',$id)->select();
        return $re;
    }

    /**
     * @param $name
     * @return false|mixed|\PDOStatement|string|\think\Collection
     * 商品搜索
     */
    public function select_goodsmohu($name)
    {
        $re = Db::name('goods')->where("keyword",'like','%%'.$name.'%%')->select();
        return $re;
    }

    /**
     * @param $name
     * @return array
     * 导航新模块信息查询
     */
    public function goods_mdu($name)
    {
        $datagoods = [];
        $databrand = [];
        $dataify = [];
        $fre = Db::name('goods_cla')->where("cla_name",'like','%%'.$name.'%%')->find();
        $re  = Db::name('goods_cla')->where('cla_fid',$fre['cla_id'])->select();
        foreach($re as $vl){
            $son = Db::name('goods_cla')->where('cla_fid',$vl['cla_id'])->select();
            $dataify[] = $son;
            foreach($son as $v){
                $databrand[] = Db::name("goods_brand")->where("cla_id",$v['cla_id'])->select();
                $datagoods[] = Db::name("goods")->where("cla_id",$v['cla_id'])->where('is_on_sale',1)->where('is_recommend',1)->select();
            }
        }

        return [$dataify,$databrand,$datagoods];
    }

    /**
     * @param $id
     * @return false|mixed|\PDOStatement|string|\think\Collection
     * 根据品牌查询商品
     */
    public function select_brand_goods($id)
    {
        $re = Db::name('goods')->where('brand_id',$id)->select();
        return $re;
    }
}