<?php
/**
 * Name: wechat-SendMsg.php
 * CreateDateTime: 2017/4/19 11:21
 * Author: Chison
 * Describe: 被动回复消息
 */

namespace Chison\Wechat\Msg;

/**
 * 被动回复消息， 将消息组装成所需格式的数组
 * Class PassiveReplyMsg
 * @package Chison\Wechat\Msg
 */
class PassiveReplyMsg
{
    /**
     * 被动回复, 文本消息
     * @param $receiveMsg , 接受消息的数组 , 包含FromUserName、ToUserName
     * @param $content , 回复的消息内容
     * @return array
     */
    public function text($receiveMsg , $content){
        $tmp['ToUserName'] = $receiveMsg['FromUserName'];
        $tmp['FromUserName'] = $receiveMsg['ToUserName'];
        $tmp['CreateTime'] = time();
        $tmp['MsgType'] = 'text';
        $tmp['Content'] = $content;
        return $tmp;
    }

    /**
     * 被动回复, 图片消息
     * @param $receiveMsg  , 接受消息的数组 , 包含FromUserName、ToUserName
     * @param $MediaId , 图片材料的MediaId
     * @return array
     */
    public function image($receiveMsg , $MediaId){
        $tmp['ToUserName'] = $receiveMsg['FromUserName'];
        $tmp['FromUserName'] = $receiveMsg['ToUserName'];
        $tmp['CreateTime'] = time();
        $tmp['MsgType'] = 'image';
        $tmp['Image']['MediaId'] = $MediaId;
        return $tmp;
    }

    /**
     * 被动回复, 音频消息
     * @param $receiveMsg , 接受消息的数组 , 包含FromUserName、ToUserName
     * @param $MediaId , 音频材料的MediaId
     * @return array
     */
    public function voice($receiveMsg , $MediaId){
        $tmp['ToUserName'] = $receiveMsg['FromUserName'];
        $tmp['FromUserName'] = $receiveMsg['ToUserName'];
        $tmp['CreateTime'] = time();
        $tmp['MsgType'] = 'voice';
        $tmp['Voice']['MediaId'] = $MediaId;
        return $tmp;
    }

    /**
     * 被动回复, 视频消息
     * @param $receiveMsg , 接受消息的数组 , 包含FromUserName、ToUserName
     * @param $MediaId , 视频材料的MediaId
     * @param $title , 视频消息的标题
     * @param $description , 视频消息的描述
     * @return mixed
     */
    public function video($receiveMsg , $MediaId , $title = '', $description = ''){
        $tmp['ToUserName'] = $receiveMsg['FromUserName'];
        $tmp['FromUserName'] = $receiveMsg['ToUserName'];
        $tmp['CreateTime'] = time();
        $tmp['MsgType'] = 'video';
        $tmp['Video']['MediaId'] = $MediaId;
        $tmp['Video']['Title'] = $title;
        $tmp['Video']['Description'] = $description;
        return $tmp;
    }

    /**
     * 被动回复, 音乐消息
     * @param $receiveMsg  , 接受消息的数组 , 包含FromUserName、ToUserName
     * @param $MediaId , 缩略图的媒体id，通过素材管理中的接口上传多媒体文件，得到的id
     * @param string $musicUrl , 音乐链接
     * @param string $hqmusicurl , 高质量音乐链接，WIFI环境优先使用该链接播放音乐
     * @param string $title , 音乐标题
     * @param string $description , 音乐描述
     * @return mixed
     */
    public function music($receiveMsg , $MediaId , $musicUrl = '' , $hqmusicurl = '' , $title = '', $description = ''){
        $tmp['ToUserName'] = $receiveMsg['FromUserName'];
        $tmp['FromUserName'] = $receiveMsg['ToUserName'];
        $tmp['CreateTime'] = time();
        $tmp['MsgType'] = 'music';
        $tmp['Music']['Title'] = $title;
        $tmp['Music']['Description'] = $description;
        $tmp['Music']['MusicUrl'] = $musicUrl;
        $tmp['Music']['HQMusicUrl'] = $hqmusicurl;
        $tmp['Music']['ThumbMediaId'] = $MediaId;
        return $tmp;
    }

    /**
     * 被动回复, 图文消息
     * @param $receiveMsg  , 接受消息的数组 , 包含FromUserName、ToUserName
     * @param $Articles , 多条图文消息信息，默认第一个item为大图,注意，如果图文数超过8，则将会无响应
     * 格式：
     * [
     *      0 => [
     *          'Title' => '', // 图文消息标题
     *          'Description' => '', // 图文消息描述
     *          'PicUrl' => '', // 图片链接，支持JPG、PNG格式，较好的效果为大图360*200，小图200*200
     *          'Url' => '' // 点击图文消息跳转链接
     *      ],
     *      ...
     * ]
     * @return mixed
     */
    public function news($receiveMsg , $Articles){
        $tmp['ToUserName'] = $receiveMsg['FromUserName'];
        $tmp['FromUserName'] = $receiveMsg['ToUserName'];
        $tmp['CreateTime'] = time();
        $tmp['MsgType'] = 'news';
        $tmp['ArticleCount'] = count($Articles);
        foreach ($Articles as $k => $v){
            $tmp['Articles'][$k]['Title'] = $v['Title'];
            $tmp['Articles'][$k]['Description'] = $v['Description'];
            $tmp['Articles'][$k]['PicUrl'] = $v['PicUrl'];
            $tmp['Articles'][$k]['Url'] = $v['Url'];
        }
        return $tmp;
    }

}