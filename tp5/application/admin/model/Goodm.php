<?php
/**
 * 商品页面处理
 */
namespace app\Admin\model;
use Think\Db;
use think\Model;

class Goodm extends Model
{
    /**
     * @param array $data
     * @return int|string
     * 添加商品分类
     */
    public function add_ify($data=array())
    {
        $re = Db::name("goods_cla")->insert($data);
        return $re;
    }

    /**
     * @param $id
     * @return false|mixed|\PDOStatement|string|\think\Collection
     * 查询顶级分类
     */
    public function select_ify($id)
    {
        $re = Db::name('goods_cla')->where('cla_fid',$id)->select();

        return $re;

    }

    /**
     * @return array
     * 查询所有分类并排序
     */
    public function select_ifya()
    {
        $re = Db::name('goods_cla')->select();
        if($re){
            $se = self::select_if($re);
        }else{
            $se = [];
        }

        return $se;

    }

    /**
     * @param $list
     * @param int $fid
     * @param int $pre
     * @return array
     * 递归查询所有分类
     */
    static public function select_if($list,$fid=0,$pre=1)
    {
        static $data = [];
        foreach($list as $val){
            if($val['cla_fid']==$fid){
                $val['pre'] = $pre;
                $data[]      = $val;
                self::select_if($list,$val['cla_id'],$pre+1);
            }
        }
        return $data;
    }
    /**
     * @param $id
     * @return false|\PDOStatement|string|\think\Collection
     * 根据上级分类ID查询下级分类
     */
    public function select_nextf($id)
    {
        $re = Db::name('goods_cla')->where('cla_fid',$id)->select();
        return $re;
    }

    /**
     * @param $id
     * @return int|string
     * 修改商品分类为显示
     */
    public function updata_choose_check($id)
    {
        $re = Db::name('goods_cla')->where('cla_id',$id)->update(['choose'=>1]);
        return $re;
    }

    /**
     * @param $id
     * @return int|string
     * 修改商品分类为不显示
     */
    public function updata_choose($id)
    {
        $re = Db::name('goods_cla')->where('cla_id',$id)->update(['choose'=>0]);
        return $re;
    }

    /**
     * @param $id
     * @return bool
     * 删除商品分类
     */
    public function delete_ify($id)
    {
        $re = $this->delete_son($id);
        if($re){
            $se = Db::name('goods_cla')->where('cla_id',$id)->delete();
            return $se;
        }else{
            return false;
        }

    }
    /**
     * @param $id
     * @return bool
     * 循环删除相对子分类
     */
    public function delete_son($id){
        $re = Db::name('goods_cla')->where('cla_fid',$id)->select();
        if(empty($re)){
            //删除分类
            return true;
        }else{
            Db::name('goods_cla')->where('cla_fid',$id)->delete();
            for($i=0;$i<count($re);$i++){
                $this->delete_son($re[$i]['cla_id']);
            }
            return true;
        }

    }

    /**
     * @param $id
     * @return array|false|mixed|null|\PDOStatement|string|Model
     * 查询单个分类信息
     */
    public function select_ify_one($id)
    {
        $re = Db::name('goods_cla')->where('cla_id',$id)->find();
        return $re;
    }

    /**
     * @param array $data
     * @param $id
     * @return false|int|string
     * 分类信息修改
     */
    public function updata_ify($data=array(),$id)
    {
        $re = Db::name('goods_cla')->where('cla_id',$id)->update($data);
        return $re;
    }

    /**
     * @param array $data
     * @return int|string
     * 商品添加
     */
    public function add_goods($data=array())
    {
        $re = Db::name("goods")->insert($data);
        return $re;
    }

    /**
     * @return array|false|\PDOStatement|string|\think\Collection
     * 分页查询所有商品
     */
    public function select_goodsAll()
    {
        $re = Db::name('goods')->paginate(10);
        return $re;
    }

    /**
     * @param $id
     * @param $num
     * @return false|int|string
     * 修改是否新品状态
     */
    public function updata_goodnew($id,$num)
    {
        $re = Db::name('goods')->where('g_id',$id)->update(['is_new'=>$num]);
        return $re;
    }

    /**
     * @param $id
     * @param $num
     * @return false|int|string
     * 修改是否推荐状态
     */
    public function updata_goodre($id,$num)
    {
        $re = Db::name('goods')->where('g_id',$id)->update(['is_recommend'=>$num]);
        return $re;
    }

