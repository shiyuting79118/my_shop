<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
    <?php echo ($order["name"]); ?>
     ￥<?php echo ($order["total_fee"]); ?>

    物流状态<?=\Home\Model\Order::getDeliveryStatusStr($order['delivery_status'])?>

    <ul>
        <?php if(is_array($orderItem)): foreach($orderItem as $key=>$vo): ?><li><?php echo ($vo["id"]); ?>  <?php echo ($vo["name"]); ?>  <?php echo ($vo["price"]); ?>  <?php echo ($vo["quantity"]); ?></li><?php endforeach; endif; ?>
    </ul>
</body>
</html>