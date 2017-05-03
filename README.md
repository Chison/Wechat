# Chison/Wechat #
[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/chison/wechat)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/chison/wechat)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/chison/wechat)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/chison/wechat)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/chison/wechat)

> 1、composer.json 文件配置

```json
{
    "require": {
        "chison/wechat": "dev-master"
    }
}
```
>2、进入composer.json目录 安装
```bash
    composer install
```

# 使用实例 #
> 1、配置文件 /config/config.php

```php
return [
    'appid'     =>  'your appid',
    'appsercet' =>  'your appsercet',
    'token'     =>  'your token',
    'encodeKey' =>  'your encodeKey',
    'publicName'=>  'your publicName'
];
```
> 2、 设置 /public/index.php
```php
use \Chison\Wechat\Engine;

Engine::$config = include '../config/config.php';
Engine::$cache = new Predis\Client('tcp://redis.cis:6379?password=your password');
```



