{% extends "common/index.volt" %}
{% block mycss %}
    <link rel="stylesheet" href="/css/index.css">
{% endblock %}
{% block container %}
    <div class="col-md-6 col-md-offset-3 ibox-content">
        <form role="form" action="/user/login" method="post" id="normal">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="用户名/邮箱/手机号码" name="usm">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="登录密码" name="pwd">
            </div>
            <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"
                   value="<?php echo $this->security->getToken() ?>"/>
            <button type="submit" name="Submit" class="btn btn-primary form-control" value="Submit">登录</button>
        </form>
        <p class="text-right register"><a></a></p>
    </div>
{% endblock %}
{% block myjs %}
    <script src="/js/jcryption.js"></script>
    <script>
        var msg = '{{ msg }}';
        $("#normal").jCryption({
            getKeysURL: "/user/login?getPublicKey=true",
            handshakeURL: "/user/login?handshake=true"
        });
        if(msg) maopao(msg);
    </script>
{% endblock %}
