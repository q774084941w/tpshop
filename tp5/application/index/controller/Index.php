<?php
namespace app\index\controller;
use app\index\Model\Goods;
use app\index\Model\Lidex;
use think\Controller;
use think\Db;
use think\Request;
use think\View;
class Index extends UserController
{
    /**
     * @return View
     * 商城首页
     */
    public function index()
    {
        $result = Db::table('tp_adveritising')->where('gol_id','首页轮播')->order('adv_rank')->where('adv_show',1)->select();
        $row1 = Db::table('tp_adveritising')->where('gol_id','公告')->order('adv_rank')->where('adv_show',1)->select();
        $row2 = Db::table('tp_adveritising')->where('gol_id','特惠')->order('adv_rank')->where('adv_show',1)->select();
        $result1 = array_merge_recursive($row1,$row2);
        $this->assign('result',$result);
        $this->assign('result1',$result1);
        /**
         * 侧面导航
         */
        $this->goodsify();
        //主页显示推荐商品信息
        $goods = new Goods();
        $arr   = $goods->select_goods();

        $this->assign('arr',$arr);
        return View("home2");

    }


    /**
     * @return View
     * 搜索页面
     */
    public function sousuo()
    {
        $request = Request::instance();
        $g_name  = $request->param('index_none_header_sysc');
        $good    = new Goods();
        $re      = $good->select_goodsmohu($g_name);
        if($re){
            $this->assign('shangpin',$re);
        }else{
            $arr[] = [
                'g_id'=>0
            ];
            $this->assign('shangpin',$arr);
        }


        $this->goodsify();
        return View('goodssou');
    }

    public function settle()
    {
        return View('pay');
    }

    /**
     * @return View
     * 导航新模块加载
     */
    public function goodsModu()
    {
        $request = Request::instance();
        $name    = $request->param("name");
        $this->goodsify();
        $good    = new Goods();
        $re      = $good->goods_mdu($name);
        header("Content-type:text/html;charset=utf-8");
        /*print_r($re);exit;*/
        $this->assign('goods',$re);
        return View('goodsmodu');
    }

