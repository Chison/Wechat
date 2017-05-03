<?php
/**
 * Name: wechat-Signature.php
 * CreateDateTime: 2017/4/20 15:15
 * Author: Chison
 * Describe:
 */

namespace Chison\Wechat\JsSDK;

use Chison\Wechat\Base;
class Signature extends Base
{
    /**
     * 计算签名
     * @param string $noncestr 支付签名随机串，不长于 32 位
     * @param string $timestamp 支付签名时间戳
     * @param string $url 调用JS接口页面的完整URL
     * @return string
     */
    public function generateSignature(string $noncestr , string $timestamp , string $url){
        $arr = ["noncestr=".$noncestr,'jsapi_ticket='.$this->jsticket, 'timestamp='.$timestamp, 'url='.$url];
        asort($arr);
        $str = implode('&',$arr);
        return sha1($str);
    }

    /**
     * @return string
     */
    public function getAppid()
    {
        return $this->appid;
    }
}