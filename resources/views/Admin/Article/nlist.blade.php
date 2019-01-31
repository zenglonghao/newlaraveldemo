@extends('Layout.Admin.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">文章列表</div>
                        <div class="card-body">

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
    <script>
        layui.use('table', function(){
            var table = layui.table;
            var data=`<?php echo $article; ?>`;
            var newsdata = JSON.parse(data);
            //展示已知数据
            table.render({
                elem: '#demo'
                ,cols: [[ //标题栏
                    {field: 'article_id', title: '编号', sort: true}
                    ,{field: 'article_title', title: '文章标题'}
                    ,{field: 'article_class_id', title: '分类编号'}
                    ,{field: 'article_author', title: '文章作者'}
                    ,{field: 'article_time', title: '有效期',width:200}
                    ,{field: 'article_publish_time', title: '发布时间'}
                    ,{field: 'article_commend_flag', title: '推荐',width:60}
                    ,{field: 'article_comment_flag', title: '评论',width:60}
                    ,{field: 'article_state', title: '文章状态'}
                    ,{field: 'right',width:178, align:'center', toolbar: '#barDemo'}
                ]]
                ,data: newsdata.data
                ,page: true
            });
            //监听工具条
            table.on('tool(demo)', function(obj){
                var data = obj.data;
                if(obj.event === 'detail'){
                    layer.msg('ID：'+ data.article_id + ' 的查看操作');
                } else if(obj.event === 'del'){
                    layer.confirm('真的删除行么', function(index){
                        obj.del();
                        layer.close(index);
                    });
                } else if(obj.event === 'edit'){
                    layer.alert('编辑行：<br>'+ JSON.stringify(data))
                }
            });
        });


    </script>
@endsection