    /**
     * @return View
     * 品牌搜索商品
     */
    public function goodsBrand()
    {
        $request = Request::instance();
        $b_id    = $request->param("Id");
        $b_name    = $request->param("name");
        $this->goodsify();
        $good    = new Goods();
        $re      = $good->select_brand_goods($b_id);
       // print_r($re);exit;
        $this->assign('b_name',$b_name);
        $this->assign('shop',$re);

        return View('goodsbrandg');
    }
    /**
     * 侧面导航
     */
    public function goodsify()
    {
        $re = Db::name('goods_cla')->select();
        $fe = Db::name('goods_cla')->where('cla_fid',0)->select();
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
                foreach($re as $vs){
                    if($vs['cla_fid']==$v['cla_id']){
                        $son1[]=$vs;
                    }
                }
                $v['son1']=$son1;
                $son[] = $v;
            }
            $val['son']=$son;
            $data[] = $val;
        }
        $this->assign('data',$data);
    }
    /**
     * @return View
     * 商品详情页
     */
    public function goodsm()
    {

        $this->goodsify();
        $request = Request::instance();
        $g_id    = $request->param('Id');
        $good    = new Goods();
        $re      = $good->select_goodsm($g_id);
        $img     = $good->select_goodsimg($g_id);
        $spec    = $good->select_goodsspec($g_id);
        $shop    = $good->select_clagoods($re['cla_id']);
        $this->assign('shop',$shop);
        $this->assign('res',$re);
        $this->assign('img',$img);
        $this->assign('spec',$spec);
        return View("goodsm");
    }

    /**
     * @return View
     * 分类详情页
     */
    public function goods_cla()
    {
        $this->goodsify();
        $request = Request::instance();
        $g_id    = $request->param('Id');
        $good    = new Goods();
        $re      = $good->select_brand($g_id);
        $shop    = $good->select_clagoodsn($g_id);
        $this->assign('shop',$shop);
        $this->assign('reb',$re);
        return View('goodscla');
    }
    /**
     * 公告，促销列表界面
     */
    public function adv_shows()
    {
        $result     = Db::table("tp_adveritising")->where('gol_id','公告')->where('adv_show',1)->order('adv_rank')->select();
        $result1    = Db::table("tp_adveritising")->where('gol_id','特惠')->where('adv_show',1)->order('adv_rank')->select();
        //数据总数
        $total      = count($result);
        //总页数
        $totalpage  = ceil($total/10);
        $this->assign('total',$totalpage);
        //页码值初始值为0

        if(!empty($_GET['page']))
        {
            $currPage=$_GET['page'];
        }
        empty($currPage)?$currPage = 1:$currPage;
        $sepa_num = ($currPage-1)*10;
        if($currPage==1)
        {

            $this->assign('nt2',$totalpage>1?$currPage+1:$currPage);
            $this->assign('lt2',1);
            $this->assign('crr2',$currPage);
            $this->assign('rnt2',3);
            $this->assign('rlt2',1);
            $this->assign('rcrr2',2);
        }
        if($currPage>=2&&$currPage<$totalpage)
        {
            $this->assign('nxt2',$currPage<$totalpage?$currPage+1:$currPage);
            $this->assign('lt2',$currPage-1);
            $this->assign('crr2',$currPage);
            $this->assign('rnt2',$currPage+1);
            $this->assign('rlt2',$currPage-1);
            $this->assign('rcrr2',$currPage);
        }
        if($currPage==$totalpage&&$totalpage!=1)
        {

            $this->assign('nt2',$currPage);
            $this->assign('lt2',$currPage-1);
            $this->assign('crr2',$currPage);
            $this->assign('rnt2',$currPage+1);
            $this->assign('rlt2',$currPage-1);
            $this->assign('rcrr2',$currPage);
        }
        //促销数据总数
        $total1      = count($result1);
        //总页数
        $totalpage1  = ceil($total1/10);
        $this->assign('total1',$totalpage1);
        //页码值初始值为0
        if(!empty($_GET['page1']))
        {
            $currPage1=$_GET['page1'];
        }
        empty($currPage1)?$currPage1 = 1:$currPage1;
        $sepa_num1 = ($currPage1-1)*10;
        if($currPage1==1)
        {
//  echo $currPage1;

            $this->assign('nt1',$totalpage1>1?$currPage1+1:$currPage1);
            $this->assign('lt1',1);
            $this->assign('crr1',$currPage1);
            $this->assign('rnt1',3);
            $this->assign('rlt1',1);
            $this->assign('rcrr1',2);
        }
        if($currPage1>=2&&$currPage1<$totalpage1)
        {
            $this->assign('nt1',$currPage1<$totalpage1?$currPage1+1:$currPage1);
            $this->assign('lt1',$currPage1-1);
            $this->assign('crr1',$currPage1);
            $this->assign('rnt1',$currPage1+1);
            $this->assign('rlt1',$currPage1-1);
            $this->assign('rcrr1',$currPage1);
        }
        if($currPage1==$totalpage1&&$totalpage1!=1)
        {
            $this->assign('nt1',$currPage1);
            $this->assign('lt1',$currPage1-1);
            $this->assign('crr1',$currPage1);
            $this->assign('rnt1',$currPage1+1);
            $this->assign('rlt1',$currPage1-1);
            $this->assign('rcrr1',$currPage1);
        }
//        var_dump($currPage);exit;
        $result = Db::table("tp_adveritising")->where('gol_id','公告')->limit($sepa_num,10)->select();
        $result1 = Db::table("tp_adveritising")->where('gol_id','特惠')->limit($sepa_num1,10)->select();
//       var_dump($result,$result1);exit;
        $this->assign('result',$result);
        $this->assign('result1',$result1);
        return View("adv_more");
    }
    /**
     * 促销，公告，新闻详情页
     */
    public function adv_details()
    {
        $id = $_GET["id"];
        @ $result = Db::table("tp_adveritising")->where("adv_id",$id)->select();
//        var_dump($result);exit;
        $this->assign('result',$result);
        return View("adv_detail");
    }

}

