

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `password_hash` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  `created_at` int unsigned NOT NULL DEFAULT '0' COMMENT '新增时间',
  `updated_at` int unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  KEY `ind_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员';



DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `created_at` int unsigned NOT NULL DEFAULT '0' COMMENT '新增时间',
  `updated_at` int unsigned NOT NULL DEFAULT '0' COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表';

DROP TABLE IF EXISTS `goods`;
CREATE TABLE IF NOT EXISTS `goods` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NOT NULL DEFAULT '0' COMMENT '分类ID',
  `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '名称',
  `price` DEC(10,2) NOT NULL DEFAULT '0' COMMENT '单价',
  `qty` INT NOT NULL DEFAULT '0' COMMENT '数量',
  `pic` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '主图',
  `created_at` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '新增时间',
  `updated_at` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改时间'
) ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='商品表';

DROP TABLE IF EXISTS image;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `goods_id` INT NOT NULL DEFAULT '0' COMMENT '商品ID',
  `is_face` INT NOT NULL DEFAULT '0' COMMENT '是否主图',
  `file` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名称',
  `created_at` int unsigned NOT NULL DEFAULT '0' COMMENT '新增时间',
  `updated_at` int unsigned NOT NULL DEFAULT '0' COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表';



INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1, '衣服', 0, 0),
	(2, '食品', 0, 0);

	
INSERT INTO `goods` (`id`, `category_id`, `name`, `price`, `qty`, `pic`, `created_at`, `updated_at`)
VALUES
	(1, 1, '服装1', 100.00, 0, '图片1', 0, 0),
	(2, 1, '服装2', 99.00, 0, '图片2', 0, 0),
	(3, 2, '吃的1', 10.00, 0, '图片3', 0, 0),
	(4, 2, '吃的2', 20.00, 0, '图片4', 0, 0);

INSERT INTO `image` (`id`, `goods_id`, `is_face`, `file`, `created_at`, `updated_at`)
VALUES
	(1, 1, 1, '商品1主图', 0, 0),
	(2, 1, 0, '商品1详细图1', 0, 0),
	(3, 1, 0, '商品1详细图2', 0, 0),
	(4, 2, 1, '商品2主图', 0, 0),
	(5, 2, 0, '商品2详细图1', 0, 0),
	(6, 2, 0, '商品2详细图2', 0, 0);

	
	


/* 订单 */
DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order`(
  id INT AUTO_INCREMENT PRIMARY KEY,

  out_trade_no VARCHAR(32) DEFAULT '' COMMENT '订单号',/*对外显示使用的订单号 唯一 */
  name VARCHAR(100) NOT NULL DEFAULT '' COMMENT '订单名称',
  member_id INT NOT NULL DEFAULT 0 COMMENT '会员id',

  pay_type TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '支付方式',/*1在线支付 2货到付款 */
  delivery_type TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '物流方式',/*1快递 2自提*/

  total_fee DEC(10,2) NOT NULL DEFAULT 0 COMMENT '订单总额',

  status TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '订单状态',		/*订单状态: 新订单 交易成功 无效订单 */
  delivery_status  TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '运输状态',	/* 物流状态  未发货 已发货 已收货 退货中 已退货 */
  payment_status TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '支付状态',/*支付状态 未付款 已付款 已退款*/

  created_at INT NOT NULL DEFAULT 0 COMMENT '创建时间',
  updated_at INT NOT NULL DEFAULT 0 COMMENT '更新时间',
  KEY ind_out_trade_no(out_trade_no)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8;


/*订单商品明细*/
DROP TABLE IF EXISTS order_item;
CREATE TABLE IF NOT EXISTS order_item(
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL DEFAULT 0 COMMENT '订单ID',
  goods_id INT NOT NULL DEFAULT 0 COMMENT '商品ID',
  quantity INT NOT NULL DEFAULT 0 COMMENT '数量',
  price DEC(10,2) NOT NULL DEFAULT 0 COMMENT '单价',
  created_at INT NOT NULL DEFAULT 0 COMMENT '创建时间',
  updated_at INT NOT NULL DEFAULT 0 COMMENT '更新时间',
  KEY ind_order_id(order_id)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1001;

	