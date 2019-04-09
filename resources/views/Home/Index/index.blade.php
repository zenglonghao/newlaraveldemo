<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="{{ asset('/images/ico/2019031503084382.ico') }}">
        <title>个人案例之家</title>
        <link rel="stylesheet" href="{{ asset('/css/buttons.css') }}">
        <script src="{{asset('/js/admin/index/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('/layui/layui.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/layui/css/layui.css') }}">

    </head>
    <body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin ">
        <div class="layui-header" style="background:#0593d3;" >
            <div class="layui-logo" style="color:white;">个人案例之家</div>
            <!-- 头部区域（可配合layui已有的水平导航） -->
            <ul class="layui-nav layui-layout-left" lay-filter="hbkNavbar">
                <li class="layui-nav-item" ><a href="javascript:;" style="color:white;" data-options="{url:'l',title:'编程'}">编程</a></li>
                <li class="layui-nav-item"><a href="javascript:;" style="color:white;">读书</a></li>
                <li class="layui-nav-item"><a href="javascript:;" style="color:white;">javascript教程</a></li>
            </ul>
        </div>

        <div id="container">
            '<iframe scrolling="auto" frameborder="0"  id="iframe" src="/home.html" style="width:100%;height:100%;"></iframe>
        </div>

    </div>
    <script>
        //JavaScript代码区域
        layui.use('element', function(){
            var element = layui.element;
            element.on('nav(hbkNavbar)',function(elem){
                var options = eval('('+elem.attr("data-options")+')');
                var url = options.url;
                $('#iframe').attr('src',url);
            });
        });
    </script>
    </body>
</html>