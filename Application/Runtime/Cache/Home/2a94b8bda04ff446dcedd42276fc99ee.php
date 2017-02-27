<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>

<!--
    <div>
        <h1>分类1</h1>
        <ul>
            <li>商品1  单价 xx</li>
            <li>商品2  单价 xx</li>
        </ul>
    </div>

    <div>
        <h1>分类2</h1>
        <ul>
            <li>商品1  单价 xx</li>
            <li>商品2  单价 xx</li>
        </ul>
    </div>-->

<?php foreach($categoryList as $category ){?>
<div>
    <h1><?php echo $category['name']; ?>  </h1>
    <ul>
        <?php foreach($goodsWithCategory[$category['id']] as $goods){ ?>
        <li>
            <?php echo $goods['name']?>
            ￥<?php echo $goods['price']?>
            <?php echo $goods['pic']?>
        </li>
        <?php } ?>
    </ul>
</div>

<?php } ?>


<hr>

<?php foreach($categoryList as $category ){?>
<div>
    <h1><?php echo $category['name']; ?>  </h1>
    <ul>
        <?php foreach($goodsWithCategory[$category['id']] as $goods){ ?>
        <li>
            <?php echo $goods['name']?>
            ￥<?php echo $goods['price']?>
            <?php echo $faceImagesWithGoodsId[$goods['id']]['file'] ?>
        </li>
        <?php } ?>
    </ul>
</div>

<?php } ?>





</body>
</html>