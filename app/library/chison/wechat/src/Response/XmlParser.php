<?php
/**
 * Name: wechat-XmlParser.php
 * CreateDateTime: 2017/4/18 19:00
 * Author: Chison
 * Describe: 解析XML
 */

namespace Chison\Wechat\Response;


class XmlParser
{
    public static function XmlToArray($xml){
        libxml_disable_entity_loader(true);
        return json_decode(
            json_encode(
                simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)
            ),
            true
        );
    }

    public static function arrayToXml($data){
        $xml = '';
        $xml .= '<xml>';
        foreach($data as $key => $value)
        {
            if(is_numeric($key))
            {
                $tag = 'item';
                if(is_array($value))
                {
                    $xml .= "<$tag>";
                    $xml .= array2xml($value);
                    $xml .="</$tag>";
                }
                else
                {
                    $xml .= "<$tag>$value</$tag>";
                }
            }
            else
            {
                if(is_array($value))
                {
                    $keys = array_keys($value);
                    if(is_numeric($keys[0]))
                    {
                        $xml .=array2xml($value,$key);
                    }
                    else
                    {
                        $xml .= "<$key>";
                        $xml .=array2xml($value);
                        $xml .= "</$key>";
                    }

                }
                else
                {
                    $xml .= "<$key>$value</$key>";
                }
            }
        }
        $xml .= '</xml>';
        return $xml;
    }
}