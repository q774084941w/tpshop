<?php
/**
 * 商品信息操作
 */
namespace app\Admin\controller;
use app\admin\model\Brandm;
use app\Admin\model\Goodm;
use think\Controller;
use Think\Model;
use think\Request;

class Goods extends NowController
{
    /**
     * @return \think\response\View
     * 商品信息列表
     */
    public function index()
    {
        $request  = Request::instance();
        $g_name   = $request->param('g_name');
        $goodm = new Goodm();
        if(empty($g_name)){
            $re    = $goodm->select_goodsAll();
        }else{
            $re    = $goodm->goods_select_once($g_name);
        }
        $this->assign('re',$re);
        return view('goodsm');
    }

    /**
     * 商品删除
     */
    public function delete_goods()
    {
        $request  = Request::instance();
        $g_id     = $request->param('g_id');
        $goodm    = new Goodm();
        $re       = $goodm->delete_goods($g_id);
        if($re){
            $data = [
                'sess'=>1,
                'mess'=>'删除成功'
            ];
        }else{
            $data = [
                'sess'=>0,
                'mess'=>'删除失败'
            ];
        }

        echo json_encode($data);
    }
    /**
     * @return \think\response\View
     * 商品图片添加
     */
    public function goodsImg()
    {
        $request = Request::instance();
        $gid     = $request->param('Id');
        $goodm   = new Goodm();
        $re      = $goodm->select_goddsimg($gid);
        $se      = [];
        //var_dump($re);
        if(empty($re[0])){
            $se[0] = [
                'g_id'=>0,
                'img_id'=>0,
                'img_url'   =>"http://www.tpshop.com/goodsimg/1.jpg"
            ];
            //print_r($se);exit;

        }else{
            $se = $re;
        }
        $this->assign('gid',$gid);
        $this->assign('re',$se);
        return view('goodimg');
    }

    /**
     * 商品图片删除
     */
    public function delete_goodimg()
    {
        $request = Request::instance();
        $img_id  = $request->param('img_id');
        $goodm   = new Goodm();
        $re      = $goodm->delete_goodsimg($img_id);
        if($re){
            $data = [
                'sess'=>1,
                'mess'=>'删除成功'
            ];
        }else{
            $data = [
                'sess'=>0,
                'mess'=>'删除失败'
            ];
        }

        echo json_encode($data);
    }

    /**
     * @return \think\response\View
     * 修改商品信息
     */
    public function updataGoods()
    {
        $request = Request::instance();
        $g_id    = $request->param('g_id');
        $goodm   = new Goodm();
        $ge      = $goodm->select_goods_find($g_id);
        //print_r($ge);exit;
        $this->assign('g_name',$ge['g_name']);
        $this->assign('g_id',$g_id);
        $this->assign('g_num',$ge['g_num']);
        $this->assign('g_remark',$ge['g_remark']);
        $this->assign('keyword',$ge['keyword']);
        $this->assign('g_pri',$ge['g_pri']);
        $this->assign('weight',$ge['weight']);
        $this->assign('original_img',$ge['original_img']);
        $this->assign('g_content',$ge['g_content']);
        $re    = $goodm->select_ify(0);
        $this->assign('re',$re);
        $brand = new Brandm();
        $se    = $brand->brand_select_all();
        $this->assign('se',$se);
        return view('updatagood');
    }

    /**
     * 修改商品基本信息
     */
    public function updataGoodsinfo()
    {
        $request = Request::instance();
        date_default_timezone_set('Asia/Shanghai');
        $g_id    = $request->param('g_id');
        $data = [
            'g_name'          => $request->param("g_name"),
            'g_num'           => $request->param("g_num"),
            'g_remark'        => $request->param("g_remark"),
            'keyword'         => $request->param("keyword"),
            'g_pri'           => $request->param("g_pri"),
            'weight'          => $request->param("weight"),
            'brand_id'        => $request->param("brand_id"),
            'cla_id'          => $request->param("cla_id"),
            'original_img'    => "http://www.tpshop.com/Good_uploads/".$request->param("original_img"),
            'g_content'       => $request->param("g_content"),
            'last_update'     => date('Y-m-d')
        ];
        $goodm = new Goodm();
        $re    = $goodm->updata_goods($data,$g_id);
        if($re){
            $data1 = [
                'sess'=>1,
                'mess'=>"修改成功"
            ];
        }else{
            $data1 = [
                'sess'=>0,
                'mess'=>"修改失败"
            ];
        }

        echo json_encode($data1);
    }
    /**
     * @return \think\response\View
     * 商品添加页面
     */
    public function addGoods()
    {
        $mo    = new Goodm();
        $re    = $mo->select_ify(0);
        $this->assign('re',$re);
        $brand = new Brandm();
        $se    = $brand->brand_select_all();
        $this->assign('se',$se);
        return view('addgoods');
    }

