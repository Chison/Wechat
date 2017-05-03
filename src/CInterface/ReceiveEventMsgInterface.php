<?php
/**
 * Name: wechat-ReceiveEventMsgInterface.php
 * CreateDateTime: 2017/4/19 11:32
 * Author: Chison
 * Describe:
 */

namespace Chison\Wechat\CInterface;


interface ReceiveEventMsgInterface
{
    /**
     * 关注事件
     */
    public function subscribe();

    /**
     * 取消关注事件
     */
    public function unsubscribe();

    /**
     * 上报地理位置
     */
    public function location();

    /**
     * 扫描带参数二维码事件 :  用户未关注时，进行关注后的事件推送
     */
    public function scanNotSubscribe();

    /**
     * 扫描带参数二维码事件 :  用户已关注时的事件推送
     */
    public function scan();

    /**
     * 自定义菜单事件
     * 请注意，点击菜单弹出子菜单，不会产生上报。
     */
    public function menuClick();
}