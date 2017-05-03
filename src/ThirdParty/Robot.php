<?php
/**
 * Name: wechat-robot.php
 * CreateDateTime: 2017/4/19 14:48
 * Author: Chison
 * Describe:
 */

namespace Chison\Wechat\ThirdParty;


class Robot
{
    use Config;

    public function send($info){
        $params = array(
            "key" => $this->robot_appkey,//您申请到的本接口专用的APPKEY
            "info" => $info,//要发送给机器人的内容，不要超过30个字符
            "dtype" => "",//返回的数据的格式，json或xml，默认为json
            "loc" => "",//地点，如北京中关村
            "lon" => "",//经度，东经116.234632（小数点后保留6位），需要写为116234632
            "lat" => "",//纬度，北纬40.234632（小数点后保留6位），需要写为40234632
            "userid" => "",//1~32位，此userid针对您自己的每一个用户，用于上下文的关联
        );
        $paramstring = http_build_query($params);
        $content = $this->juhecurl($this->robot_url,$paramstring);
        $result = json_decode($content,true);

        if($result && $result['error_code']=='0'){
            return $result['result']['text'];
        }
        return '请说普通话~';
    }
}