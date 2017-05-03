<?php
/**
 * Name: wechat-Menu.php
 * CreateDateTime: 2017/4/12 20:36
 * Author: Chison
 * Describe: 微信公众号自定义菜单创建， 查询， 删除。
 */

namespace Chison\Wechat\Menu;

use Chison\Wechat\Base;
use Chison\Wechat\Tools\Http;

class Menu extends Base
{
    /**
     * 创建菜单请求的URL
     */
    const CREATMENUURL = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=';

    /**
     * 获取菜单请求的URL
     */
    const GETMENUURL = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=';

    /**
     * 删除菜单请求的URL
     */
    const DELMENUURL = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=';

    /**
     * @var string 微信凭证
     */
    protected $token;


    /**
     * 创建菜单
     * @param $data
     * @return bool|mixed
     */
    public function createMenu($data){
        return Http::start(self::CREATMENUURL . $this->token , 'post')
            ->setData($data)
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * 获取菜单
     * @return mixed
     */
    public function getMenu(){
        return Http::start(self::GETMENUURL . $this->token , 'get')
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * 删除菜单
     * @return mixed
     */
    public function delMenu(){
        return Http::start(self::DELMENUURL . $this->token , 'get')
            ->send()
            ->jsonToArrayResponse();
    }
}