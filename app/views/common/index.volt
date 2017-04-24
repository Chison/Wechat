<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 ,user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>test</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/public.css">
    {% block mycss %}
    {% endblock %}
</head>
<body>
<div class="container">
    {% block container %}

    {% endblock %}
</div>
<!-- 冒泡 -->
<div class="modal fade"  role="dialogs" aria-labelledby="exitModalLabel" id="maopaos">
    <div class="modal-dialogs modal-lg" role="document">
        <div class="modal-content text-center new-style">
            <p class="cis_p1" id="maopaomsg"></p>
        </div>
    </div>
</div>
<script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/js/public.js"></script>
{% block myjs %}
{% endblock %}
</body>
</html>
