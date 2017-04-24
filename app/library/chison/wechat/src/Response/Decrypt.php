<?php
/**
 * Name: wechat-Decrypt.php
 * CreateDateTime: 2017/4/19 9:55
 * Author: Chison
 * Describe: 安全模式下，解密微信的数据
 */

namespace Chison\Wechat\Response;

use Chison\Wechat\Base;

class Decrypt extends Base{

    public function dectypt($encrypted){
        $ciphertext_dec = base64_decode($encrypted);
        $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
        $iv = substr($this->encodeKey, 0, 16);
        mcrypt_generic_init($module, $this->encodeKey, $iv);
        $result = mdecrypt_generic($module, $ciphertext_dec);
        mcrypt_generic_deinit($module);
        mcrypt_module_close($module);

        $content = substr($result, 16, strlen($result));
        $len_list = unpack("N", substr($content, 0, 4));
        $xml_len = $len_list[1];
        $xml_content = substr($content, 4, $xml_len);
        $from_appid = substr($content, $xml_len + 4);
        //来自本公众号
        if($this->decode($from_appid) == $this->appid){
            return $xml_content;
        }else{
            return null;
        }
    }

    /**
     * 对解密后的明文进行补位删除
     * @param decrypted string 解密后的明文
     * @return string 删除填充补位后的明文
     */
    function decode($text)
    {
        $pad = ord(substr($text, -1));
        if ($pad < 1 || $pad > 32) {
            $pad = 0;
        }
        return substr($text, 0, (strlen($text) - $pad));
    }
}