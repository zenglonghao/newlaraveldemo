<!DOCTYPE html>
<html>
<head>
    <title>404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="{{ asset('/css/404.css') }}" rel="stylesheet" type="text/css" media="all" />
    <script src="{{asset('/js/admin/login/jquery.min.js')}}"></script>
</head>
<body>
<div class="main">
    <div class="agileits_main_grid">
        <div class="agileits_main_grid_left">
            <h1>404 页面跳转时间 <span class="loginTime">3</span></h1>
        </div>
        <div class="agileits_main_grid_right">
            <a href="index.html">back to home</a>
        </div>
        <div class="clear"> </div>
    </div>
    <div class="w3l_main_grid">
        <img src="{{ asset('/images/404/1.png') }}" alt=" " class="img-responsive" />
    </div>
    <div class="w3ls_main_grid_bottom">
        <div class="w3ls_main_grid_bottom_left">
            <div class="wthree_social_buttons">
                <a href="#" class="wthree_social_button facebook"><i class="fa fa-facebook"></i></a>
                <a href="#" class="wthree_social_button twitter"><i class="fa fa-twitter"></i></a>
                <a href="#" class="wthree_social_button google"><i class="fa fa-google"></i></a>
                <a href="#" class="wthree_social_button pinterest"><i class="fa fa-pinterest"></i></a>
            </div>
        </div>
        <div class="w3ls_main_grid_bottom_right">
            <ul>
                <li>Cupidatat non proident</li>
                <li>sunt in culpa officia</li>
            </ul>
            <ul>
                <li>aliquip ex ea commodo</li>
                <li>aute irure dolor ert</li>
            </ul>
            <ul>
                <li>ut labore lore magnare</li>
                <li>nisi aliquip commodo</li>
            </ul>
        </div>
        <div class="clear"> </div>
    </div>
    <div class="agile_copy_right">
        <p>Copyright &copy; 2019.Company name All rights reserved.<a  href="/">案例之家</a></p>
    </div>
</div>
</body>
<script type="text/javascript">
    $(function(){
        var url = "JavaScript:history.go(-1)";//返回上一步
        var Time = 3;
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