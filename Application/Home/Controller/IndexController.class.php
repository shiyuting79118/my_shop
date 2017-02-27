<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {

        //商品列表
        $goodsList = M('goods')->select();

        //var_dump($goodsList);

        //按分类分组
        $goodsWithCategory = array(/*1 => array(

                array('id' => 1, 'name' => 'xx', 'price' => 11),
                array('id' => 2, 'name' => 'xxx', 'price' => 11),
            ),

            2 => array(

                array('id' => 3, 'name' => 'xxxx', 'price' => 141),
                array('id' => 4, 'name' => 'xffxx', 'price' => 11),
            )*/

        );
        foreach ($goodsList as $item) {
            $goodsWithCategory[$item['category_id']][] = $item;

        }
        // echo '<pre>';
        //var_dump($goodsWithCategory);


        //商品分类数据
        $categoryList = M('category')->select();


        //查询所有商品的主图
        //1.得到所有商品id，放入一个数组中  array(1,2,3,4)
        $goodsIds = array();
        foreach ($goodsList as $goods) {
            $goodsIds[] = $goods['id'];
        }

        //2.用 in查询 得到主图
        //select * from image  where goods_id in (1,2,3,4) and is_face = 1;
        $faceImages = array();
        if (count($goodsIds) > 0) {

            //  $faceImages = M()->query('select * from image  where goods_id in (' . join(',', $goodsIds) . ') and is_face = 1');
            $faceImages = M('image')
                ->where(array('id' => array('in', $goodsIds)))
                ->where(array('is_face' => 1))->select();
        }

        //var_dump($faceImages);exit;
        //以商品id作为key
        $faceImagesWithGoodsId = array();
        /*foreach ($faceImages as $image) {
            $faceImagesWithGoodsId[$image['goods_id']] = $image;
        }*/
        $faceImagesWithGoodsId = array_column($faceImages, null, 'goods_id');

        //var_dump($faceImagesWithGoodsId);exit;

        $this->assign(
            array(
                'goodsWithCategory' => $goodsWithCategory,
                'categoryList' => $categoryList,
                'faceImagesWithGoodsId' => $faceImagesWithGoodsId,
            )
        );

        $this->display();

    }
}