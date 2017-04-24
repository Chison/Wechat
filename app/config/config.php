<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => '123456',
        'dbname'      => 'phalcon',
        'charset'     => 'utf8',
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'vendorDir'       => BASE_PATH . '/vendor/',

        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the webpspace.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri'        => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
    ],
    'wechat'  =>  [
        'appid'     =>  'wx95e29d496fe45adb',
        'appsercet' =>  '28b773faf6c2d8f1c27b53239e171088',
        'token'     =>  'Imsg09129os8',
        'encodeKey' =>  'PZEFxjpfHXwwcJ3xonHZFwF00FCprFWFCNxFHeHNzWw',
        'publicName'=>  'gh_791e902840a3'
    ],
    'redis'     =>  [
        'host'       => 'redis.cis',
        'port'       => 6379,
        'auth'       => 'mingdu@1',
        'persistent' => false,
        'index'      => 0,
        'lifetime'   => 7180
    ]
]);
