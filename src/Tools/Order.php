<?php
/**
 * Name: wechat-Order.php
 * CreateDateTime: 2017/4/28 11:08
 * Author: Chison
 * Describe: 生成订单
 */

namespace Chison\Wechat\Tools;


class Order
{
    /**
     * 生成订单编号
     */
    public function create(){
        $orderSn = sprintf('%02s' , strtoupper(dechex(date('d'))))
            . sprintf('%02d' , date('m'))
            . (intval(date('Y')) - 2017)
            . substr(time(), -4)
            . substr(microtime(), 3, 5)
            . rand(10, 99);
        echo $orderSn;
        echo "<br>";
    }
}