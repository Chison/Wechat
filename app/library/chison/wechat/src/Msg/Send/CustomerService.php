<?php
/**
 * Name: wechat-CustomerService.php
 * CreateDateTime: 2017/4/20 13:46
 * Author: Chison
 * Describe: 客服消息
 */

namespace Chison\Wechat\Msg\Send;

use Chison\Wechat\Base;

class CustomerService extends Base
{
    /**
     * 添加客服URL
     */
    const ADD_CUSTOMER      = 'https://api.weixin.qq.com/customservice/kfaccount/add?access_token=';
    /**
     * 编辑客服URL
     */
    const EDIT_CUSTOMER     = 'https://api.weixin.qq.com/customservice/kfaccount/update?access_token=';
    /**
     * 删除客服URL
     */
    const DEL_CUSTOMER      = 'https://api.weixin.qq.com/customservice/kfaccount/del?access_token=';
    /**
     * 设置客服头像URL
     */
    const SET_CUSTOMER_PIC  = 'http://api.weixin.qq.com/customservice/kfaccount/uploadheadimg?access_token=';
    /**
     * 获取客服列表URL
     */
    const GET_CUSTOMER_LIST = 'https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=';

    /**
     * 添加客服账号
     * @param string $account 客服账号
     * @param string $nickname 客服昵称
     * @param string $password 客服密码
     * @return mixed
     */
    public function addCustomer(string $account , string $nickname , string $password){
        return $this->http
            ->setUrl(self::ADD_CUSTOMER . $this->token)
            ->setMethod('post')
            ->setData(
                json_encode([
                'kf_account' => $account,
                'nickname' => $nickname,
                'password' => $password
                ])
            )
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * 修改客服账号
     * @param string $account 客服账号
     * @param string $nickname 客服昵称
     * @param string $password 客服密码
     * @return mixed
     */
    public function editCustomer(string $account , string $nickname , string $password){
        return $this->http
            ->setUrl(self::EDIT_CUSTOMER . $this->token)
            ->setMethod('post')
            ->setData(
                json_encode([
                    'kf_account' => $account,
                    'nickname' => $nickname,
                    'password' => $password
                ])
            )
            ->send()
            ->jsonToArrayResponse();
    }
    /**
     * 删除客服账号
     * @param string $account 客服账号
     * @param string $nickname 客服昵称
     * @param string $password 客服密码
     * @return mixed
     */
    public function delCustomer(string $account , string $nickname , string $password){
        return $this->http
            ->setUrl(self::DEL_CUSTOMER . $this->token)
            ->setMethod('post')
            ->setData(
                json_encode([
                    'kf_account' => $account,
                    'nickname' => $nickname,
                    'password' => $password
                ])
            )
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * 获取客服账号
     * @return mixed
     */
    public function getCustomer(){
        return $this->http
            ->setUrl(self::GET_CUSTOMER_LIST . $this->token)
            ->setMethod('get')
            ->send()
            ->jsonToArrayResponse();
    }

}