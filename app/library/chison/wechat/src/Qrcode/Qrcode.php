<?php
/**
 * Name: wechat-Qrcode.php
 * CreateDateTime: 2017/4/28 10:08
 * Author: Chison
 * Describe: 生成微信二维码
 */

namespace Chison\Wechat\Qrcode;


use Chison\Wechat\Base;
use Chison\Wechat\Tools\Http;

class Qrcode extends Base
{
    /**
     * @var string 二维码请求URL地址
     */
    private $qrcodeUrl = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=';

    /**
     * @var array 需要Post的数据
     * expire_seconds : 二维码有效期 , 最大不超过2592000（即30天）
     * action_name : 二维码类型，QR_SCENE为临时,QR_LIMIT_SCENE为永久,QR_LIMIT_STR_SCENE为永久的字符串参数值
     * action_info	二维码详细信息
     * scene_id	: 场景值ID，临时二维码时为32位非0整型，永久二维码时最大值为100000（目前参数只支持1--100000）
     * scene_str : 场景值ID（字符串形式的ID），字符串类型，长度限制为1到64，仅永久二维码支持此字段
     */
    private $jsonArray = [
        'expire_seconds'    => 604800,
        'action_name'       => 'QR_SCENE',
        'action_info'       => [
            'scene'     => [
                'scene_id' => 123
            ]
        ]
    ];

    /**
     * 请求微信服务器，创建临时二维码，并且获取到二维码ticket
     * @return Array(
     * [ticket] => 'ticket' //获取的二维码ticket，凭借此ticket可以在有效时间内换取二维码。
     * [expire_seconds] => 604800 //该二维码有效时间，以秒为单位。 最大不超过2592000（即30天）。
     * //二维码图片解析后的地址，开发者可根据该地址自行生成需要的二维码图片
     * [url] => http://weixin.qq.com/q/02bg2R4HjkbmO15nudNp1L
     * )
     * 使用：
     * 通过ticket直接换取二维码
     * https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=you get ticket
     */
    public function createQrcode(){
        //echo json_encode($this->jsonArray);
        return Http::start($this->qrcodeUrl . $this->token , 'post')
            ->setData(json_encode($this->jsonArray))
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * 设置场景的ID
     * @param int $id
     * @return $this
     */
    public function setSceneid(int $id){
        $this->jsonArray['action_info']['scene']['scene_id'] = $id;
        return $this;
    }

    /**
     * 设置场景的ID， 字符串
     * @param stirng $str
     * @return $this
     */
    public function setSceneStr(stirng $str){
        $this->jsonArray['action_info']['scene']['scene_str'] = $str;
        return $this;
    }

    /**
     * 设置二维码有效期 , 最大不超过2592000（即30天）
     * @param int $expire
     * @return $this
     */
    public function setExpire(int $expire){
        $this->jsonArray['expire_seconds'] = $expire;
        return $this;
    }

    /**
     * 设置场景值二维码类型
     * @param string $type
     * @return $this
     * @throws \Exception
     */
    public function setActionName(string $type){
        if(!in_array($type , array('QR_SCENE' , 'QR_LIMIT_SCENE' , 'QR_LIMIT_STR_SCENE'))){
            throw new \Exception('无效的二维码类型:' . $type);
        }
        $this->jsonArray['action_name'] = $type;
        return $this;
    }
}