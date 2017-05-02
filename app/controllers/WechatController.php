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

    public function qrcodeAction(){
        $rz = \Chison\Wechat\Qrcode\Qrcode::factory()
            ->setSceneid(222)
            ->createQrcode();
        print_r($rz);
    }

    public function orderAction(){
        $order = new \Chison\Wechat\Tools\Order();
        $order->create();
        echo "<br>";
        $order->create();
    }

    public function userAction(){
        print_r(\Chison\Wechat\Statistics\PicAnalysis::factory()->analysis('usershare'));
    }
}