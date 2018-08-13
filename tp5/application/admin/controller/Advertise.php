<?php
/**
 * Created by PhpStorm.
 * User: 胡明
 * Date: 2018/1/12
 * Time: 11:00
 */
namespace app\admin\controller;
use Think\Controller;
use \think\Request;
use think\Db;
use think\session;
use think\View;

class Advertise extends NowController
{   /**
 * 广告列表,模糊查询
 */
    public function Advertising_list()
    {
        //如果这个条件是空的
        if(!empty($_GET['id']))
        {
            $_SESSION['id'] =$_GET['id'];;
        }
        if(!empty($_SESSION['id'])){
            $index="gol_id like '%{$_SESSION['id']}%'";
            $data=Db::table('tp_adveritising')->where($index)->select();
            \think\View::share('id',$_SESSION['id']);
            $result = Db::table("tp_adveritising")->where($index)->select();
            $totalpage = count($result);
            $totalPage = ceil($totalpage/5);
            if(!empty($_GET['curr']))
            {
                $currentpage = $_GET['curr'];
            }
            if(!empty($currentpage))
            {
                $page = ($currentpage-1)*5;
            }else{
                $currentpage = 1;
                $page = ($currentpage-1)*5;
            }
            \think\View::share('endpage',$totalPage);
            if($currentpage>=2&&$currentpage<$totalPage)
            {
                $next = $currentpage+1;
                $last = $currentpage-1;
                \think\View::share('next', $next);
                \think\View::share('nex', $next);
                \think\View::share('curr',$currentpage);
                \think\View::share('las',$last);
                \think\View::share('last',$last);
            }else if($currentpage==$totalPage){
                \think\View::share('next', $totalPage);
                \think\View::share('nex', $totalPage+1);
                \think\View::share('curr',$currentpage);
                \think\View::share('las',$totalPage-1);
                \think\View::share('last',$totalPage-1);
            }
            else
            {
                $next = $currentpage+1;
                \think\View::share('next',$next);
                \think\View::share('nex',3);
                \think\View::share('curr',2);
                \think\View::share('las',1);
                \think\View::share('last',1);
            }
            $result = Db::table("tp_adveritising")->where($index)->limit($page,5)->select();
        }
        if(empty($_GET['id'])){
            \think\View::share('id','');
            $result = Db::table("tp_adveritising")->select();
            $totalpage = count($result);
            $totalPage = ceil($totalpage/5);
            if(!empty($_GET['curr']))
            {
                $currentpage = $_GET['curr'];
            }
            if(!empty($currentpage))
            {
                $page = ($currentpage-1)*5;
            }else{
                $currentpage = 1;
                $page = ($currentpage-1)*5;
            }
            \think\View::share('endpage',$totalPage);
            if($currentpage>=2&&$currentpage<$totalPage)
            {
                $next = $currentpage+1;
                $last = $currentpage-1;
                \think\View::share('next', $next);
                \think\View::share('nex', $next);
                \think\View::share('curr',$currentpage);
                \think\View::share('las',$last);
                \think\View::share('last',$last);
            }else if($currentpage==$totalPage){
                \think\View::share('next', $totalPage);
                \think\View::share('nex', $totalPage+1);
                \think\View::share('curr',$currentpage);
                \think\View::share('las',$totalPage-1);
                \think\View::share('last',$totalPage-1);
            }
            else if($currentpage==1)
            {
                $next = $currentpage+1;
                \think\View::share('next',$next);
                \think\View::share('nex',3);
                \think\View::share('curr',2);
                \think\View::share('las',1);
                \think\View::share('last',1);
            }
            $result = Db::table("tp_adveritising")->limit($page,5)->select();
        }
        \think\View::share('result',$result);
        return view('Advertising_list');
    }
    /**
     *删除广告
     */
    public function del_adv()
    {
        $id = $_POST["i"];
        $result = Db::table("tp_adveritising")->where('adv_id',$id)->find();
//        var_dump($path2);
//        var_dump($result['adv_img']);
        $flog =  Db::table("tp_adveritising")->where('adv_id',$id)->delete();
        if($flog){
            echo '删除成功';
        }else{
            echo '删除失败';
        }

    }
    /**
     *显示修改广告界面
     */
    public function update_adv()
    {
        $result = Db::table("tp_adveritising")->where('adv_id',$_GET['name'])->select();
        \think\View::share('result',$result);
        return view("update_adv");
    }
    /**
     *修改广告显示状态
     */
    public function Advertising_state()
    {
        $id = $_POST['id'];
        $data = ['adv_show'=>$_POST['i']];
        Db::table('tp_adveritising')->where('adv_id',$id)->update($data);
    }
    /**
     *更改广告
     */
    public function adv_change()
    {
        $id = Request::instance()->param('adv_id');
        $adv_name = Request::instance()->param('adv_name');
        $gol_id = Request::instance()->param('gol_id');
        $adv_link = Request::instance()->param('adv_link');
        $adv_rank = Request::instance()->param('adv_rank');
        $adv_size = explode('X',Request::instance()->param('gol_size'));
        $adv_time = Request::instance()->param('adv_time');
        $adv_content = Request::instance()->param('content');
//         echo($adv_size);
        $adv_width = $adv_size[1];
        $adv_height = $adv_size[0];
//         echo $adv_name,$gol_id,$adv_link,$adv_rank,$adv_width,$adv_height;exit;
//        echo($adv_height);exit;
//        $advertise = new \app\index\model\Advertise();
        $arr = ['image/jpeg','image/png','image/jpg','image/gif'];
        $type = $_FILES['adv_img']['type'];
        $size = $_FILES['adv_img']['size'];
        $tpath1 =  mt_rand(1000,9999).$_FILES['adv_img']['name'];
        $path = './static/images/advertise/'. $tpath1;

        $tpath = 'http://www.tpshop.com/static/images/advertise/'.$tpath1;
        if(!in_array($type,$arr)){
            return '文件格式不对';
        }else{
            if($size>2*1024*1024){
                return '文件过大';
            }else
            {
                $data =
                    [
                        'adv_name'      =>    $adv_name,
                        'gol_id'        =>    $gol_id,
                        'adv_link'      =>    $adv_link,
                        'adv_rank'      =>    $adv_rank,
                        'adv_img'       =>    $tpath,
                        'adv_width'     =>    $adv_width,
                        'adv_height'    =>    $adv_height,
                        'adv_content'   =>    $adv_content,
                        'adv_time'      =>     $adv_time,

                    ];

                $flog = Db::table('tp_adveritising')->where('adv_id',$id)->update($data);
                move_uploaded_file($_FILES['adv_img']['tmp_name'], $path);
                if($flog)
                {
                    echo "<script>"."window.location.href='http://www.tpshop.com/admin/advertise/Advertising_list'"."</script>";
                }else
                {
                    echo "<script>"."alert('修改失败')"."</script>";
                    echo "<script>"."window.location.href='http://www.tpshop.com/admin/advertise/Advertising_list'"."</script>";
                }
            }
        }
    }
    /**
     * 添加广告
     *return: string
     */
    public function add_Advertising()
    {
        return view("add_Advertising");
    }
    /**
     *广告分类加载到select框
     */
    public function sort_option()
    {
        $result = Db::table("tp_ad_sort")->select();
        print_r(json_encode($result));
    }
    /**
     *添加广告
     */
    public function advAdd()
    {
//        var_dump($_POST);
//        var_dump($_FILES);exit;
//        for($i=0;$i<20;$i++){
//        var_dump($_FILES['adv_img']);
        $adv_name = Request::instance()->param('adv_name');
        $gol_id = Request::instance()->param('gol_id');
        $adv_link = Request::instance()->param('adv_link');
        $adv_rank = Request::instance()->param('adv_rank');
         $adv_size = explode('X',Request::instance()->param('gol_size'));
        $adv_content = Request::instance()->param('content');
        $adv_time = Request::instance()->param('adv_time');
//         echo($adv_size);
         $adv_width = $adv_size[1];
         $adv_height = $adv_size[0];
//         echo $adv_name,$gol_id,$adv_link,$adv_rank,$adv_width,$adv_height;exit;
//        echo($adv_height);exit;
//        $advertise = new \app\index\model\Advertise();
        $arr = ['image/jpeg','image/png','image/jpg','image/gif'];
        $type = $_FILES['adv_img']['type'];
        $size = $_FILES['adv_img']['size'];
        $tpath1 =  mt_rand(1000,9999).$_FILES['adv_img']['name'];
        $path = './static/images/advertise/'. $tpath1;

        $tpath = 'http://www.tpshop.com/static/images/advertise/'.$tpath1;
        if(!in_array($type,$arr)){
            return '文件格式不对';
        }else{
            if($size>2*1024*1024){
                return '文件过大';
            }else
            {
                $data =
                    [
                        'adv_name'     =>   $adv_name,
                        'gol_id'       =>   $gol_id,
                        'adv_link'     =>   $adv_link,
                        'adv_rank'     =>   $adv_rank,
                        'adv_img'      =>   $tpath,
                        'adv_width'    =>   $adv_width,
                        'adv_height'   =>   $adv_height,
                        'adv_content'  =>   $adv_content,
                        'adv_time'     =>   $adv_time
                    ];
//   print_r($data);exit;
                $flog = Db::table('tp_adveritising')->insert($data);
                move_uploaded_file($_FILES['adv_img']['tmp_name'],$path);
                if($flog)
                {
                    echo "<script>"."window.location.href='http://www.tpshop.com/admin/advertise/Advertising_list'"."</script>";
                }
            };
        };
    }
//    }
    /**
     *广告分类列表
     */
    public function Advertising_sort()
    {
        $result = Db::table('tp_ad_sort')->select();
        \think\View::share('result',$result);
        return view('Advertising_sort');
    }
    /**
     *添加广告分类
     */
    public function Add_sort()
    {
        $sort_width    = $_POST['width'];
        $sort_height    = $_POST['height'];
        $sort_name    = $_POST['name'];
        $sort_des     = $_POST['des'];
        $sort_time    = date("Y-m-d H:i:s");
        $data =
            [
                'sort_name'              =>   $sort_name,
                'sort_description'      =>   $sort_des,
                'sort_width'            =>   $sort_width,
                'sort_height'           =>   $sort_height,
                'sort_time'             =>   $sort_time,
            ];
        $result =   Db::table('tp_ad_sort')->insert($data);
        if($result)
        {
            echo 1;
        }else
        {
            echo 0;
        }
    }
    /**
     *删除广告分类
     */
    public function del_sort()
    {
        $id = $_POST["i"];
        $result = Db::table("tp_ad_sort")->where('sort_id',$id)->find();
//        var_dump($path2);
//        var_dump($result['adv_img']);
        $flog =  Db::table("tp_ad_sort")->where('sort_id',$id)->delete();
        if($flog){
            echo '删除成功';
        }else{
            echo '删除失败';
        }
    }
    /**
     *显示修改广告分类的界面
     */
    public function update_sort()
    {
        $result = Db::table("tp_ad_sort")->where('sort_id',$_GET['name'])->select();
        \think\View::share('result',$result);
        return view("update_sort");
    }
    /**
     *处理修改分类的信息
     */
    public function sort_change()
    {
        $data =
            [
                'sort_name'             => Request::instance()->param('n1'),
                'sort_description'     => Request::instance()->param('n3'),
                'sort_width'             => Request::instance()->param('n2'),
                'sort_height'             => Request::instance()->param('n5'),
            ];
        $result = Db::table("tp_ad_sort")->where('sort_id',Request::instance()->param('n4'))->update($data);
        if($result)
        {
            echo '修改成功';
        }
    }
    /**
     *列表页直接修改广告排序
     */
    public function ad_rank()
    {
        $id = Request::instance()->param('id');
        $rank = Request::instance()->param('rank');
        $data =
            [
                'adv_rank'     =>  $rank,
            ];
        if($result =  Db::table('tp_adveritising')->where('adv_id',$id)->update($data)){
            echo "<script>"."window.location.href='http://www.tpshop.com/admin/advertise/Advertising_list'"."</script>";
        } ;
    }
    /**
     * 更改广告类的启用状态
     */
    public function sort_state()
    {
        $id = $_POST['id'];
        $data = ['sort_state'=>$_POST['i']];
       if( Db::table('tp_ad_sort')->where('sort_id',$id)->update($data)){
           echo '状态切换成功';
       };
    }
}