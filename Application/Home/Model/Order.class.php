<?php


namespace Home\Model;

/**
 * 订单类
 */
class Order
{
    //新订单
    const STATUS_NEW = 10;
    //已完成
    const STATUS_SUCCESS = 20;
    //无效
    const STATUS_CANCEL = 30;


    //未发货
    const DELIVERY_NO = 10;
    //已发货
    const DELIVERY_YES = 20;


    //返回物流状态字符串
    public static function getDeliveryStatusStr($deliveryStatus)
    {
        switch ($deliveryStatus) {
            case self::DELIVERY_NO:
                return '未发货';
            case self::DELIVERY_YES:
                return '已发货';
            default:
                return '未知物流状态';
        }
    }




}