<head>
    <link rel="stylesheet" href="{{ asset('/css/home/home.css') }}">
</head>
<div class="site-left">
    <div class="x-content" style="width:100%">
        <div class="uk-grid">
            <div class="x-index-top uk-width-1-1">
                <h3>推荐文章</h3>
                <?php foreach($article as $k=>$v){ ?>
                    <div class="uk-margin uk-clearfix">
                        <div style="float:left;">
                            <a href="#" target="_blank"><img style="width:160px;height:90px;" src="/{{ $v->article_image }}"></a>
                        </div>
                        <div class="uk-margin" style="margin-left:180px;">
                            <h3><a href="#" target="_blank">{{ $v->article_title }}</a></h3>
                            <p>{{ $v->article_abstract }}</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="site-right">
    bbbbb
</div>