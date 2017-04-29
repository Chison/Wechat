<?php
/**
 * Name: wechat-InterfaceAnalysis.php
 * CreateDateTime: 2017/4/29 15:38
 * Author: Chison
 * Describe: 接口分析
 */

namespace Chison\Wechat\Statistics;


class InterfaceAnalysis
{
    /**
     * @var array 接口分析数据
     */
    private $interfacesummary = [
        'url' => 'https://api.weixin.qq.com/datacube/getinterfacesummary?access_token=',
        'max' => 30
    ];

    /**
     * @var array 接口分析分时数据
     */
    private $usersummary = [
        'url' => 'https://api.weixin.qq.com/datacube/getinterfacesummaryhour?access_token=',
        'max' => 1
    ];

}