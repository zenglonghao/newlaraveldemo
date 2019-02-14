@extends('Layout.Admin.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">文章列表</div>
                        <div class="card-body">
                            <div class="demoTable">
                                搜索作者：
                                <div class="layui-inline">
                                    <input class="layui-input" name="keyword" id="demoReload" autocomplete="off" style="width:100%">
                                </div>
                                <button class="layui-btn" data-type="reload">搜索</button>
                            </div>
                            <!--方法渲染-->
                            <table class="layui-hide" id="demo" lay-filter="demo" ></table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>

    <script type="text/html" id="comment_fla">
        <input type="checkbox" name="article_comment_flag" value="" lay-skin="switch" lay-text="是|否" lay-filter="sexDemo"/>
    </script>
    <script type="text/html" id="state">
        <input type="checkbox" name="article_state" value="" lay-skin="switch" lay-text="是|否" lay-filter="sexDemo"/>
    </script>
    <script>
        layui.use('table', function(){
            var table = layui.table;
            var form = layui.form;
            var limit = '{{ $pagesize }}';
            //展示已知数据
            table.render({
                elem: '#demo'
                ,url:'/admin/article/Alist'//请求路径
                ,limits : [limit]///每页条数的选择项，默认：[10,20,30,40,50,60,70,80,90]。
                ,cols: [[ //标题栏
                    {field: 'article_id', title: '编号', sort: true}
                    ,{field: 'article_title', title: '标题'}
                    ,{field: 'ac_name', title: '分类'}
                    ,{field: 'article_author', title: '作者'}
                    ,{field: 'article_time', title: '有效期',width:200}
                    ,{field: 'article_publish_time', title: '发布时间'}
                    ,{field: 'article_commend_flag', title: '推荐', unresize: true ,
                        templet: function(d){
                            if(d.article_commend_flag){
                                return '<input type="checkbox" name="article_commend_flag" value="1" data="'+ d.article_id +'" lay-skin="switch" lay-text="是|否" lay-filter="sinput" checked />';
                            }else{
                                return '<input type="checkbox" name="article_commend_flag" value="0" data="'+ d.article_id +'" lay-skin="switch" lay-text="是|否" lay-filter="sinput" />';
                            }
                        }
                    }
                    ,{field: 'article_comment_flag', title: '评论',unresize:true,
                        templet : function(d){
                            if(d.article_comment_flag){
                                return '<input type="checkbox" name="article_comment_flag" value="1" data="'+ d.article_id +'" lay-skin="switch" lay-text="是|否" lay-filter="sinput" checked />';
                            }else{
                                return '<input type="checkbox" name="article_comment_flag" value="0" lay-skin="switch" data="'+ d.article_id +'" lay-text="是|否" lay-filter="sinput" />';
                            }
                        }
                    }
                    ,{field: 'article_state', title: '显示',unresize:true,
                        templet : function(d){
                            if(d.article_state){
                                return '<input type="checkbox" name="article_state" value="1" lay-skin="switch" data="'+ d.article_id +'" lay-text="是|否" lay-filter="sinput" checked />';
                            }else{
                                return '<input type="checkbox" name="article_state" value="0" lay-skin="switch" data="'+ d.article_id +'" lay-text="是|否" lay-filter="sinput" />';
                            }
                        }
                    }
                    ,{field: 'right',width:178, align:'center', toolbar: '#barDemo'}
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
            //条件筛选
            var $ = layui.$, active = {
                reload: function(){
                    var demoReload = $('#demoReload');
                    table.reload('demo', {
                        where: {
                            keyword: demoReload.val()
                        }
                    });
                }
            };
            //绑定搜索按钮
            $('.demoTable .layui-btn').on('click', function(){
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

            //监听工具条
            table.on('tool(demo)', function(obj){
                var data = obj.data;
                if(obj.event === 'detail'){
                    layer.msg('ID：'+ data.article_id + ' 的查看操作');
                } else if(obj.event === 'del'){
                    layer.confirm('真的删除行么', function(index){
                        var id = encodeURIComponent(data.article_id);
                        //删除文章
                        $.ajax({
                           type:'get',
                            url:'/admin/article/ndelete/'+id,
                            data:{},
                            dataType:'json',
                            success:function(res){
                                if(res.code == 200){
                                    layer.alert(res.message,{icon: 1,time:2000},function () {
                                        obj.del();
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
                    var id = encodeURIComponent(data.article_id);
                    layer.open({
                        type: 2,
                        title: '编辑文章信息',
                        shadeClose: true,
                        shade: 0.8,
                        maxmin: true,
                        area: ['70%', '70%'],
                        content: '/admin/article/update/'+id,//设置你要弹出的jsp页面
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
                    url:'/admin/article/Astate/'+this.name+'/'+obj.elem.checked+'/'+id,
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
@endsection