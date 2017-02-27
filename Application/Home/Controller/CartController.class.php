<?php
namespace Home\Controller;

use Think\Controller;

class CartController extends Controller
{
    /**
     * 显示购物车商品
     */
    public function index()
    {

        $this->assign('cart', $_SESSION['cart']);
        $this->display();
    }

    /**
     * 商品添加到购物车 或修改数量 有$_GET['update']表示修改
     */
    public function add()
    {
        //接收参数
        $goodsId = intval($_POST['goods_id']);
        $qty = intval($_POST['qty']);

        //数据处理
        $qty = max(1, $qty);


        //判断商品id是否有效
        //todo select * from goods where id =? and status = 1
        $goods = M('goods')->where(array('id' => $goodsId))->find();
        if (empty($goods)) {
            //报错 跳转
            echo 'error';
            return;
        }

        /* $_SESSION['cart'] = array(
        // 商品id =>array(商品信息)
        1 => array('qty' => 1, 'name' => '商品1', 'price' => '100'),
        2 => array('qty' => 2, 'name' => '商品2', 'price' => '100'),
        3 => array('qty' => 1, 'name' => '商品3', 'price' => '100'),
    );*/

        /*  $_SESSION['cart'][1]=array('qty' => 1, 'name' => '商品1', 'price' => '100')
           $_SESSION['cart'][2]=array('qty' => 1, 'name' => '商品2', 'price' => '100')
         */

        if (!isset($_POST['update'])) {
            //商品是否已存在
            if (isset($_SESSION['cart'] [$goodsId]['qty'])) {
                //$qty += $_SESSION['cart'] [$goodsId]['qty'];
                $qty = $qty + $_SESSION['cart'] [$goodsId]['qty'];

            }
        }


        $_SESSION['cart'][$goodsId] = array('qty' => $qty, 'name' => $goods['name'], 'price' => $goods['price']);

        $this->redirect('cart/index');

    }

    public function delete()
    {
        $goods_id = $_GET['goods_id'];
        unset($_SESSION['cart'][$goods_id]);
        $this->redirect('cart/index');
    }

}