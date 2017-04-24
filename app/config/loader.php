<?php
$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->libraryDir
    ]
)->registerNamespaces(
    [
        'Chison\\Wechat'    =>  $config->application->libraryDir . '/chison/wechat/src',
    ]
)->register();
