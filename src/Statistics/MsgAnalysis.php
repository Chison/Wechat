<?php
/**
 * Name: wechat-MsgAnalysis.php
 * CreateDateTime: 2017/4/29 15:27
 * Author: Chison
 * Describe: 微信消息分析
 */

namespace Chison\Wechat\Statistics;

class MsgAnalysis extends BaseAnalysis
{
    /**
     * @var array 消息发送概况数据
     */
    private $upstreammsg = [
        'url' => 'https://api.weixin.qq.com/datacube/getupstreammsg?access_token=',
        'max' => 7
    ];

    /**
     * @var array 消息分送分时数据
     */
    private $upstreammsghour = [
        'url' => 'https://api.weixin.qq.com/datacube/getupstreammsghour?access_token=',
        'max' => 1
    ];

    /**
     * @var array  消息发送周数据
     */
    private $upstreammsgweek = [
        'url' => 'https://api.weixin.qq.com/datacube/getupstreammsgweek?access_token=',
        'max' => 30
    ];

    /**
     * @var array 消息发送月数据
     */
    private $upstreammsgmonth = [
        'url' => 'https://api.weixin.qq.com/datacube/getupstreammsgmonth?access_token=',
        'max' => 30
    ];

    /**
     * @var array 消息发送分布数据
     */
    private $upstreammsgdist = [
        'url' => 'https://api.weixin.qq.com/datacube/getupstreammsgdist?access_token=',
        'max' => 15
    ];

    /**
     * @var array 消息发送分布周数据
     */
    private $upstreammsgdistweek = [
        'url' => 'https://api.weixin.qq.com/datacube/getupstreammsgdistweek?access_token=',
        'max' => 30
    ];

    /**
     * @var array 消息发送分布月数据
     */
    private $upstreammsgdistmonth = [
        'url' => 'https://api.weixin.qq.com/datacube/getupstreammsgdistmonth?access_token=',
        'max' => 30
    ];
}