<?php

namespace Home\Controller;

use Home\Model\Order;
use Think\Controller;

class OrderController extends Controller
{
    //创建订单
    public function create()
    {

        //从session中取购物车数据


        //检测库存


        //查单价信息


        if (empty($_SESSION['cart'])) {
            $this->error('购物车为空');
        }

        //计算总金额
        $totalFee = 0;
        foreach ($_SESSION['cart'] as $goodsId => $info) {
            $totalFee += $info['price'] * $info['qty'];
        }


        //存订单总表
        $order = [
            'out_trade_no' => strtoupper(uniqid()),
            'member_id' => 0,//分员id 从登录中取
            'name' => '购买' . $info['name'] . '等' . count($_SESSION['cart']) . '件商品',
            //'delivery_type' => '1',
            'total_fee' => $totalFee,
            'status' => Order::STATUS_NEW,
            'delivery_status' => Order::DELIVERY_NO,
            'payment_status' => '0',
            'created_at' => time(),
            'updated_at' => time(),
        ];

        //开启事务
        M()->startTrans();

        $insertId = M('order')->data($order)->add();
        //var_dump($insertId);
        if ($insertId < 1) {

            M()->rollback();
            $this->error('下单失败');
        }

        //存商品明细
        foreach ($_SESSION['cart'] as $goodsId => $info) {

            $item = [
                'order_id' => $insertId,
                'goods_id' => $goodsId,
                'quantity' => $info['qty'],
                'price' => $info['price'],
                'created_at' => time(),
                'updated_at' => time(),
            ];


            $result = M('order_item')->data($item)->add();
            if ($result < 1) {
                M()->rollback();
                $this->error('下单失败');
            }
        }

        //提交事务
        M()->commit();


        //清空购物车
        unset($_SESSION['cart']);

        $this->redirect('order/view', ['order_id' => $insertId]);

    }


    //订单详情 做支付
    public function view()
    {
        $orderId = intval($_GET['order_id']);

        //订单
        $order = M('order')->find(['id' => $orderId]);


        //订单明细
        $sql = 'select goods.id,goods.name,goods.pic,order_item.price ,order_item.quantity
          from order_item
          join goods on goods.id = order_item.goods_id
          where order_item.order_id = %d';

       /* $sql = 'select goods.id,goods.name,goods.pic,order_item.price ,order_item.quantity,member.username
          from order_item
          join goods on goods.id = order_item.goods_id
          join `order` on `order`.id = order_item.order_id
          join member on member.id = `order`.member_id
          where order_item.order_id = %d';*/

        $orderItem = M()->query($sql, $orderId);

        $this->assign('order', $order);


        $this->assign('orderItem', $orderItem);

        $this->display();
    }


    //让支付宝调用
    public function paySuccess()
    {
        //验证金额是否等于应付金额

        //将订单支付更新
    }
}