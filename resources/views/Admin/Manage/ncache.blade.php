@extends('Layout.Admin.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">清除缓存</div>
                    <div class="card-body">
                        <form action="" class="layui-form" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="layui-form-item">
                                <label class="layui-form-label">缓存</label>
                                <div class="layui-input-block">
                                    <input type="checkbox" name="cache[1]" title="Redis缓存">
                                    <input type="checkbox" name="cache[2]" title="页面缓存">
                                    <input type="checkbox" name="cache[3]" title="数据缓存">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
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
                $.ajax({
                    type:'post',
                    url:'/admin/Manage/cacheSave',
                    data:newdata,
                    dataType:'json',
                    success:function(res){
                        if(res.code==200){
                            layer.alert(res.message, {icon: 1});
                        }
                    }
                });
                return false;
            });
        });
    </script>
@endsection