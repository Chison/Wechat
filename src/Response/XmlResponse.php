<?php
/**
 * Name: wechat-XmlResponse.php
 * CreateDateTime: 2017/4/18 18:56
 * Author: Chison
 * Describe: 回复微信的响应
 */

namespace Chison\Wechat\Response;
use Chison\Wechat\CInterface\ReceiveEventMsgInterface;
use Chison\Wechat\CInterface\ReceiveMsgInterface;
use Chison\Wechat\Msg\ReceiveEventMsg;
use Chison\Wechat\Msg\ReceiveMsg;
class XmlResponse
{
    /**
     * @var string 存放xml
     */
    protected $xml;

    /**
     * @var string 存放解密的encoding
     */
    protected $encodingKey;

    /**
     * @var string 是否需要加密
     * default false： 不需要加密
     */
    private $isEncrypt = false;

    /**
     * @var string 返回给微信的XML
     */
    protected $responseXml;

    /**
     * @var string 存放解密后的数组
     */
    protected $tmpArray;

    /**
     * @var string 消息类型
     */
    protected $msgType;

    /**
     * @var ReceiveMsgInterface 存放接受消息对象
     */
    protected $ReceiveMsg;

    /**
     * @var ReceiveEventMsgInterface 事件对象
     */
    protected $EventMsg;

    /**
     * XmlResponse constructor.
     * @param string $receive , ReceiveMsgInterface || ''
     * @throws \Exception
     */
    public function __construct($receive = '')
    {
        $this->EventMsg = new ReceiveEventMsg();

        //默认对象
        if($receive == ''){
            $this->ReceiveMsg = new ReceiveMsg();
        }else{
            $this->ReceiveMsg = $receive;
        }
        if(!($this->ReceiveMsg instanceof ReceiveMsgInterface)){
            throw new \Exception('This Interface not implement ReceiveMsgInterface');
        }
    }

    /**
     * xml 分析
     * @return $this
     */
    public function xmlAnalysis($arr){
        $this->tmpArray = $arr;
        if(is_array($this->tmpArray) && array_key_exists('Encrypt' , $this->tmpArray)){
            $this->isEncrypt = true;
            $xml = Decrypt::factory()->dectypt($this->tmpArray['Encrypt']);
            $this->tmpArray = XmlParser::XmlToArray($xml);
            \Seaslog::Log( 'wechat' ,"解密后:\r\n" . $xml);
        }
        $this->msgType = $this->tmpArray['MsgType'];
        $this->ReceiveMsg->setMsg($this->tmpArray);
        return $this;
    }

    /**
     * xml 响应微信服务器
     */
    public function xmlResponse(){
        if(empty($this->msgType)) return 'fail';

        if($this->msgType == 'event'){
            //接受到微信的事件信息, eg: 用户允许上报地理位置, 每次进入微信公众号会提交LOCATION事件
            $funcName = strtolower($this->msgType);
            $xml = XmlParser::arrayToXml(
                $this->EventMsg->$funcName()
            );

            //成功
            $xml = 'success';
        }else{
            $funcName = strtolower($this->msgType) . 'Msg';
            $xml = XmlParser::arrayToXml(
                $this->ReceiveMsg->$funcName()
            );
        }
        \Seaslog::Log( 'wechat' ,"回复消息:\r\n" . $xml);
        //消息加密
        if($this->isEncrypt){
            return Encrypt::factory()->encode($xml);
        }
        return $xml;
    }
}