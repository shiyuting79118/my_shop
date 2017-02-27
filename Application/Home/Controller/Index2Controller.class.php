<?php
namespace Home\Controller;

use Home\Model\Goods;
use Think\Controller;

class Index2Controller extends Controller
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
            $goodsWithCategory[$item['category_id']][] = new Goods($item) ;

        }
         //echo '<pre>';
        //var_dump($goodsWithCategory);exit;


        //商品分类数据
        $categoryList = M('category')->select();


        //查询所有商品的主图
        //1.得到所有商品id，放入一个数组中  array(1,2,3,4)
        $goodsIds = array();
        foreach ($goodsList as $goods) {
            $goodsIds[] = $goods['id'];
        }



        $this->assign(
            array(
                'goodsWithCategory' => $goodsWithCategory,
                'categoryList' => $categoryList,
            )
        );

        $this->display();

    }
}