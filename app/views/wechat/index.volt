{% extends "common/index.volt" %}
    {% block container %}
        <p id="cis_msg"></p>
    {% endblock %}
{% block myjs %}
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <script>
        wx.config({
            debug: false,
            appId: '{{ js.getAppid() }}',
            timestamp: '{{ js.getTimestamp() }}',
            nonceStr: '{{ js.getNoncestr() }}',
            signature: '{{ js.getSignature() }}',
            jsApiList: [
                'getLocation'
            ]
        });
        wx.ready(function(){
            wx.getLocation({
                type: 'wgs84',
                success: function (res) {
                    var latitude = res.latitude;
                    var longitude = res.longitude;
                    var speed = res.speed;
                    var accuracy = res.accuracy;
                    $('#cis_msg').text(latitude + '-' + longitude)
                },
            });
        });
    </script>
{% endblock %}