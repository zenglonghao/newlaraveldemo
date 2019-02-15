@extends('Layout.Admin.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header bg-light">个人信息编辑</div>
                        <div class="card-body">
                            <div class="layui-form-item">
                                <label class="layui-form-label">账号名称</label>
                                <div class="layui-input-block">
                                    <input type="text" name="admin_name" required  lay-verify="required" placeholder="账号名称" autocomplete="off" class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">头像</label>
                                <div class="layui-input-block">
                                    <button type="button" class="layui-btn" id="test1">上传图片</button>
                                    <div class="layui-upload-list">
                                        <img class="layui-upload-img" id="demo1" style="width:50px;height:50px;">
                                        <p id="demoText"></p>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="" name="admin_avatar">
                            <div class="layui-form-item">
                                <label class="layui-form-label">密码</label>
                                <div class="layui-input-block">
                                    <input type="text" name="admin_password" required  lay-verify="required" placeholder="密码" autocomplete="off" class="layui-input">
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
        layui.use('upload', function(){
            var $ = layui.jquery
            ,upload = layui.upload;
            var uploadInst = upload.render({
                elem: '#test1'
                ,url: '/admin/setting/nupload'
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
                    //如果上传失败
                    if(res.code > 0){
                        return layer.msg('上传失败');
                    }
                    //上传成功
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
@endsection