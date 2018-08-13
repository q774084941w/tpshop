<?php
namespace app\Admin\controller;
use app\admin\model\Sysets;
use think\Controller;
use Think\Model;
use \think\Db;
use \think\Request;
class System extends NowController
{
    public function index(){
        $arr=new Sysets();
        $re=$arr->sele(1);
        $this->assign('sit_filing', $re[0]['sit_filing']);
        $this->assign('sit_name', $re[0]['sit_name']);
        $this->assign('sit_logo', $re[0]['sit_logo']);
        $this->assign('sit_user_logo', $re[0]['sit_user_logo']);
        $this->assign('sit_title', $re[0]['sit_title']);
        $this->assign('sit_describe', $re[0]['sit_describe']);
        $this->assign('sit_key', $re[0]['sit_key']);
        $this->assign('sit_phone', $re[0]['sit_phone']);
        $this->assign('sit_tel', $re[0]['sit_tel']);
        $this->assign('sit_site', $re[0]['sit_site']);
        $this->assign('sit_qq', $re[0]['sit_qq']);
        return view('system_info');

    }

    public function uodel()
    {
        $request = Request::instance();
        $sit_filing = $request->param('sit_filing');
        $sit_name = $request->param('sit_name');

        $sit_title = $request->param('sit_title');
        $sit_describe = $request->param('sit_describe');
        $sit_key = $request->param('sit_key');
        $sit_phone = $request->param('sit_phone');
        $sit_tel = $request->param('sit_tel');
        $sit_site = $request->param('sit_site');
        $sit_qq = $request->param('sit_qq');
        /*  $arr = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
          $type = $_FILES['sit_user_logo']['type'];
          $size = $_FILES['sit_user_logo']['size'];
          $type1 = $_FILES['sit_logo']['type'];
          $size1 = $_FILES['sit_logo']['size'];*/
        $tpath2 = mt_rand(1000, 9999) . $_FILES['sit_logo']['name'];
        $tpath1 = mt_rand(1000, 9999) . $_FILES['sit_user_logo']['name'];
        $path = './static/img/' . $tpath1;
        $path1 = './static/img/' . $tpath2;
        $tpat = 'http://www.tpshop.com/static/img/' . $tpath2;
        $tpath = 'http://www.tpshop.com/static/img/' . $tpath1;

        $data =
            [
                'sit_filing' => $sit_filing,
                'sit_name' => $sit_name,
                'sit_logo' => $tpat,
                'sit_user_logo' => $tpath,
                'sit_title' => $sit_title,
                'sit_describe' => $sit_describe,
                'sit_key' => $sit_key,
                'sit_phone' => $sit_phone,
                'sit_tel' => $sit_tel,
                'sit_site' => $sit_site,
                'sit_qq' => $sit_qq,
            ];

        $flog = Db::name('siteinfo')->where('sit_id', 1)->update($data);
        move_uploaded_file($_FILES['sit_user_logo']['tmp_name'], $path);
        move_uploaded_file($_FILES['sit_logo']['tmp_name'], $path1);
        if ($flog) {
            echo "添加成功";
            header('Refresh:3,Url=index');
            echo '3s 后跳转';
        } else {
            echo "添加失败";
            header('Refresh:3,Url=index');
            echo '3s 后跳转';

        }

    }}
