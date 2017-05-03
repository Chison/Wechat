<?php
/**
 * Name: wechat-BaseWeChat.php
 * CreateDateTime: 2017/4/11 14:25
 * Author: Chison
 * Describe:初始化类 , 功能： 获取accessToken, 存储在缓存中
 *          获取微信Js Tiket, 缓存
 */

namespace Chison\Wechat;
use Chison\Wechat\Tools\Http;

class Tickets
{
    private $appid;
    private $appseret;
    private $cache;

    const ACCESSTOKEN_URL = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential";
    const JSTICKET_URL = "https://api.weixin.qq.com/cgi-bin/ticket/getticket";

    private static $wechat = null;

    /**
     * WeChatInit constructor.
     * @param $appid string
     * @param $appsecret string
     * @param $cache
     */
    private function __construct(string $appid , string $appsecret , $cache)
    {
        $this->appid = $appid;
        $this->appseret = $appsecret;
        $this->cache = $cache;
    }

    /**
     * 单例对象
     * @param string $appid
     * @param string $appsecret
     * @param $cache
     * @return Tickets|null
     */
    public static function getInstance(string $appid , string $appsecret , $cache){
        if(!(self::$wechat instanceof self)){
            self::$wechat = new self($appid , $appsecret , $cache);
        }
        return self::$wechat;
    }

    /**
     *  获取微信凭证
     */
    public function getAccessToken()
    {
        $key = $this->getTokenKey();
        if($this->cache->exists($key)){
            return $this->cache->get($key);
        }
        $url = static::ACCESSTOKEN_URL
            ."&appid={$this->appid}&secret={$this->appseret}";

        $data = Http::start($url , 'get')
            ->send()
            ->jsonToArrayResponse();
        $this->checkException($data , __METHOD__);
        $this->cache->set(
            $this->getTokenKey(),
            $data['access_token']
        );
        return $data['access_token'];
    }

    /**
     * 获取JS凭证
     * @return mixed
     */
    public function getJsTicket(){
        $key = $this->getJsTicketKey();
        if($this->cache->exists($key)){
            return $this->cache->get($key);
        }
        $url = static::JSTICKET_URL
            ."?access_token={$this->getAccessToken()}&type=jsapi";
        $data = Http::start($url , 'get')
            ->send()
            ->jsonToArrayResponse();
        //$this->checkException($data , __METHOD__);
        $this->cache->set(
            $this->getJsTicketKey(),
            $data['ticket']
        );
        return $data['ticket'];
    }

    /**
     * 检查返回的数据异常
     */
    public function checkException($data , $type)
    {
        if(isset($data['errcode'])) {
            //日志记录
            throw new \Exception($data['errmsg'], $data['errcode']);
        }
    }

    /**
     * access token cache key
     */
    public function getTokenKey()
    {
        return sprintf(":wx:accesstoken:%s" , $this->appid);
    }

    /**
     * Js Ticket cache key
     */
    public function getJsTicketKey()
    {
        return sprintf(":wx:jsticket:%s" , $this->appid);
    }
}