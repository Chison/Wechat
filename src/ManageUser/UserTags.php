<?php
/**
 * Name: wechat-UserTags.php
 * CreateDateTime: 2017/5/1 16:08
 * Author: Chison
 * Describe: 用户的标签管理 , 目前支持公众号为用户打上最多20个标签
 */

namespace Chison\Wechat\ManageUser;

use Chison\Wechat\Base;
use Chison\Wechat\Tools\Http;

class UserTags extends Base
{
    /**
     * 获取标签下粉丝列表 GET 请求地址
     */
    const GET_TAG_USER_URL = 'https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=';

    /**
     * 批量为用户打标签 POST 请求地址
     */
    const BATCH_USERS_TAG_URL = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=';

    /**
     * 批量为用户取消标签 POST 请求地址
     */
    const BATCH_USERS_UNTAG_URL = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token=';

    /**
     * 获取用户身上的标签列表 POST 请求地址
     */
    const GET_USER_TAG_URL = 'https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token=';


    /**
     * 获取标签下粉丝列表
     * @param int $id 标签ID
     * @param string $openid 第一个拉取的OPENID，不填默认从头开始拉取
     * @return mixed
     */
    public function getTagFans(int $id , string $openid = ''){
        return Http::start(self::GET_TAG_USER_URL . $this->token , 'get')
            ->setData(
                json_encode(
                    [
                        'tagid'  => $id,
                        'next_openid' => $openid
                    ]
                )
            )
            ->send()
            ->jsonToArrayResponse();
    }


    /**
     * 批量为用户打上标签
     * @param int $id 标签ID
     * @param array $openidList 用户的OPENID列表 ['openid1','openid2']
     * @return mixed
     */
    public function batchUserTagging(int $id , array $openidList){
        return Http::start(self::BATCH_USERS_TAG_URL . $this->token , 'post')
            ->setData(
                json_encode(
                    [
                        'openid_list' => $openidList ,
                        'tagid' => $id
                    ]
                )
            )
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * 批量为用户取消标签
     * @param int $id 标签ID
     * @param array $openidList 用户的OPENID列表 ['openid1','openid2']
     * @return mixed
     */
    public function batchUserUntagging(int $id , array $openidList){
        return Http::start(self::BATCH_USERS_UNTAG_URL . $this->token , 'post')
            ->setData(
                json_encode(
                    [
                        'openid_list' => $openidList,
                        'tagid' => $id
                    ]
                )
            )
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * 获取用户身上的标签列表
     * @param string $openid 用户的OPENID
     * @return mixed
     */
    public function getUserTags(string $openid){
        return Http::start(self::GET_USER_TAG_URL . $this->token , 'get')
            ->setData(
                json_encode(
                    [
                        'openid' => $openid
                    ]
                )
            )
            ->send()
            ->jsonToArrayResponse();
    }

}