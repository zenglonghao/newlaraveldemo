<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>layui插件的使用-页面元素</title>
        <script src="{{ asset('/layui/layui.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/layui/css/layui.css') }}">
    </head>
    <body>
    <div style="height:100px;">
        <h1>模板的表单使用</h1>
    </div>
    <form class="layui-form" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">输入框</label>
            <div class="layui-input-block">
                <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码框</label>
            <div class="layui-input-inline">
                <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">辅助文字</div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">选择框</label>
            <div class="layui-input-block">
                <select name="city" lay-verify="required">
                    <option value=""></option>
                    <option value="0">北京</option>
                    <option value="1">上海</option>
                    <option value="2">广州</option>
                    <option value="3">深圳</option>
                    <option value="4">杭州</option>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">复选框</label>
            <div class="layui-input-block">
                <input type="checkbox" name="like[write]" title="写作">
                <input type="checkbox" name="like[read]" title="阅读" checked>
                <input type="checkbox" name="like[dai]" title="发呆">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">开关</label>
            <div class="layui-input-block">
                <input type="checkbox" name="switch" lay-skin="switch">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">单选框</label>
            <div class="layui-input-block">
                <input type="radio" name="sex" value="男" title="男">
                <input type="radio" name="sex" value="女" title="女" checked>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">文本域</label>
            <div class="layui-input-block">
                <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
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
        //Demo
        layui.use('form', function(){
            var form = layui.form;

            //监听提交
            form.on('submit(formDemo)', function(data){
                layer.msg(JSON.stringify(data.field));
                return false;
            });
        });
    </script>

    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />
    <h1>确换</h1>
    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />
    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li class="layui-this">网站设置</li>
            <li>用户管理</li>
            <li>权限分配</li>
            <li>商品管理</li>
            <li>订单管理</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">内容1</div>
            <div class="layui-tab-item">内容2</div>
            <div class="layui-tab-item">内容3</div>
            <div class="layui-tab-item">内容4</div>
            <div class="layui-tab-item">内容5</div>
        </div>
    </div>

    <script>
        //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
        layui.use('element', function(){
            var element = layui.element;

            //…
        });
    </script>
    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />
    <h1>时间线</h1>
    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />
    <ul class="layui-timeline">
        <li class="layui-timeline-item">
            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
            <div class="layui-timeline-content layui-text">
                <h3 class="layui-timeline-title">8月18日</h3>
                <p>
                    layui 2.0 的一切准备工作似乎都已到位。发布之弦，一触即发。
                    <br>不枉近百个日日夜夜与之为伴。因小而大，因弱而强。
                    <br>无论它能走多远，抑或如何支撑？至少我曾倾注全心，无怨无悔 <i class="layui-icon"></i>
                </p>
            </div>
        </li>
        <li class="layui-timeline-item">
            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
            <div class="layui-timeline-content layui-text">
                <h3 class="layui-timeline-title">8月16日</h3>
                <p>杜甫的思想核心是儒家的仁政思想，他有“<em>致君尧舜上，再使风俗淳</em>”的宏伟抱负。个人最爱的名篇有：</p>
                <ul>
                    <li>《登高》</li>
                    <li>《茅屋为秋风所破歌》</li>
                </ul>
            </div>
        </li>
        <li class="layui-timeline-item">
            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
            <div class="layui-timeline-content layui-text">
                <h3 class="layui-timeline-title">8月15日</h3>
                <p>
                    中国人民抗日战争胜利72周年
                    <br>常常在想，尽管对这个国家有这样那样的抱怨，但我们的确生在了最好的时代
                    <br>铭记、感恩
                    <br>所有为中华民族浴血奋战的英雄将士
                    <br>永垂不朽
                </p>
            </div>
        </li>
        <li class="layui-timeline-item">
            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
            <div class="layui-timeline-content layui-text">
                <div class="layui-timeline-title">过去</div>
            </div>
        </li>
    </ul>


    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />
    <h1>折叠面板</h1>
    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />
    <div class="layui-collapse">
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">杜甫</h2>
            <div class="layui-colla-content layui-show">内容区域</div>
        </div>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">李清照</h2>
            <div class="layui-colla-content layui-show">内容区域</div>
        </div>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">鲁迅</h2>
            <div class="layui-colla-content layui-show">内容区域</div>
        </div>
    </div>

    <script>
        //注意：折叠面板 依赖 element 模块，否则无法进行功能性操作
        layui.use('element', function(){
            var element = layui.element;

            //…
        });
    </script>


    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />
    <h1>折叠面板22</h1>
    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />
    <div class="layui-collapse" lay-accordion>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">杜甫</h2>
            <div class="layui-colla-content layui-show">内容区域</div>
        </div>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">李清照</h2>
            <div class="layui-colla-content">内容区域</div>
        </div>
        <div class="layui-colla-item">
            <h2 class="layui-colla-title">鲁迅</h2>
            <div class="layui-colla-content">内容区域</div>
        </div>
    </div>

    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />
    <h1>进度条</h1>
    <hr style=" height:2px;border:none;border-top:2px dotted #185598;" />

    <div class="layui-progress" lay-showPercent="true">
        <div class="layui-progress-bar layui-bg-red" lay-percent="1/3"></div>
    </div>
    <br/>
    <div class="layui-progress" lay-showPercent="yes">
        <div class="layui-progress-bar layui-bg-red" lay-percent="30%"></div>
    </div>
    <br/>
    <div class="layui-progress layui-progress-big" lay-showPercent="yes">
        <div class="layui-progress-bar layui-bg-green" lay-percent="60%"></div>
    </div>


    </body>
</html>