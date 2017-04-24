<?php

/**
 * Name: wechat-WeChat.php
 * CreateDateTime: 2017/4/17 13:07
 * Author: Chison
 * Describe: 微信公众号容器
 */
use Phalcon\Di;

class WeChat
{
    /**
     * 微信日志记录
     * @param $data
     * @param string $type
     * @return null
     * @throws Exception
     */
    public static function Logger($data , $type = 'wechat'){
        if(empty($data)){
            return null;
        }
        if(is_array($data)){
            \Seaslog::Log( $type ,json_encode($data));
        }else{
            \Seaslog::Log( $type ,(string)$data);
        }
    }

    /**
     * 微信签名验证
     * @param $token string 微信配置中的TOken
     * @param $timestamp string 时间戳
     * @param $nonce    string 随机数
     * @param $signature string 签名
     * @return bool
     */
    public static function checkSignature($token , $timestamp , $nonce , $signature){
        if(empty($signature)){
            self::Logger('签名为空，验证失败');
            return false;
        }
        $arr = array($token ,$nonce ,$timestamp);
        sort($arr , SORT_STRING);
        $str = implode($arr);
        $str = sha1($str);
        if($str == $signature){
            self::Logger('签名验证成功');
            return true; //验证成功
        }
        self::Logger('签名验证失败');
        return false;
    }
}