<html>
<head>
    <script src="{{ asset('/layui/layui.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/layui/css/layui.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<form action="" class="layui-form" method="post">
    {{ csrf_field() }}
    <div class="layui-form-item">
        <label class="layui-form-label">广告内容描述</label>
        <div class="layui-input-block">
            <input type="text" name="adv_title" required  lay-verify="required" value="{{ $advInfo->adv_title }}" placeholder="广告内容描述" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">图片尺寸</label>
        <div class="layui-input-block">
            <select name="ap_class" lay-verify="required">
                <option value="0">{{ $advposition->ap_width }} X {{ $advposition->ap_height }}</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">广告图</label>
        <div class="layui-input-inline">
            <button type="button" class="layui-btn" id="test1">上传图片</button>
            <div class="layui-upload-list">
                <img class="layui-upload-img" id="demo1" style="width:100px;height:100px;" src="{{ $advInfo->adv_content['adv_pic'] }}"/>
                <p id="demoText"></p>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{ $advInfo->adv_content['adv_pic'] }}" name="img_file" id="img_file">

    <div class="layui-form-item">
        <label class="layui-form-label">广告连接</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" name="href" value="{{ $advInfo->adv_content['adv_pic_url'] }}"/>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">有效时间</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" name="adv_time" id="time" value="{{ $advInfo->adv_time }}" />
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-block">
            <input type="text" name="slide_sort" required  lay-verify="required" value="{{ $advInfo->slide_sort }}" placeholder="排序" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script>
    var min_time = "{{ $time }}";
    var ap_id = "{{ $advposition->ap_id }}";
    var width = "{{ $advposition->ap_width }}";
    var height = "{{ $advposition->ap_height }}";
    var adv_id = "{{ $advInfo->adv_id }}";
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '#time', //指定元素
            type:'date', //year=>年，month=>月，date=>日期（年月日）(默认) ，time=>时间(时，分，秒)，datetime=>日期时间选择器(可选择：年、月、日、时、分、秒)
            range: '~',//来自定义分割字符
            // value: '2017-09-10',//默认值
            min:min_time//最小
            //max:'2019-02-15',//最大
            // trigger: 'click'//如果绑定的元素非输入框，则默认事件为：click
        });
    });

    layui.use(['form', 'layedit','layer'] ,function(){
        var $ = layui.jquery
                ,form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit;
        var index = parent.layer.getFrameIndex(window.name); //修改成功的时候点击 确定 会关闭子窗口，这里获取一下子窗口
        form.render();

        //监听提交
        form.on('submit(*)', function(data){
            $.ajax({
                url: "/admin/Adv/nsave/"+adv_id,
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

    layui.use('upload', function(){
        var $ = layui.jquery
                ,upload = layui.upload;
        var uploadInst = upload.render({
            elem: '#test1'
            ,url: '/admin/Adv/Upload/'+width+'/'+height
            , headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                if(res.code == 200){
                    $('#img_file').val(res.route);
                    return layer.msg('上传成功');
                }else{
                    return layer.msg('上传失败');
                }

            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
    })
</script>
</body>
</html>