<?php
/**
 * Name: wechat-UserAnalysis.php
 * CreateDateTime: 2017/4/29 14:10
 * Author: Chison
 * Describe: 微信用户分析
 */

namespace Chison\Wechat\Statistics;

class UserAnalysis extends BaseAnalysis
{
    /**
     * @var array 用户增减数据
     */
    private $usersummary = [
        'url' => 'https://api.weixin.qq.com/datacube/getusersummary?access_token=',
        'max' => 7
    ];

    /**
     * @var array 累计用户数据
     */
    private $usercumulate = [
        'url' => 'https://api.weixin.qq.com/datacube/getusercumulate?access_token=',
        'max' => 7
    ];
}