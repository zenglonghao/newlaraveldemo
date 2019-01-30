<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>layui插件的使用-内置模块</title>
        <script src="{{asset('/js/admin/index/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('/layer/layer.js')}}"></script>
        <script src="{{ asset('/layui/layui.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/layui/css/layui.css') }}">
    </head>

    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />
    <h1>弹层组件文档</h1>
    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />
    <div id="id" style="display:none;">我是一个div弹框</div>
    <script>
        //layer.msg('hello');
       /* layer.open({
            type: 1,
            content: '<span>ffff</span><br/></span>eeeeee</span>' //这里content是一个普通的String
        });*/

       /* layer.open({
            type: 1,
            content: $('#id') //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
        });*/

        //如果是iframe层
       /* layer.open({
            type: 2,
            content: 'http://sentsin.com' //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
        });*/
        //layer.alert('酷毙了', {icon: 1});
        //layer.msg('不开心。。', {icon: 5});
    </script>
    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />
    <h1>日期和时间组件</h1>
    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />

    <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
        <input type="text" class="layui-input" id="test1">
    </div>
    <script>
        layui.use('laydate', function(){
            var laydate = layui.laydate;

            //执行一个laydate实例
            laydate.render({
                elem: '#test1', //指定元素
                type:'date', //year=>年，month=>月，date=>日期（年月日）(默认) ，time=>时间(时，分，秒)，datetime=>日期时间选择器(可选择：年、月、日、时、分、秒)
                range: '~',//来自定义分割字符
                //value: '2017-09-10',//默认值
                min:'2019-01-30',//最小
                max:'2019-02-15',//最大
                trigger: 'click'//如果绑定的元素非输入框，则默认事件为：click
            });
        });
    </script>

    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />
    <h1>及时通信</h1>
    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />

    <script>
        layui.use('layim', function(layim){
            //基础配置
            layim.config({

                init: {} //获取主面板列表信息，下文会做进一步介绍

                //获取群员接口（返回的数据格式见下文）
                ,members: {
                    url: '' //接口地址（返回的数据格式见下文）
                    ,type: 'get' //默认get，一般可不填
                    ,data: {} //额外参数
                }

                //上传图片接口（返回的数据格式见下文），若不开启图片上传，剔除该项即可
                ,uploadImage: {
                    url: '' //接口地址
                    ,type: 'post' //默认post
                }

                //上传文件接口（返回的数据格式见下文），若不开启文件上传，剔除该项即可
                ,uploadFile: {
                    url: '' //接口地址
                    ,type: 'post' //默认post
                }
                //扩展工具栏，下文会做进一步介绍（如果无需扩展，剔除该项即可）
                ,tool: [{
                    alias: 'code' //工具别名
                    ,title: '代码' //工具名称
                    ,icon: '&#xe64e;' //工具图标，参考图标文档
                }]

                ,msgbox: layui.cache.dir + 'css/modules/layim/html/msgbox.html' //消息盒子页面地址，若不开启，剔除该项即可
                ,find: layui.cache.dir + 'css/modules/layim/html/find.html' //发现页面地址，若不开启，剔除该项即可
                ,chatLog: layui.cache.dir + 'css/modules/layim/html/chatlog.html' //聊天记录页面地址，若不开启，剔除该项即可
            });
        });
    </script>



</html>