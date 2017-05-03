<?php
/**
 * Name: wechat-Base.php
 * CreateDateTime: 2017/4/17 11:36
 * Author: Chison
 * Describe:
 * 1、载入trait Config 并且将配置注入到属性中
 * 2、设置微信凭证，access_token
 */

namespace Chison\Wechat;

use Chison\Wechat\Tools\Http;

class Base
{
    use Config;

    protected $http;



    /**
     * Base constructor.
     */
    final public function __construct()
    {
        $this->http = new Http;
        $this->settingConfig();
    }


    public static function factory()
    {
        return new static();
    }
}