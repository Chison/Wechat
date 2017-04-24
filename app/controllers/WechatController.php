<?php

/**
 * Name: wechat-WechatController.php
 * CreateDateTime: 2017/4/20 14:49
 * Author: Chison
 * Describe:
 */
class WechatController extends ControllerBase
{
    public function indexAction(){
        $js = \Phalcon\Di::getDefault()->get('js');
        $this->view->js = $js;
    }
}