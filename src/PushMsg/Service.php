<?php
/**
 * Name: composerWechat-Service.php
 * CreateDateTime: 2017/5/8 9:32
 * Author: Chison
 * Describe: 服务号消息推送
 */

namespace Chison\Wechat\PushMsg;

use Chison\Wechat\CInterface\PushMsgInterface;

class Service extends GroupMsg implements PushMsgInterface
{
    private $limit = 100; //每天限制100
    private $userGetLimit = 4; //单用户每月限制接受4条。


    protected function init(){
        $this->url = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=' . $this->token;
    }

    //组装数据
    protected function assembly($type , $datas){
        $map = ['TextPic'=>'mpnews','Pic'=>'image','Text'=>'text','Ticket'=>'wxcard','Audio'=>'voice','Movie'=>'mpvideo'];
        $data = [];
        $data['touser'] = $datas['openid'];
        $data['msgtype'] = $map[$type];
        if($type == 'Text'){
            $data['text']['content'] = $datas['content'];
        }elseif ($type == 'PicText'){
            $data['mpnews']['media_id'] = $datas['media_id'];
            $data['send_ignore_reprint'] = 1; //是否可转载 1:可以转载， 0：是不可转载
        }elseif ($type == 'image'){
            $data['voice']['media_id'] = $datas['media_id'];
        }elseif ($type == 'wxcard'){

        }elseif ($type == 'voice'){
            $data['mpvideo']['media_id'] = $datas['media_id'];
            $data['mpvideo']['title'] = $datas['title'];
            $data['mpvideo']['description'] = $datas['description'];
        }else{
            throw new \Exception('no this data type');
        }
        $data['content'] = $datas['content']?:'没有消息主体';
        return $data;
    }

    //发送文本消息
    public function sentTextMsg($data){
        $backData = $this->predeal(['openid', 'content'], $data);
        if(is_null($backData)){
            return ;
        }
        //将数据添加到任务队列中
        $this->_tasks[] = $this->assembly('Text',$backData);
    }

    //图片消息
    public function sentPicMsg($data){
        $backData = $this->predeal(['openid', 'media_id'], $data);
        if(is_null($backData)){
            return ;
        }
        //将数据添加到任务队列中
        $this->_tasks[] = $this->assembly('Pic',$backData);
    }

    //图文消息
    public function sentTextPicMsg($data){
        $backData = $this->predeal(['openid', 'media_id' , 'send_ignore_reprint'], $data);
        if(is_null($backData)){
            return ;
        }
        //将数据添加到任务队列中
        $this->_tasks[] = $this->assembly('PicText',$backData);
    }

    //音频消息
    public function sentAudioMsg($data){
        $backData = $this->predeal(['openid', 'media_id'], $data);
        if(is_null($backData)){
            return ;
        }
        //将数据添加到任务队列中
        $this->_tasks[] = $this->assembly('Audio',$backData);
    }

    //视频消息
    public function sentMovieMsg($data){
        $backData = $this->predeal(['openid', 'media_id' , 'title' , 'description'], $data);
        if(is_null($backData)){
            return ;
        }
        //将数据添加到任务队列中
        $this->_tasks[] = $this->assembly('Movie',$backData);
    }

    //卡券消息
    public function sentTicketMsg($data){
        $backData = $this->predeal(['openid', 'wxcard'], $data);
        if(is_null($backData)){
            return ;
        }
        //将数据添加到任务队列中
        $this->_tasks[] = $this->assembly('Ticket',$backData);
    }
}