<?php
/**
 * Name: wechat-BaseAnalysis.php
 * CreateDateTime: 2017/4/29 15:02
 * Author: Chison
 * Describe:
 */

namespace Chison\Wechat\Statistics;

use Chison\Wechat\Base;
use Chison\Wechat\Tools\Http;

class BaseAnalysis extends Base
{
    /**
     * @var string 开始时间 与 结束时间的跨度不能超过接口的最大跨度
     */
    protected $beginDate = '2016-12-01';

    /**
     * @var string 结束时间 , 允许设置的最大值为昨日
     */
    protected $endDate = '2016-12-07';


    /**
     * 验证日期是否有效
     * @param $max
     * @throws \Exception
     */
    protected function isValidDate($max){
        $disparity = (strtotime($this->endDate)-strtotime($this->beginDate))/86400;
        if($disparity < 0)
            throw new \Exception('结束日期小于开始日期');
        if($disparity >= $max){
            throw new \Exception('时间跨度过大： 最大时间跨度：' . $max);
        }
    }

    /**
     * @param $type string 类型 , 需要和属性名称一致
     * @return mixed
     * @throws \Exception | array | bool
     */
    public function analysis(string $type){
        if(!property_exists($this , $type) && isset($this->$type['url'])){
            throw new \Exception('无效的图文分析方法');
        }
        $this->isValidDate($this->$type['max']);
        return Http::start($this->$type['url'] . $this->token , 'post')
            ->setData(
                json_encode(
                    [
                        'begin_date' => $this->beginDate,
                        'end_date'   => $this->endDate
                    ]
                )
            )
            ->send()
            ->jsonToArrayResponse();
    }

    /**
     * @return string
     */
    public function getBeginDate(): string
    {
        return $this->beginDate;
    }

    /**
     * @param string $beginDate
     * @return $this
     */
    public function setBeginDate(string $beginDate)
    {
        $this->beginDate = $beginDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * @param string $endDate
     * @return $this
     */
    public function setEndDate(string $endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }
}