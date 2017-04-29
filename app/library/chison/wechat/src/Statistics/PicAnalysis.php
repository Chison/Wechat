<?php
/**
 * Name: wechat-PicAnalysis.php
 * CreateDateTime: 2017/4/29 15:05
 * Author: Chison
 * Describe: 微信图片分析
 */

namespace Chison\Wechat\Statistics;

use Chison\Wechat\Tools\Http;

class PicAnalysis extends BaseAnalysis
{
    /**
     * @var array 图文群发每日数据
     */
    private $articlesummary = [
        'url' => 'https://api.weixin.qq.com/datacube/getarticlesummary?access_token=',
        'max' => 1
    ];

    /**
     * @var array 图文群发总数据
     */
    private $articletotal = [
        'url' => 'https://api.weixin.qq.com/datacube/getarticletotal?access_token=',
        'max' => 1
    ];

    /**
     * @var array 图文统计数据
     */
    private $userread = [
        'url' => 'https://api.weixin.qq.com/datacube/getuserread?access_token=ACCESS_TOKEN',
        'max' => 3
    ];

    /**
     * @var array 图文统计分时数据
     */
    private $userreadhour = [
        'url' => 'https://api.weixin.qq.com/datacube/getuserreadhour?access_token=',
        'max' => 1
    ];

    /**
     * @var array 图文分享转发数据
     */
    private $usershare = [
        'url' => 'https://api.weixin.qq.com/datacube/getusershare?access_token=',
        'max' => 7
    ];

    /**
     * @var array 图文分享转发分时数据
     */
    private $usersharehour = [
        'url' => 'https://api.weixin.qq.com/datacube/getusersharehour?access_token=',
        'max' => 1
    ];
}