    /**
     * 修改是否新品状态
     */
    public function goods_new()
    {
        $request = Request::instance();
        $num = $request->param('check');
        $g_id = $request->param('g_id');
        $goodm = new Goodm();
        $goodm->updata_goodnew($g_id,$num);
    }

    /**
     * 修改是否推荐状态
     */
    public function goods_recommend()
    {
        $request = Request::instance();
        $num = $request->param('check');
        $g_id = $request->param('g_id');
        $goodm = new Goodm();
        $goodm->updata_goodre($g_id,$num);
    }

    /**
     * 修改是否包邮状态
     */
    public function goods_shipping()
    {
        $request = Request::instance();
        $num = $request->param('check');
        $g_id = $request->param('g_id');
        $goodm = new Goodm();
        $goodm->updata_shipping($g_id,$num);
    }

    /**
     * 修改是否上架状态
     */
    public function goods_sale()
    {
        $request = Request::instance();
        $num = $request->param('check');
        $g_id = $request->param('g_id');
        $goodm = new Goodm();
        $goodm->updata_sale($g_id,$num);
    }
    /**
     * 商品添加操作
     */
    public function addGoodsinfo()
    {
        $request = Request::instance();
        date_default_timezone_set('Asia/Shanghai');
        $data = [
            'g_name'          => $request->param("g_name"),
            'g_num'           => $request->param("g_num"),
            'g_remark'        => $request->param("g_remark"),
            'keyword'         => $request->param("keyword"),
            'g_pri'           => $request->param("g_pri"),
            'weight'          => $request->param("weight"),
            'brand_id'        => $request->param("brand_id"),
            'cla_id'          => $request->param("cla_id"),
            'original_img'    => "http://www.tpshop.com/Good_uploads/".$request->param("original_img"),
            'g_content'       => $request->param("g_content"),
            'is_on_sale'      => $request->param("is_on_sale"),
            'is_recommend'    => $request->param("is_recommend"),
            'is_new'          => $request->param("is_new"),
            'is_free_shipping'=> $request->param("is_free_shipping"),
            'on_time'         => date('Y-m-d'),
            'last_update'     => date('Y-m-d')
        ];
        $goodm = new Goodm();
        $re    = $goodm->add_goods($data);
        if($re){
            $data1 = [
                'sess'=>1,
                'mess'=>"添加成功"
            ];
        }else{
            $data1 = [
                'sess'=>0,
                'mess'=>"添加失败"
            ];
        }

        echo json_encode($data1);
    }
    /**
     * @return \think\response\View
     * 商品分类信息
     */
    public function goodsIfy()
    {
        $mo = new Goodm();
        $re = $mo->select_ifya();
        //print_r($re);exit;
        $this->assign('re',$re);
        return view('goodsify');
    }

    /**
     * @return \think\response\View
     * 添加商品分类页面
     */
    public function addIfy()
    {   //渲染所有顶级分类
        $mo = new Goodm();
        $re = $mo->select_ify(0);
        $this->assign('re',$re);
        return view('addify');
    }

    /**
     * 添加商品分类处理
     */
    public function addIfyinfo()
    {
        $request = Request::instance();
        $cla_name = $request->param("cla_name");
        $cla_link = $request->param("cla_link");
        $cla_fid = $request->param("cla_fid");
        $choose = $request->param("choose");
        $data = [
            'cla_name'=>$cla_name,
            'cla_fid' =>$cla_fid,
            'choose'  =>$choose,
            'cla_link'=>$cla_link
        ];
        $fe = new Goodm();
        $re = $fe->add_ify($data);
        if($re){
            $de= [
                'sess'=>1,
                'mess'=>"添加成功"
            ];
        }else{
            $de= [
                'sess'=>0,
                'mess'=>"添加失败"
            ];
        }

        echo json_encode($de);

    }

