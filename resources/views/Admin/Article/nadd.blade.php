@extends('Layout.Admin.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/admin/article/save" class="layui-form" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header bg-light">添加文章</div>
                        <div class="card-body">

                            <div class="layui-form-item">
                                <label class="layui-form-label">文章标题</label>
                                <div class="layui-input-block">
                                    <input type="text" name="article_title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">文章的分类</label>
                                <div class="layui-input-block">
                                    <select name="article_class_id" lay-verify="required">
                                        <option value="0">--请选择--</option>
                                        @foreach($article_class as $v)
                                            <option value="{{ $v->ac_id }}">{{ $v->ac_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">文章来源</label>
                                <div class="layui-input-block">
                                    <input type="text" name="article_origin" required  lay-verify="required" placeholder="文章来源" autocomplete="off" class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">文章作者</label>
                                <div class="layui-input-block">
                                    <input type="text" name="article_author" required  lay-verify="required" placeholder="文章作者" autocomplete="off" class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">文章摘要</label>
                                <div class="layui-input-block">
                                    <input type="text" name="article_abstract" required  lay-verify="required" placeholder="文章摘要" autocomplete="off" class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">文章正文</label>
                                <div class="layui-input-block">
                                   {!! show_ueditor('ueditor','article_content') !!}
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">文章图片</label>
                                <div class="layui-input-block">
                                    <input type="file" name="article_image"/>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">有效时间</label>
                                <div class="layui-input-block">
                                    <input type="text" class="layui-input" name="article_time" id="test1"/>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">文章排序</label>
                                <div class="layui-input-block">
                                    <input type="text" name="article_sort" required  lay-verify="required" placeholder="文章排序" value="255" autocomplete="off" class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">推荐</label>
                                <div class="layui-input-block">
                                    <input type="checkbox" name="article_commend_flag" lay-skin="switch">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">允许评论</label>
                                <div class="layui-input-block">
                                    <input type="checkbox" name="article_comment_flag" lay-skin="switch">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        //Demo
        layui.use('form', function(){
            var form = layui.form;
            //监听提交
            form.on('submit(formDemo)', function(data){
                var newdata = data.field; //表单里填的数据
                var article_image = newdata.article_image;
                var article_time = newdata.article_time;
                if(!article_image){
                    layer.msg('文章图片不能为空', {icon: 5});
                    return false;
                }
                if(!article_time){
                    layer.msg('文章有效时间不能为空',{icon: 5});
                    return false;
                }
            });
        });

        layui.use('laydate', function(){
            var laydate = layui.laydate;
            //执行一个laydate实例
            laydate.render({
                elem: '#test1', //指定元素
                type:'date', //year=>年，month=>月，date=>日期（年月日）(默认) ，time=>时间(时，分，秒)，datetime=>日期时间选择器(可选择：年、月、日、时、分、秒)
                range: '~',//来自定义分割字符
                //value: '2017-09-10',//默认值
                min:'2019-01-30'//最小
                //max:'2019-02-15',//最大
               // trigger: 'click'//如果绑定的元素非输入框，则默认事件为：click
            });
        });
    </script>
@endsection