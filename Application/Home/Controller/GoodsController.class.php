<?php
namespace Home\Controller;

use Think\Controller;

class GoodsController extends Controller
{
    //商品列表
    public function index()
    {
        $this->display();
    }

    //商品详情 detail
    public function view()
    {
        $this->assign('id', $_GET['id']);
        $this->display();
    }

}