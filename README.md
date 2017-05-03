# Chison/Wechat #

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



