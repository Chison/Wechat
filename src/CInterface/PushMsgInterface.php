<?php
/**
 * Name: composerWechat-PushMsgInterface.php
 * CreateDateTime: 2017/5/8 9:24
 * Author: Chison
 * Describe: 推送消息接口
 */

namespace Chison\Wechat\CInterface;


interface PushMsgInterface
{
    //发送文本消息
    public function sentTextMsg($data);
    //图片消息
    public function sentPicMsg($data);
    //图文消息
    public function sentTextPicMsg($data);
    //音频消息
    public function sentAudioMsg($data);
    //视频消息
    public function sentMovieMsg($data);
    //卡券消息
    public function sentTicketMsg($data);
}