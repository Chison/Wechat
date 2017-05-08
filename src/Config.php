<?php
/**
 * Name: wechat-Config.php
 * CreateDateTime: 2017/4/19 9:10
 * Author: Chison
 * Describe: 微信配置trait, 与 Di容器形成依赖
 */

namespace Chison\Wechat;

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
     * 配置设置
     */
    public function settingConfig()
    {
        $this->appid = Engine::$config['appid'];
        $this->appsercet = Engine::$config['appsercet'];
        $this->ctoken = Engine::$config['token'];
        $this->encodeKey = base64_decode(Engine::$config['encodeKey'] . "=");
        $this->publicName = Engine::$config['publicName'];
        $ticket = Tickets::getInstance($this->appid , $this->appsercet , Engine::$cache);
        $this->token = $ticket->getAccessToken();
        $this->jsticket = $ticket->getJsTicket();
    }

    /**
     * @param $token
     * @return $this
     */
    public function setToken($token){
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(){
        return $this->token;
    }
}