    /**
     * @param $id
     * @param $num
     * @return false|int|string
     * 修改是否包邮状态
     */
    public function updata_shipping($id,$num)
    {
        $re = Db::name('goods')->where('g_id',$id)->update(['is_free_shipping'=>$num]);
        return $re;
    }

    /**
     * @param $id
     * @param $num
     * @return false|int|string
     * 修改是否上架
     */
    public function updata_sale($id,$num)
    {
        $re = Db::name('goods')->where('g_id',$id)->update(['is_on_sale'=>$num]);
        return $re;
    }

    /**
     * @param $id
     * @return array|false|mixed|\PDOStatement|string|\think\Collection
     * 查询商品图片
     */
    public function select_goddsimg($id){
        $re = Db::name('goods_img')->where('g_id',$id)->select();
        return $re;
    }

    /**
     * @param array $data
     * @return int|string
     * 添加商品图片
     */
    public function add_goodsimg($data=array())
    {
        $re = Db::name('goods_img')->insert($data);
        return $re;
    }

    /**
     * @param $id
     * @return int
     * 删除商品图片
     */
    public function delete_goodsimg($id)
    {
        $re = Db::name('goods_img')->where('img_id',$id)->delete();
        return $re;
    }

    /**
     * @param $id
     * @return array|false|mixed|\PDOStatement|string|\think\Collection
     * 查询商品规格
     */
    public function select_goodsprec($id)
    {
        $re = Db::name('goods_spec')->where('g_id',$id)->select();
        return $re;
    }

    /**
     * @param array $data
     * @return int|string
     * 添加商品规格
     */
    public function add_goodsprec($data = array())
    {
        $re = Db::name('goods_spec')->insert($data);
        return $re;
    }

    /**
     * @param $id
     * @return false|int|string
     * 修改 商品库存
     */
    public function updata_goodsCount($id)
    {
        $cuo = Db::name('goods_spec')->where('g_id',$id)->column('sto_count');
        $num = 0;
        if(!empty($cuo)){
            for($i=0;$i<count($cuo);$i++){
                $num += $cuo[$i];
            }
        }
        $data = [
            'sto_num'=>$num
        ];
        $re = Db::name('goods')->where('g_id',$id)->update($data);

        return $re;
    }

    /**
     * @param $id
     * @return false|int
     * 根据规格ID删除商品规格
     */
    public function delete_spec($id)
    {
        $re = Db::name('goods_spec')->where('spec_id',$id)->delete();
        return $re;
    }

    /**
     * @param array $data
     * @param $id
     * @return false|int|string
     * 修改商品规格
     */
    public function updata_spec($data=array(),$id)
    {
        $re = Db::name('goods_spec')->where('spec_id',$id)->update($data);
        return $re;
    }

    /**
     * @param $id
     * @return bool|false|int
     * 删除商品
     */
    public function delete_goods($id)
    {
        $img  = $this->delete_goods_img($id);
        $spec = $this->delete_goods_spec($id);
        if($img && $spec){
            $re = Db::name('goods')->where('g_id',$id)->delete();
        }else{
            $re = false;
        }

        return $re;
    }

    /**
     * @param $id
     * @return false|int
     * 根据商品ID 删除规格
     */
    public function delete_goods_spec($id)
    {
        $re = Db::name('goods_spec')->where('g_id',$id)->delete();
        return $re;
    }

    /**
     * @param $id
     * @return false|int
     * 根据商品ID 删除图片
     */
    public function delete_goods_img($id)
    {
        $re = Db::name('goods_img')->where('g_id',$id)->delete();
        return $re;
    }

    /**
     * @param $id
     * @return array|false|mixed|null|\PDOStatement|string|Model
     * 查询单个商品信息
     */
    public function select_goods_find($id)
    {
        $re = Db::name('goods')->where('g_id',$id)->find();
        return $re;
    }

    /**
     * @param array $data
     * @param $id
     * @return false|int|string
     * 修改商品信息
     */
    public function updata_goods($data=array(),$id)
    {
        $re = Db::name('goods')->where('g_id',$id)->update($data);
        return $re;
    }

    public function goods_select_once($name)
    {
        $re = Db::name('goods')->where("g_name",'like','%'.$name.'%')->paginate(10);
        return $re;
    }
}