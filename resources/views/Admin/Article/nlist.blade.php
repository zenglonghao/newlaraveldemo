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
    <script type="text/html" id="switchTpl">
        <input type="checkbox" name="sex" value="" lay-skin="switch" lay-text="是|否" lay-filter="sexDemo"/>
    </script>
    <script>
        layui.use('table', function(){
            var table = layui.table;
            var limit = '{{ $pagesize }}';
            //展示已知数据
            table.render({
                elem: '#demo'
                ,url:'/admin/article/Alist'
                ,cols: [[ //标题栏
                    {field: 'article_id', title: '编号', sort: true}
                    ,{field: 'article_title', title: '文章标题'}
                    ,{field: 'article_class_id', title: '分类编号'}
                    ,{field: 'article_author', title: '文章作者'}
                    ,{field: 'article_time', title: '有效期',width:200}
                    ,{field: 'article_publish_time', title: '发布时间'}
                    ,{field: 'article_commend_flag', title: '推荐',templet: '#switchTpl', unresize: true}
                    ,{field: 'article_comment_flag', title: '评论'}
                    ,{field: 'article_state', title: '文章状态'}
                    ,{field: 'right',width:178, align:'center', toolbar: '#barDemo'}
                ]]
                ,page: true
                ,limit: limit
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

            //监听性别操作
            form.on('switch(sexDemo)', function(obj){
                layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
            });
        });


    </script>
@endsection