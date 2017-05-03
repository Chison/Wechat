<?php
/**
 * Name: wechat-ReceiveMsg.php
 * CreateDateTime: 2017/4/19 11:35
 * Author: Chison
 * Describe:
 */

namespace Chison\Wechat\CInterface;


interface ReceiveMsgInterface
{
    /**
     * 文本消息
     */
    public function textMsg();

    /**
     * 图片消息
     */
    public function imageMsg();

    /**
     * 音频消息
     */
    public function voiceMsg();

    /**
     * 视频消息
     */
    public function videoMsg();

    /**
     * 小视频消息
     */
    public function shortvideoMsg();

    /**
     * 地理位置消息
     */
    public function locationMsg();

    /**
     * 链接消息
     */
    public function linkMsg();
}