    /**
     * 查找下级分类
     */
    public function select_next()
    {
        $request = Request::instance();
        $cla_id  = $request->param('cla_id');
        $goodm   = new Goodm();
        $re      = $goodm->select_nextf($cla_id);
        echo json_encode($re);
    }

    /**
     * 修改分类状态为显示
     */
    public function checkChoosec()
    {
        $request = Request::instance();
        $cla_id  = $request->param('cla_id');
        $goodm   = new Goodm();
        $goodm->updata_choose_check($cla_id);
    }
    /**
     * 修改分类状态为不显示
     */
    public function checkChoose()
    {
        $request = Request::instance();
        $cla_id  = $request->param('cla_id');
        $goodm   = new Goodm();
        $goodm->updata_choose($cla_id);
    }
    //删除分类及对应子分类
    public function delete_ify()
    {
        $request = Request::instance();
        $cla_id  = $request->param('cla_id');
        $goodm   = new Goodm();
        $re = $goodm->delete_ify($cla_id);
        if($re){
            $data= [
                'sess'=>1,
                'mess'=>'删除成功'
            ];
        }else{
            $data= [
                'sess'=>0,
                'mess'=>'删除失败'
            ];
        }

        echo json_encode($data);
    }

    //查找子级分类
    public function select_son()
    {
        $request = Request::instance();
        $cla_id  = $request->param('cla_id');
        $goodm   = new Goodm();
        $re      = $goodm->select_nextf($cla_id);
        echo json_encode($re);
    }

    /**
     * @return \think\response\View
     * 添加子分类
     */
    public function son_ify()
    {
        $request = Request::instance();
        $cla_id  = $request->param('Id');
        $cla_name  = $request->param('cla_name');
        $this->assign('id',$cla_id);
        $this->assign('cla_name',$cla_name);
        return view('son_ify');
    }

    /**
     * @return \think\response\View
     * 显示修改弹窗
     */
    public function updata_ify()
    {
        $request = Request::instance();
        $cla_id  = $request->param('Id');
        $mo      = new Goodm();
        $re      = $mo->select_ify(0);
        $res     = $mo->select_ify_one($cla_id);
        $this->assign('re',$re);
        $this->assign('cla_name',$res['cla_name']);
        $this->assign('cla_link',$res['cla_link']);
        $this->assign('choose',$res['choose']);
        $this->assign('cla_id',$cla_id);
        return view('updata_ify');
    }
    //修该分类信息操作
    public function updata_ify_info()
    {
        $request  = Request::instance();
        $cla_id   = $request->param("cla_id");
        $cla_name = $request->param("cla_name");
        $cla_link = $request->param("cla_link");
        $cla_fid  = $request->param("cla_fid");
        $choose   = $request->param("choose");
        $data     = [
            'cla_name'=>$cla_name,
            'cla_fid' =>$cla_fid,
            'choose'  =>$choose,
            'cla_link'=>$cla_link
        ];

        $goodm = new Goodm();
        $re    = $goodm->updata_ify($data,$cla_id);
        if($re){
            $data1= [
                'sess'=>1,
                'mess'=>'修改成功'
            ];
        }else{
            $data1= [
                'sess'=>1,
                'mess'=>'修改成功'
            ];
        }

        echo json_encode($data1);
    }
    public function selectlike_brand()
    {
        $request  = Request::instance();
        $b_name   = $request->param("b_name");
        $brandm   = new Brandm();
        $re       = $brandm->brand_select_once($b_name);
        if($re){
            $data = [
                'sess'=>1,
                'mess'=>$re
            ];
        }else{
            $data = [
                'sess'=>0,
                'mess'=>'没有相关信息'
            ];
        }

        echo json_encode($data);
    }
    /**
     * @return \think\response\View
     * 品牌显示页面
     */
    public function goods_brand()
    {
        $request  = Request::instance();
        $b_name   = $request->param("b_name");
        $brandm   = new Brandm();
        if(empty($b_name)){
            $re   = $brandm->brand_select();

        }else{
            $re   = $brandm->brand_select_once($b_name);
        }
        $this->assign('re',$re);
        return view('goodbrand');



    }

