<?php

namespace Home\Model;

/**
 * 商品类
 */
class Goods
{
    public $id;
    public $name;
    public $price;
    public $pic;

    public function __construct(array $attributes)
    {
        foreach ($attributes as $k => $v) {
            $this->$k = $v;
        }
    }

    /**
     * 商品主图
     * @return array|null  例如array('id'=>1,'file'=>'xxx.jpg', ... )
     */
    public function getFaceImage()
    {
        return M('image')->where(array('goods_id' => $this->id, 'is_face' => 1))->find();
    }
}