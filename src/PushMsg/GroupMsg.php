<?php
/**
 * Name: composerWechat-GroupMsg.php
 * CreateDateTime: 2017/5/8 9:26
 * Author: Chison
 * Describe: 群发消息，订阅号和服务号的父类
 */

namespace Chison\Wechat\PushMsg;

use Chison\Wechat\Base;
use Chison\Wechat\Tools\Http;

abstract class GroupMsg
{
    protected $token = '';
    protected $url = '';
    protected $msgType = ['TextPic','Pic','Text','Ticket','Audio','Movie'];//消息的类型：TextPic、Pic、Text、Ticket、Audio、Movie六种类型
    protected $_tasks = []; //存放任务列表的数据

    public function __construct()
    {
        $this->init();
        $this->token = (new Base())->getToken();
    }

    //子类中调用：初始化
    protected function init(){}

    //推送群消息接口
    public function sentGroupMsg($data , $type = 'Text'){
        if(!in_array($type , $this->msgType)){
            throw new \Exception('function not exist!');
        }
        $fucName = 'sent' . $type . 'Msg';
        $data['type'] = $type;
        $this->$fucName($data);
    }

    //测试消息:消息预览接口
    public function debug(){

    }

    //输入数据格式预处理
    protected function predeal($needle , $data){
        //必要字段检测
        foreach ($needle as $v){
            if(!array_key_exists($v , $data)) {
                throw new \Exception('数据格式不正确');
            }
        }
        return $data;
    }

    //返回数据预处理
    public function preOutputData($data , $odata){
        if(!$data){
            throw new \Exception('任务提交失败');
        }

        $rz = json_decode($data,true);
        if(!empty($rz)){
            $stdata = ['msgid'=>$rz['msg_id']?:0,'errcode'=>$rz['errcode'],'msgtype'=>$odata['msgtype'] ,'tasktime'=>date('Y-m-d G:i:s')];
            if(array_key_exists('msg_data_id',$rz)){
                $stdata['msgdataid'] = $rz['msg_data_id'];
            }
            if(array_key_exists('content',$odata)){
                $stdata['content'] = $odata['content'];
            }
            //pdo_insert('group_msg_note',$stdata);
        }

        /*若要迁移，该对象也要定义error_code方法*/
//        $rz['msg'] = $this->_handle->error_code($rz['errcode']);
//        $notice = $rz['msg'] == '未知错误'?$rz:$rz['msg'];

        if($rz['errcode'] !== 0){
            throw new \Exception('任务提交失败');
        }
    }

    //post-data: 上线使用
    protected function request_post($post_data = array(),$method = 'POST') {
        return Http::start($this->url , strtolower($method))
            ->setData(
                json_encode(
                    $post_data
                )
            )->send()
            ->jsonToArrayResponse();
    }

    //运行任务
    public function run(){
        foreach ($this->_tasks as $v){
            $this->preOutputData($this->request_post($v) , $v);
        }
    }
}