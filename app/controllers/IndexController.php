<?php
use Phpml\Classification\KNearestNeighbors;
use Chison\Wechat\Response\XmlParser;
use Chison\Wechat\Response\XmlResponse;

class IndexController extends ControllerBase
{
    //check验证
    public function indexAction()
    {
        //记录信息
        $receiveData = file_get_contents("php://input");
        WeChat::Logger($receiveData);
        //公众号接入
        if($this->request->isGet() && !empty($this->request->get('signature'))){
            $signature  = $this->request->get('signature');
            $echostr    = $this->request->get('echostr');
            $timestamp  = $this->request->get('timestamp');
            $nonce      = $this->request->get('nonce');
            $config = Phalcon\Di::getDefault()->getConfig();
            if(WeChat::checkSignature($config->wechat->token , $timestamp , $nonce , $signature)){
                echo $echostr;
                exit();
            }
        }

        //分析微信客户端响应
        if(!empty($receiveData) && $arr = XmlParser::XmlToArray($receiveData)){
            //微信客户端的数据
            if(isset($arr['ToUserName'])){
                echo (new XmlResponse(new \Chison\Wechat\Msg\ReceiveMsg()))->xmlAnalysis($arr)->xmlResponse();
                exit();
            }
        }
    }


   public function index2Action()
    {
        if($this->session->get('login') != 0){
            echo $this->session->get('uname') . '已登录';
            return '<a href="/user/logout">注销登录</a>';
        }
        $this->view->msg = $this->view->msg ? : '';
    }


    public function testAction(){
        //WeChat::getAccessToken();

        $samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
        $labels = ['a', 'a', 'a', 'b', 'b', 'b'];

        $classifier = new KNearestNeighbors();
        $classifier->train($samples, $labels);

        echo $classifier->predict([3, 2]); // b
    }

    public function wechatAction(){
        //WeChat::getAccessToken();
        //WeChat::Logger(array(1234,123,5,4,124));
        var_dump((new \Chison\Wechat\ThirdParty\Robot())->send('弄好'));
    }
}

