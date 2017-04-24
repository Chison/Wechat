<?php
/**
 * Name: wechat-Config.php
 * CreateDateTime: 2017/4/19 9:10
 * Author: Chison
 * Describe: 微信配置trait, 与 Di容器形成依赖
 */

namespace Chison\Wechat;
use Phalcon\Di;

trait Config
{
    protected $appid;
    protected $appsercet;
    /**
     * @var string 微信配置的token
     */
    protected $ctoken;
    protected $encodeKey;
    protected $publicName;

    /**
     * @var string access_token
     */
    protected $token;

    /**
     * @var string access_token
     */
    protected $jsticket;

    /**
     * Config constructor.
     */
    public function settingConfig()
    {
        $config = Di::getDefault()->getConfig();
        $this->appid = $config->wechat->appid;
        $this->appsercet = $config->wechat->appsercet;
        $this->ctoken = $config->wechat->token;
        $this->encodeKey = base64_decode($config->wechat->encodeKey . "=");
        $this->publicName = $config->wechat->publicName;
        $this->token = Di::getDefault()->get('wechat')->getAccessToken();
        $this->jsticket = Di::getDefault()->get('wechat')->getJsTicket();
    }

    /**
     * @param $token
     * @return $this
     */
    public function setToken($token){
        $this->token = $token;
        return $this;
    }
}