<?php
/**
 * Name: composerWechat-Subscribe.php
 * CreateDateTime: 2017/5/8 9:31
 * Author: Chison
 * Describe: 订阅号消息推送
 */

namespace Chison\Wechat\PushMsg;


use Chison\Wechat\CInterface\PushMsgInterface;

class Subscribe extends GroupMsg implements PushMsgInterface
{
    private $limit = 1; //每天限制1
    private $userGetLimit = 4; //单用户每月限制接受4条。

    protected function init(){
        $this->url = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=' . $this->token;
    }


    //发送文本消息
    public function sentTextMsg($data){
        //需要两个参数：tag_id、content
        $data = $this->predeal(['tag_id','content'],$data);
    }

    //图片消息
    public function sentPicMsg($data){

    }

    //图文消息
    public function sentTextPicMsg($data){

    }

    //音频消息
    public function sentAudioMsg($data){

    }

    //视频消息
    public function sentMovieMsg($data){

    }

    //卡券消息
    public function sentTicketMsg($data){

    }
}