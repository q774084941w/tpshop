<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Request;
class Shopcart extends UserController
{
    public function index()
    {
        $arr = Session::get('mygoods');
        //print_r($arr);exit;
        if(isset($arr)){
            $this->assign('arr',$arr);
        }else{
            $data = [
                'spec_id'=>0
            ];
            $this->assign('arr',$data);
        }

        return view('shopcart');
    }

    public function addCat()
    {

        $request = Request::instance();
        $arr1     = [
            'img'=>$request->param('img'),
            'spec_id'=>$request->param('spec_id'),
            'gname'=>$request->param('gname'),
            'gprice'=>$request->param('gprice'),
            'pec'=>$request->param('pec'),
            'num'=>$request->param('num'),
            'method'=>$request->param('method'),
        ];
        $arr = Session::get('mygoods');
        $narr[] = $arr1;
        if(isset($arr)){
            foreach ($arr as $vl){
                if($vl['spec_id']==$arr1['spec_id']){
                    $cdata = [
                        'sess'=>'购物车已有商品',
                        'num'=>count($arr)
                    ];
                    echo json_encode($cdata);
                    exit;
                }
            }

            array_push($arr,$arr1);
            Session::set('mygoods',$arr);
        }else{
            Session::set('mygoods',$narr);
        }
        $cdata = [
            'sess'=>'已加入购物车',
            'num'=>count($arr)
        ];
        echo json_encode($cdata);
    }
public function date()
{
    $request=Request::instance();
    $pec=$request::instance()->param('pec');
    var_dump($pec);exit;
}


}





