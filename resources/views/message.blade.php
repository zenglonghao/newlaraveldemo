<?php //弹窗提示页面?>
<html>
    <head>
        <title>提示页面</title>
        <script src="{{asset('/js/admin/login/jquery.min.js')}}"></script>
    </head>
    <body>
        <div id="applyFor" style="text-align: center; width: 500px; margin: 100px auto;">
            {{$message}},将在<span class="loginTime" style="color: red">{{$jumpTime}}</span>
            秒后跳转至<a href="{{$url}}" style="color: red">首页</a>页面
        </div>
    </body>
    <script type="text/javascript">
        $(function(){
            var url = "{{$url}}"
            var loginTime = parseInt($('.loginTime').text());
            var time = setInterval(function(){
                loginTime = loginTime-1;
                $('.loginTime').text(loginTime);
                if(loginTime==0){
                    clearInterval(time);
                    window.location.href=url;
                }
            },1000);
        })
    </script>
</html>
