<?php
/**
 * Name: laravel-Engine.php
 * CreateDateTime: 2017/5/3 12:46
 * Author: Chison
 * Describe: 配置以及外部需要的类调度中间件
 */

namespace Chison\Wechat;


class Engine
{
    /**
     * @var config 外部注入的配置文件
     */
    public static $config = [
        'appid' => '',
        'appsercet' => '',
        'token' => '',
        'encodeKey' => '',
        'publicName' => ''
    ];

    /**
     * @var Object 外部注入的缓存对象
     */
    public static $cache;
}