<?php
/**
 * Name: composerWechat-Material.php
 * CreateDateTime: 2017/5/8 9:34
 * Author: Chison
 * Describe:
 */
namespace Chison\Wechat\Material;
use \Chison\Wechat\PushMsg\GroupMsg;

class Material extends GroupMsg
{
    /**
     * 获取各种素材
     * @param string $type
     * @param int $offset
     * @param int $count
     * @return mixed
     */
    //类型：　图片（image）、视频（video）、语音 （voice）、图文（news）
    public function batchGetMaterial($type = 'news', $offset = 0, $count = 20){
        $this->url = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=' . $this->token;
        $data = array(
            'type' => $type,
            'offset' => intval($offset),
            'count' => $count,
        );
        $response = json_decode($this->request_post($data),true);
        return $response;
    }
}