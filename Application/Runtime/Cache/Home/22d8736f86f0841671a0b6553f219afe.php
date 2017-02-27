<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<h1>商品<?php echo ($id); ?></h1>

<form action="<?php echo U('cart/add');?>" method="post">
    <input type="hidden" name="goods_id" value="<?php echo ($id); ?>">
    <input type="text" name="qty" value="1">
    <input type="submit" value="确定">
</form>

</body>
</html>