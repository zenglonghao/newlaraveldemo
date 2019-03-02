<html xmlns="http://www.w3.org/1999/html">
<head>
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
<form class="layui-form" action="">
{{ csrf_field() }}
    <div class="layui-form-item">
        <label class="layui-form-label">广告位置名</label>
        <div class="layui-input-block">
            <input type="text" name="ap_name" required  lay-verify="required" placeholder="广告位置名"  value="{{ $advposition->ap_name }}" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">广告位简介</label>
        <div class="layui-input-block">
            <input type="text" name="ap_intro" required  lay-verify="required" placeholder="广告位简介"  value="{{ $advposition->ap_intro }}" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">广告类别</label>
        <div class="layui-input-block">
            <select name="ap_class" lay-verify="required">
                @foreach($_class['ap_class'] as $k=>$v)
                    <option value="{{ $k }}" <?php if($k == $advposition->ap_class){ ?> selected<?php }?> >{{ $v }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">广告展示方式</label>
        <div class="layui-input-block">
            <select name="ap_display" lay-verify="required">
                @foreach($_class['ap_display'] as $k=>$v)
                    <option value="{{ $k }}" <?php if($k == $advposition->ap_display){ ?> selected<?php }?> >{{ $v }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">是否启用</label>
        <div class="layui-input-block">
            <input type="checkbox" name="is_use" lay-skin="switch" <?php if($advposition->is_use){ ?> checked <?php }?>/>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">广告位宽度</label>
        <div class="layui-input-block">
            <input type="text" name="ap_width" required  lay-verify="required" placeholder="广告位宽度" value="{{ $advposition->ap_width }}" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">广告位高度</label>
        <div class="layui-input-block">
            <input type="text" name="ap_height" required  lay-verify="required" placeholder="广告位高度"  value="{{ $advposition->ap_height }}" autocomplete="off" class="layui-input">
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
    var ap_id = "<?php echo $advposition->ap_id;?>";
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
                url: "/admin/Adv/Upsave/"+ap_id,
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
</script>
</body>
</html>




