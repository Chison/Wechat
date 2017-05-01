<?php
/**
 * Name: wechat-User.phpateDateTime: 2017/5/1 17:11
 * Author: Chison
 * Describe: 获取用户信息、获取用户列表
 */

namespace Chison\Wechat\ManageUser;

use Chison\Wechat\Base;
use Chison\Wechat\Tools\Http;

class User extends Base
{
    /**
     * @var string 国家地区的语言版本， zh_CN 简体，zh_TW 繁体，en 英语
     */
    private $lang = 'zh_CN';

    /**
     * 获取某个用户信息 GET 请求地址
     */
    const GET_USER_INFO_URL = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=';

    /**
     * 获取用户列表 GET 请求地址
     */
    const GET_USER_LIST_URL = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token=';

    /**
     * 设置用户备注 POST 请求地址
     */
    const USER_REMARK_URL = 'https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=';

    /**
     * 获取用户信息
     * @param string $openid 用户的OPENID
     * @return mixed
     */
    public function getUserInfo(string $openid){
        return Http::start(self::GET_USER_INFO_URL . $this->token , 'get')
            ->setData(
                json_encode(
                    [
                        'openid' => $openid ,
                        'lang' => $this->lang
                    ]
                )
            )
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * 获取用户列表,
     * 注意： 每次最多获取10000个关注者的OPENID , 后面获取，需要使用返回的next_openid获取
     * @param string $next_openid 第一个拉取的OPENID，不填默认从头开始拉取
     * @return mixed
     */
    public function getUserList(string $next_openid = ''){
        return Http::start(self::GET_USER_LIST_URL . $this->token , 'get')
            ->setData(
                json_encode(
                    [
                        'next_openid' => $next_openid ,
                    ]
                )
            )
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * 设置用户备注
     * @param string $openid 用户的OPENID
     * @param string $remark 备注名称
     * @return mixed
     */
    public function setRemark(string $openid , string $remark){
        return Http::start(self::USER_REMARK_URL . $this->token , 'post')
            ->setData(
                json_encode(
                    [
                        'openid' => $openid ,
                        'remark' => $remark
                    ]
                )
            )
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     * @return $this
     */
    public function setLang(string $lang)
    {
        $this->lang = $lang;
        return $this;
    }

}