<?php
use phalcon\Di;

class UserController extends \Phalcon\Mvc\Controller
{
    //用户登录
    //使用非对对称加密，加密表单数据
    public function loginAction()
    {
        if(!$this->request->isPost() && !$this->request->isAjax()){
            $this->dispatcher->forward([
                'controller' => "index",
                'action' => 'index'
            ]);
            $this->view->msg = '请先登录';
            return ;
        }
        //Ajax - 返回公钥 和 handshake || POST - 私钥解密
        $secret = Di::getDefault()->get('secret');
        $secret->go();

        $tokenKey = $this->session->get('$PHALCON/CSRF/KEY$');
        $tokenValue = $this->session->get('$PHALCON/CSRF$');

        //伪请求
        if (is_null($tokenValue) || is_null($tokenKey) || !$this->security->checkToken($tokenKey , $tokenValue)) {
            $this->response->setContent('不支持跨站登录');
            $this->response->send();
            return ;
        }

        $uname = $this->request->get('usm');
        $passwd = $this->request->get('pwd');

        $user = CisUser::findFirstByUname($uname);
        //验证登录
        if(password_verify($passwd,$user->passwd)){
            $this->session->set('uname',$uname);
            $this->session->set('login',time());
            //登录记录
            $login = new CisLogin();
            $login->setUid($user->id);
            $login->setLoginTime(time());
            $login->setIp($this->request->getClientAddress());
            $login->save();
            //提示
            $this->response->setContent('登录成功');
            $this->response->send();
        }else{
            $this->dispatcher->forward([
                'controller' => "index",
                'action' => 'index'
            ]);
            $this->session->set('login',0);
            $this->view->msg = '登录失败';
            return ;
        }
    }

    public function logoutAction()
    {
        $this->session->remove('uname');
        $this->session->remove('login');
        $this->dispatcher->forward([
            'controller' => "index",
            'action' => 'index'
        ]);
    }

}

