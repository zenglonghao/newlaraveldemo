@extends('Layout.Admin.index')
@section('content')
    <style>
         .layui-input{
            width:500px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="" class="layui-form" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header bg-light">站点设置</div>
                        <div class="card-body">

                            <div class="layui-form-item">
                                <label class="layui-form-label">网站名称</label>
                                <div class="layui-input-block">
                                    <input type="text" name="Wedsite_name" required  lay-verify="required" placeholder="网站名称" autocomplete="off" class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">版权信息</label>
                                <div class="layui-input-block">
                                    <input type="text" name="Copyright" required  lay-verify="required" placeholder="版权底部信息" autocomplete="off" class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">网站时区</label>
                                <div class="layui-input-block">
                                    <select name="time_zone" class="tr" lay-verify="required" style="width:600px;">
                                        <option value="-12">(GMT -12:00) Eniwetok, Kwajalein</option>
                                        <option value="-11">(GMT -11:00) Midway Island, Samoa</option>
                                        <option value="-10">(GMT -10:00) Hawaii</option>
                                        <option value="-9">(GMT -09:00) Alaska</option>
                                        <option value="-8">(GMT -08:00) Pacific Time (US &amp; Canada), Tijuana</option>
                                        <option value="-7">(GMT -07:00) Mountain Time (US &amp; Canada), Arizona</option>
                                        <option value="-6">(GMT -06:00) Central Time (US &amp; Canada), Mexico City</option>
                                        <option value="-5">(GMT -05:00) Eastern Time (US &amp; Canada), Bogota, Lima, Quito</option>
                                        <option value="-4">(GMT -04:00) Atlantic Time (Canada), Caracas, La Paz</option>
                                        <option value="-3.5">(GMT -03:30) Newfoundland</option>
                                        <option value="-3">(GMT -03:00) Brassila, Buenos Aires, Georgetown, Falkland Is</option>
                                        <option value="-2">(GMT -02:00) Mid-Atlantic, Ascension Is., St. Helena</option>
                                        <option value="-1">(GMT -01:00) Azores, Cape Verde Islands</option>
                                        <option value="0">(GMT) Casablanca, Dublin, Edinburgh, London, Lisbon, Monrovia</option>
                                        <option value="1">(GMT +01:00) Amsterdam, Berlin, Brussels, Madrid, Paris, Rome</option>
                                        <option value="2">(GMT +02:00) Cairo, Helsinki, Kaliningrad, South Africa</option>
                                        <option value="3">(GMT +03:00) Baghdad, Riyadh, Moscow, Nairobi</option>
                                        <option value="3.5">(GMT +03:30) Tehran</option>
                                        <option value="4">(GMT +04:00) Abu Dhabi, Baku, Muscat, Tbilisi</option>
                                        <option value="4.5">(GMT +04:30) Kabul</option>
                                        <option value="5">(GMT +05:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
                                        <option value="5.5">(GMT +05:30) Bombay, Calcutta, Madras, New Delhi</option>
                                        <option value="5.75">(GMT +05:45) Katmandu</option>
                                        <option value="6">(GMT +06:00) Almaty, Colombo, Dhaka, Novosibirsk</option>
                                        <option value="6.5">(GMT +06:30) Rangoon</option>
                                        <option value="7">(GMT +07:00) Bangkok, Hanoi, Jakarta</option>
                                        <option value="8" selected>(GMT +08:00) Beijing, Hong Kong, Perth, Singapore, Taipei</option>
                                        <option value="9">(GMT +09:00) Osaka, Sapporo, Seoul, Tokyo, Yakutsk</option>
                                        <option value="9.5">(GMT +09:30) Adelaide, Darwin</option>
                                        <option value="10">(GMT +10:00) Canberra, Guam, Melbourne, Sydney, Vladivostok</option>
                                        <option value="11">(GMT +11:00) Magadan, New Caledonia, Solomon Islands</option>
                                        <option value="12">(GMT +12:00) Auckland, Wellington, Fiji, Marshall Island</option>
                                    </select>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">ICP证书号</label>
                                <div class="layui-input-block">
                                    <input type="text" name="icp_number" required  lay-verify="required" placeholder="版权底部信息" autocomplete="off" class="layui-input">
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
                $.ajax({
                    type:'post',
                    url:'/admin/Manage/save',
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