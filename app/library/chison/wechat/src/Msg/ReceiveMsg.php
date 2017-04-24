<?php
/**
 * Name: wechat-Text.php
 * CreateDateTime: 2017/4/19 11:12
 * Author: Chison
 * Describe: 接受消息, 并且组装回复消息
 */

namespace Chison\Wechat\Msg;

use Chison\Wechat\CInterface\ReceiveMsgInterface;
use Chison\Wechat\ThirdParty\Robot;

class ReceiveMsg implements ReceiveMsgInterface
{
    private $msg;
    private $reply;
    private $robot;

    public function __construct()
    {
        $this->reply = new PassiveReplyMsg();
        $this->robot = new Robot(); //聚合机器人
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * 文本消息
     * @return mixed
     */
    public function textMsg(){
        if($this->msg['Content']){
            return $this->reply->text($this->msg , $this->robot->send($this->msg['Content']));
        }else{
            return $this->reply->text($this->msg ,'机器人zzz');
        }
    }

    /**
     * 图片消息
     */
    public function imageMsg(){
        return $this->reply->text($this->msg , '图片微信存放地址：' . $this->msg['PicUrl']);
    }

    /**
     * 音频消息
     */
    public function voiceMsg(){
        return $this->reply->text($this->msg ,'音频消息正在开发中...');
    }

    /**
     * 视频消息
     */
    public function videoMsg(){
        return $this->reply->text($this->msg , '视频消息正在开发中...');
    }

    /**
     * 小视频消息
     */
    public function shortvideoMsg(){
        return $this->reply->text($this->msg , '短视频消息正在开发中...');
    }

    /**
     * 地理位置消息
     */
    public function locationMsg(){
        return $this->reply->text($this->msg , '['
            . $this->msg['Location_X']
            . ','
            . $this->msg['Location_Y']
            . "] \r\n位置："
            . $this->msg['Label']);
    }

    /**
     * 链接消息
     */
    public function linkMsg(){
        return $this->reply->text($this->msg ,'这是链接消息：' . $this->msg['Url']);
    }
}