    /**
     * 修改品牌状态为推荐
     */
    public function checkChooseb()
    {
        $request  = Request::instance();
        $b_id     = $request->param("b_id");
        $brandm   = new Brandm();
        $brandm->brand_check_b($b_id);
    }
    /**
     * 修改品牌状态为不推荐
     */
    public function checkChooseba()
    {
        $request  = Request::instance();
        $b_id     = $request->param("b_id");
        $brandm   = new Brandm();
        $brandm->brand_check($b_id);
    }

    /**
     * @return \think\response\View
     * 品牌信息修改窗口
     */
    public function updata_brand()
    {
        $request = Request::instance();
        $b_id  = $request->param('Id');
        $mo      = new Goodm();
        $re      = $mo->select_ify(0);
        $brandm  = new Brandm();
        $res     = $brandm->brand_select_f($b_id);
        $this->assign('re',$re);
        $this->assign('b_name',$res['b_name']);
        $this->assign('b_logo',$res['b_logo']);
        $this->assign('b_choose',$res['b_choose']);
        $this->assign('b_id',$b_id);
        return view('updatabrand');
    }

    /**
     * 品牌信息修改操作
     */
    public function updataBrandInfo()
    {
        $request    = Request::instance();
        $b_name     = $request->param("b_name");
        $b_logo     = $request->param("b_logo");
        $cla_id     = $request->param("cla_id");
        $b_choose   = $request->param("b_choose");
        $b_id   = $request->param("b_id");

        $data       = [
            'b_name'=> $b_name,
            'b_logo'=> "http://www.tpshop.com/brand_uploads/".$b_logo,
            'cla_id'=> $cla_id,
            'b_choose'=>$b_choose
        ];

        $brandm = new Brandm();
        $re     = $brandm->brand_updata($data,$b_id);
        if($re){
            $data1 = [
                'sess'=>1,
                'mess'=>"修改成功"
            ];
        }else{
            $data1 = [
                'sess'=>0,
                'mess'=>"修改失败"
            ];
        }
        echo json_encode($data1);
    }
    /**
     * 品牌单个删除
     */
    public function delete_brand()
    {
        $request  = Request::instance();
        $b_id     = $request->param("b_id");
        $brandm   = new Brandm();
        $re       = $brandm->brand_delete($b_id);
        if($re){
            $data = [
                'sess'=>1,
                'mess'=>"删除成功"
            ];
        }else{
            $data = [
                'sess'=>0,
                'mess'=>"删除失败"
            ];
        }

        echo json_encode($data);
    }
    /**
     * @return \think\response\View
     * 品牌添加页面
     */
    public function add_brand()
    {
        $mo = new Goodm();
        $re = $mo->select_ify(0);
        $this->assign('re',$re);
        return view('addbrand');
    }

    /**
     * 品牌添加操作
     */
    public function addbrand()
    {
        $request    = Request::instance();
        $b_name     = $request->param("b_name");
        $b_logo     = $request->param("b_logo");
        $cla_id     = $request->param("cla_id");
        $b_choose   = $request->param("b_choose");

        $data       = [
            'b_name'=> $b_name,
            'b_logo'=> "http://www.tpshop.com/brand_uploads/".$b_logo,
            'cla_id'=> $cla_id,
            'b_choose'=>$b_choose
        ];

        $brandm = new Brandm();
        $re     = $brandm->brand_add($data);
        if($re){
            $data1 = [
                'sess'=>1,
                'mess'=>"添加成功"
            ];
        }else{
            $data1 = [
                'sess'=>0,
                'mess'=>"添加失败"
            ];
        }
        echo json_encode($data1);
    }

