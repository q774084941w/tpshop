<?php
namespace app\Admin\controller;
use app\admin\model\Colum;
use think\Controller;
use \think\Request;
class Columns extends NowController
{
    public function index()
    {
        $mo = new Colum();
        $re = $mo->sey();
        $this->assign('re', $re);
        return view('Columns');

    }

    public function add()
    {
        return view('add_columns');
    }

    //添加
  public function tiaj()
    {
        $request = Request::instance();
        $nav_name = $request->param('nav_name');
        $nav_site = $request->param('nav_site');
        $data = [
            'nav_name' => $nav_name,
            'nav_site' => $nav_site,
        ];

        $arr = new Colum();
        $re = $arr->col($data);
        if ($re) {
            $data1 = [
                'code' => 1,
                'msg' => '添加成功'

            ];
        } else {
            $data1 = [
                'code' => 0,
                'msg' => '添加失败'
            ];
        }

        echo json_encode($data1);


    }
//修改显示layer弹框
    public function updata_ify()
    {
        $request = Request::instance();
        $nav_id = $request->param('Id');
        $mo = new Colum();

        $res = $mo->select_ify_one($nav_id);
        $this->assign('nav_name', $res['nav_name']);
        $this->assign('nav_site', $res['nav_site']);
        $this->assign('nav_id', $nav_id);
        return view('upda_columns');
    }
    // 修改
    public function updata_ify_info()
    {
        $request = Request::instance();
        $nav_id = $request->param('nav_id');
        $nav_name = $request->param('nav_name');
        $nav_site = $request->param('nav_site');
        $data = [
            'nav_name' => $nav_name,
            'nav_site' => $nav_site,
        ];
        $goodm = new Colum();
        $re = $goodm->updata_ify($data, $nav_id);
        if ($re) {
            $data1 = [
                'sess' => 1,
                'mess' => '修改成功'
            ];
        } else {
            $data1 = [
                'sess' => 0,
                'mess' => '修改失败'
            ];
        }

        echo json_encode($data1);
    }

    public function del()
    {
        $request = Request::instance();
        $nav_id = $request->param('nav_id');
        $arr = new Colum();
        $re = $arr->del_c($nav_id);

        if ($re) {
            $data = [
                'sess' => 1,
                'mess' => '删除成功'
            ];
        } else {
            $data = [
                'sess' => 0,
                'mess' => '删除失败'
            ];
        }

        echo json_encode($data);
    }


    /**
     * 修改分类状态为显示
     */
    public function checkec()
    {
        $request = Request::instance();
        $nav_id = $request->param('nav_id');
        var_dump($nav_id);
        $goodm = new Colum();
        $goodm->updack($nav_id);
    }

    /**
     * 修改分类状态为不显示
     */
    public function checes()
    {
        $request = Request::instance();
        $nav_id = $request->param('nav_id');
        $goodm = new Colum();
        $goodm->chece($nav_id);
    }
}