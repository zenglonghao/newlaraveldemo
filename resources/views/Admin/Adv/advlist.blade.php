<html>
    <head>
        <script src="{{ asset('/layui/layui.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/layui/css/layui.css') }}">
        <script src="{{asset('/js/admin/index/vendor/jquery/jquery.min.js')}}"></script>
    </head>
    <body>
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!--方法渲染-->
                        <table class="layui-hide" id="demo" lay-filter="demo" ></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>

    <script>
        layui.use('table', function(){
            var table = layui.table;
            var form = layui.form;
            var limit = '{{ $pagesize }}';
            var ap_id = '{{ $id }}';
            //展示已知数据
            table.render({
                elem: '#demo'
                ,url:'/admin/Adv/Aadvlist/'+ap_id//请求路径
                ,limits : [limit]///每页条数的选择项，默认：[10,20,30,40,50,60,70,80,90]。
                ,toolbar: '#toolbarDemo'
                ,cols: [[ //标题栏
                    {field: 'adv_id', title: '编号', sort: true}
                    ,{field: 'adv_title', title: '标题'}
                    ,{field: 'adv_start_date_name', title: '开始时间'}
                    ,{field: 'adv_end_date_name', title: '结束时间'}
                    ,{field: 'slide_sort', title: '排序'}
                    ,{field: 'right',width:200, align:'center', toolbar: '#barDemo'}
                ]]
                ,page: true
                ,limit: limit//每页默认显示的数量
                ,method:'get'  //提交方式
                ,skin: 'line ' //表格风格 line （行边框风格）row （列边框风格）nob （无边框风格）
                //,even: true    //隔行换色
                ,done: function(res, curr, count) {
                    //表格数据加载完后的事件
                    // res 当前表格数据  curr 当前页数 count总共页数
                    /* console.log(res);
                     console.log(curr);
                     console.log(count);*/

                }
            });
            //监听工具条
            table.on('tool(demo)', function(obj){
                var data = obj.data;
                if(obj.event === 'del'){
                    layer.confirm('真的删除行么', function(index){
                        var id = encodeURIComponent(data.adv_id);
                        console.log(id);
                        //删除文章
                        $.ajax({
                            type:'get',
                            url:'/admin/Adv/AdvDelete/'+id,
                            data:{},
                            dataType:'json',
                            success:function(res){
                                if(res.code == 200){
                                    layer.alert(res.message,{icon: 1,time:2000},function () {
                                        window.location.reload();    //重新加载父页面，进行数据刷新
                                        layer.close(index);
                                    });
                                }else{
                                    layer.alert(res.message,{icon: 1,time:2000},function () {});
                                }
                            }
                        });
                    });
                } else if(obj.event === 'edit'){
                    //脚本编辑弹出层
                    var id = encodeURIComponent(data.adv_id);
                    layer.open({
                        type: 2,
                        title: '编辑广告信息',
                        shadeClose: true,
                        shade: 0.8,
                        maxmin: true,
                        area: ['70%', '70%'],
                        content: '/admin/Adv/UAdv/'+id,//设置你要弹出的jsp页面
                        success: function(layero, index){
                            var body = layer.getChildFrame('body', index);
                            var iframeWin = window[layero.find('iframe')[0]['name']]; //得到iframe页的窗口对象，执行iframe页的方法：iframeWin.method();

                        }
                    });
                }
            });

            //监听input
            form.on('switch(sinput)', function(obj){
                var id = obj.elem.getAttribute("data");
                //接口改变状态
                $.ajax({
                    type:'get',
                    url:'/admin/Adv/astate/'+this.name+'/'+obj.elem.checked+'/'+id,
                    data:{},
                    dataType:'json',
                    success:function(res){
                        if(res.code==200){
                            layer.alert(res.msg, {icon: 1});
                        }else{
                            layer.alert(res.msg, {icon: 5});
                        }
                    }
                });
            });
        });
    </script>
    </body>
</html>