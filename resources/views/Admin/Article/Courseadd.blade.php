<html>
<head>
    <script src="{{asset('/js/admin/index/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('/layui/layui.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/layui/css/layui.css') }}">
</head>
<style>
    .layui-select-title{
        width:500px;
    }
    .layui-form-select dl{
        min-width:0;
    }
</style>
<body>
    <form action="/admin/article/save" class="layui-form" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
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
                    <option value="4">教程</option>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">教程分类</label>
            <div class="layui-input-inline">
                <select name="article_Course_class_1"  lay-verify="required" lay-filter="Course_class_1">
                    <option value="0">----请选择-----</option>
                    @foreach($course_class as $v)
                        <option value="{{ $v->class_id }}">{{ $v->class_name }}</option>
                    @endforeach
                </select>
                <select name="article_Course_class_2"  lay-filter="Course_class_2" style="display:none;" class="Course_class_2">
                    <option value="0">----请选择-----</option>
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
            <div class="layui-input-inline">
                {!! show_ueditor('ueditor','article_content') !!}
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
</form>
<script>
    var newstime = "{{ $time }}";
    layui.use(['form', 'layedit','layer'] ,function(){
        var $ = layui.jquery
                ,form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit;
        var index = parent.layer.getFrameIndex(window.name); //修改成功的时候点击 确定 会关闭子窗口，这里获取一下子窗口
        form.render();


        form.on("select(Course_class_1)", function(data){
            var course_class_1 = data.value;
            if(course_class_1 > 1){
                $.ajax({
                    url:"/admin/article/CourseClass/"+course_class_1,
                    type:'get',
                    data:[],
                    dataType:'json',
                    success:function(data){
                        if(data.code == 200){
                            var i = data.data.length;
                            var newsdata = data.data;
                            if(i > 0){
                                var html = '<option value="0">----请选择-----</option>';
                                for(var j =0;j < i;j++){
                                    html += '<option value="'+ newsdata[j]['class_id']+'">'+ newsdata[j]['class_name'] +'</option>';
                                }
                                $('.Course_class_2').html(html);
                                form.render('select');//需要渲染一下
                            }
                        }
                    }
                });
            }
        });
        //监听提交
        form.on('submit(formDemo)', function(data){ //这块要跟表单中的lay-filter="editStudent"对应
            $.ajax({
                url: "/admin/article/CourseSave",
                type: "post",
                data: data.field,
                dataType: "json",
                success: function (data) {
                    if(data.code == 200){
                        parent.layer.alert(data.message,{icon: 1,time:2000},function () {
                            layer.close(layer.index);
                            window.parent.location.reload();    //重新加载父页面，进行数据刷新
                        });
                    } else{
                        parent.layer.alert(data.message,{icon: 2,time:2000});
                    }
                }
            });
            return false;
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
            min:newstime//最小
            //max:'2019-02-15',//最大
            // trigger: 'click'//如果绑定的元素非输入框，则默认事件为：click
        });
    });
</script>
</body>
</html>