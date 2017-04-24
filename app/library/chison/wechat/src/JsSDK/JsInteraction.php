<?php
/**
 * Name: wechat-JsInteractionraction.php
 * CreateDateTime: 2017/4/20 15:41
 * Author: Chison
 * Describe: Js交互
 */

namespace Chison\Wechat\JsSDK;

use Chison\Wechat\Response\Encrypt;

/**
 * 提供js wx.config的公众号配置
 * Class JsInteraction
 * @package Chison\Wechat\JsSDK
 */
class JsInteraction
{
    /**
     * @var string 随机字符串
     */
    private $noncestr;
    /**
     * @var string 签名
     */
    private $signature;
    /**
     * @var int 时间戳
     */
    private $timestamp;
    /**
     * @var string 当前页面的URL
     */
    private $url;
    /**
     * @var string 公众号的appid
     */
    private $appid;

    /**
     * JsInteraction constructor.
     */
    public function __construct()
    {
        $this->url = $this->curPageURL();
        $this->noncestr = Encrypt::factory()->getRandomStr();
        $this->timestamp = time();
        $this->signature = Signature::factory()->generateSignature(
            $this->noncestr,
            $this->timestamp,
            $this->url
        );
        $this->appid = Signature::factory()->getAppid();
    }

    /**
     * @return mixed
     */
    public function getNoncestr()
    {
        return $this->noncestr;
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     * 获取当前页面的URL
     * @return string
     */
    public function curPageURL()
    {
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        }
        else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
}