    /**
     * 品牌图片上传
     */
    public function uploadImg()
    {
        $file = request()->file('myfile');

        // 移动到框架应用根目录/public/brand_uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'brand_uploads','');
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                $mes = $info->getFilename();      // 文件名
                echo '{"mes":"'.$mes.'"}';
                //echo $info->getExtension();
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                //echo $info->getSaveName();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                //echo $info->getFilename();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
            //echo json_encode($data);
        }
    }

    /**
     * 商品图片上传处理
     */
    public function goodsuploadImg()
    {
        $files = request()->file('goodsimg');
        $g_id  = request()->param('g_id');
        $arr   = 0;
        //echo $g_id;exit;
        // 移动到框架应用根目录/public/Good_uploads/ 目录下
        foreach ($files as $file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'Good_uploads','');
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                $mes   = $info->getFilename();
                $data  = [
                    'g_id'=>$g_id,
                    'img_url'=>"http://www.tpshop.com/Good_uploads/".$mes
                ];
                $goodm = new Goodm();
                $re    = $goodm->add_goodsimg($data);
                if($re){
                    $arr = 1;
                }else{
                    $arr = 0;
                }
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }

        echo $arr;
    }
    /**
     * 商品图片上传处理
     */
    public function uploadGoodImg()
    {
        $file = request()->file('myfile');

        // 移动到框架应用根目录/public/Good_uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'Good_uploads','');
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                $mes = $info->getFilename();      // 文件名
                echo '{"mes":"'.$mes.'"}';
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }
    /**
     * @return \think\response\View
     * 商品属性
     */
    public function goodsSpec()
    {
        $request    = Request::instance();
        $g_id       = $request->param('Id');
        $goodm      = new Goodm();
        $re         = $goodm->select_goodsprec($g_id);
        $arr        = [];
        if(empty($re)){
            $arr[0] = [
                'spec_id'=>0
            ];
        }else{
            $arr = $re;
        }
        $this->assign('g_id',$g_id);
        $this->assign('re',$arr);
        return view('goodsSpec');
    }

    /**
     * 商品规格添加
     */
    public function addspec()
    {
        date_default_timezone_set('Asia/Shanghai');
        $request    = Request::instance();
        $data       = [
             "key_name"   =>$request->param('key_name'),
             "key"        =>$request->param('key'),
             "spec_img"   =>"http://www.tpshop.com/Good_uploads/".$request->param('spec_img'),
             "spec_price" =>$request->param('spec_price'),
             "sto_count"  =>$request->param('sto_count'),
             "g_id"       =>$request->param('g_id'),
             "updata_time"=>date("Y-m-d")
        ];
        //print_r($data);exit;
        $goodm = new Goodm();
        $re    = $goodm->add_goodsprec($data);
        //var_dump($re);exit;
        if($re){
            $goodm->updata_goodsCount($request->param('g_id'));
            $data1 = [
                'sess'=>1,
                'mess'=>"添加成功"
            ];
        }else{
            $data1 = [
                'sess'=>0,
                'mess'=>"添加失败"
            ];
        }

        echo json_encode($data1);
    }

    /**
     * 删除商品规格
     */
    public function delete_spec()
    {
        $request    = Request::instance();
        $spec_id    = $request->param('spec_id');
        $goodm = new Goodm();
        $re    = $goodm->delete_spec($spec_id);

        if($re){
            $goodm->updata_goodsCount($request->param('g_id'));
            $data = [
                'sess'=>1,
                'mess'=>"删除成功"
            ];
        }else{
            $data = [
                'sess'=>0,
                'mess'=>"删除失败"
            ];
        }
        echo json_encode($data);
    }

    /**
     * 商品规格修改
     */
    public function updataSpec()
    {
        date_default_timezone_set('Asia/Shanghai');
        $request    = Request::instance();
        $spec_id    = $request->param('spec_id');
        $g_id       = $request->param('g_id');
        $data       = [
            "key_name"   =>$request->param('key_name'),
            "key"        =>$request->param('key'),
            "spec_price" =>$request->param('spec_price'),
            "sto_count"  =>$request->param('sto_count'),
            "updata_time"=>date("Y-m-d")
        ];

        $goodm = new Goodm();
        $re = $goodm->updata_spec($data,$spec_id);
        if($re){
            $goodm->updata_goodsCount($request->param('g_id'));
            $data1 = [
                'sess'=>1,
                'mess'=>"修改成功"
            ];
        }else{
            $data1 = [
                'sess'=>0,
                'mess'=>"修改失败"
            ];
        }

        echo json_encode($data1);
    }
}