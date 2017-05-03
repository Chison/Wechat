<?php
/**
 * Name: wechat-Tags.php
 * CreateDateTime: 2017/5/1 15:59
 * Author: Chison
 * Describe: 微信标签管理， 2017.3 更新 , 目前每个公众号最多创建100个标签
 * 主要功能： 创建标签 , 获取标签列表 , 编辑标签 , 删除标签
 */

namespace Chison\Wechat\ManageUser;


use Chison\Wechat\Base;
use Chison\Wechat\Tools\Http;

class Tags extends Base
{
    /**
     * 创建标签 POST 请求地址
     */
    const ADD_TAG_URL = 'https://api.weixin.qq.com/cgi-bin/tags/create?access_token=';

    /**
     * 获取已经创建的标签 GET 请求地址
     */
    const GET_TAGS_URL = 'https://api.weixin.qq.com/cgi-bin/tags/get?access_token=';

    /**
     * 编辑标签的 POST 请求地址
     */
    const EDIT_TAG_URL = 'https://api.weixin.qq.com/cgi-bin/tags/update?access_token=';

    /**
     * 删除标签 POST 请求地址
     */
    const DEL_TAG_URL = 'https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=';

    /**
     * 创建一个标签 , 创建成功会返回标签名 和 标签的ID , 编辑标签和删除标签 要用该返回的ID
     * @param stirng $tagName
     * @return mixed
     */
    public function createTag(stirng $tagName){
        return Http::start(self::ADD_TAG_URL . $this->token , 'post')
            ->setData(
                json_encode(
                    ['tag' => [
                            'name' => $tagName
                    ]]
                )
            )
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * 获取标签列表
     * @return mixed
     */
    public function getTags(){
        return Http::start(self::GET_TAGS_URL . $this->token , 'get')
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * 编辑标签
     * @param int $id 标签的ID
     * @param string $tagName 标签名
     * @return mixed
     */
    public function editTag(int $id , string $tagName){
        return Http::start(self::EDIT_TAG_URL . $this->token , 'post')
            ->setData(
                json_encode(
                    ['tag' => [
                        'id'    => $id,
                        'name'  => $tagName
                    ]]
                )
            )
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * 删除标签 ,
     * 请注意(2017年5月1日)，当某个标签下的粉丝超过10w时，后台不可直接删除标签。
     * 此时，开发者可以对该标签下的openid列表，先进行取消标签的操作，直到粉丝数不超过10w后
     * @param int $id 标签的ID
     * @return mixed
     */
    public function delTag(int $id){
        return Http::start(self::ADD_TAG_URL . $this->token , 'post')
            ->setData(
                json_encode(
                    ['tag' => [
                        'id'    => $id,
                    ]]
                )
            )
            ->send()
            ->jsonToArrayResponse();
    }
}