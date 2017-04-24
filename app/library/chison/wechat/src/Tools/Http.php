<?php
/**
 * Name: wechat-Http.php
 * CreateDateTime: 2017/4/17 10:47
 * Author: Chison
 * Describe:
 */

namespace Chison\Wechat\Tools;


use Phalcon\Http\Request;

class Http
{
    /**
     * @var string 方法
     */
    private $method;
    /**
     * @var string 请求地址
     */
    private $url;
    /**
     * @var array 请求数据
     */
    private $data;
    /**
     * @var array 设置选项
     */
    private $options = ['Accept' => 'application/json'];
    /**
     * @var array 设置头信息
     */
    private $header = [];

    /**
     * @var string 响应信息
     */
    protected $response;

    /**
     * Http constructor.
     * @param string $url
     * @param string $method
     */
    public function __construct(string $url = '' , string $method = 'get')
    {
        $this->url = $url;
        $this->method = $method;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string $method
     * @return $this
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param $url
     * @param $method
     * @return static
     */
    public static function start($url = '' , $method = 'get'){
        return new static($url , $method);
    }


    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setHeader($key , $value){
        $this->header[$key] = $value;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setOptions($key , $value){
        $this->options[$key] = $value;
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data){
        $this->data = $data;
        return $this;
    }


    /**
     * @return mixed
     * @throws \Exception
     */
    public function send(){
        $method = $this->method;
        if($method == 'get'){
            $response = \Requests::$method($this->url , $this->header , $this->options);
        }else{
            $response = \Requests::$method($this->url , $this->header , $this->data , $this->options);
        }
        if($response->status_code != 200){
            throw new \Exception('send request code : ' . $response->status_code);
        }
        $this->response = $response->body;
        return $this;
    }

    public function jsonToArrayResponse(){
        return json_decode($this->response , true);
    }
}