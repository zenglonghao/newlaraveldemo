<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>{{ $Wedsite_name }}</title>
    <meta name="viewport" content="width=device-width" />
    <meta property="x-nav" content="/" />
    <link rel="shortcut icon" href="{{ asset('/images/ico/2019031503084382.ico') }}">
    <link rel="alternate" href="/feed" title="" type="application/rss+xml" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.liaoxuefeng.com/" />
    <meta property="og:title" content="{{ $Wedsite_name }}" />
    <meta property="og:description" content="{{ $Wedsite_name }}" />
    <meta property="og:tag" content="index" />


    <link rel="stylesheet" href="{{ asset('/css/home/all.css') }}" />

    <!--[if lt IE 9]>
    <link rel="stylesheet" href="{{ asset('css/home/ie.css') }} " />
    <![endif]-->

    <script src="{{ asset('js/home/all.js') }}"></script>

    <script id="tplComment" type="text/plain">
        <div class="uk-comment">
            <div class="uk-comment-header" style="margin-bottom:0">
                <a target="_blank" href="/user/{ user.id }"><img class="uk-comment-avatar uk-border-circle x-avatar" src="picture/{ user.image_url }" width="50" height="50" alt=""></a>
                <h4 class="uk-comment-title"><a target="_blank" href="/discuss/{ board_id }/{ id }">{ name }</a></h4>
                <div class="uk-comment-meta"><a target="_blank" href="/user/{ user.id }">{ user.name }</a> created at { created_at.toSmartDate() }, Last updated at { updated_at.toSmartDate() }</div>
            </div>
            <div class="uk-comment-body x-auto-content">
                { content|safe }
            </div>
        </div>
    </script>

    <script id="tplCommentReply" type="text/plain">
        <div class="uk-comment x-display-deleted-{ deleted }">
            <div class="uk-comment-header" style="margin-bottom:0">
                <a target="_blank" href="/user/{ user.id }"><img class="uk-comment-avatar uk-border-circle x-avatar" src="picture/{ user.image_url }" width="50" height="50" alt=""></a>
                <div class="uk-comment-meta"><a target="_blank" href="/user/{ user.id }">{ user.name }</a></div>
                <div class="uk-comment-meta">Created at { created_at.toSmartDate() }, Last updated at { updated_at.toSmartDate() }</div>
            </div>
            <div class="uk-comment-body x-auto-content">
                { content|safe }
            </div>
        </div>
    </script>

    <script id="tplCommentInfo" type="text/plain">
        <li>
            <div class="x-comment-info">
                <hr>
                <a target="_blank" class="uk-button uk-button-small" href="/discuss/{ board_id }/{ id }"><i class="uk-icon-list-ul"></i> Full discussion</a>
                &nbsp;
                <a target="_blank" class="uk-button uk-button-small" href="/discuss/{ board_id }/{ id }#reply"><i class="uk-icon-reply"></i> Reply</a>
            </div>
        </li>
    </script>

    <script id="tplCommentArea" type="text/plain">
        <div class="x-display-if-signin">
            <p><button id="comment-make-button" type="button" class="uk-button uk-button-primary"><i class="uk-icon-comment"></i> Make a comment</button></p>
            <form id="comment-form" class="uk-form" style="display:none;">
                <fieldset>
                    <div class="uk-alert uk-alert-danger" style="display:none"></div>
                    <div class="uk-form-row">
                        <label>Title:</label>
                    </div>
                    <div class="uk-form-row">
                        <input type="text" name="name" maxlength="100" style="width:100%">
                    </div>
                    <div class="uk-form-row">
                        <label>Content:</label>
                    </div>
                    <div class="uk-form-row x-textarea">
                    </div>
                    <div class="uk-form-row">
                        <button type="submit" class="uk-button uk-button-primary"><i class="uk-icon-check"></i> Post</button>
                        &nbsp;&nbsp;
                        <button type="button" class="uk-button x-cancel"><i class="uk-icon-close"></i> Cancel</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </script>

    <style id="x-doc-style">
        .x-display-deleted-true { display: none; }
        .x-display-none { display: none; }

        .x-display-if-signin { display: none; }

    </style>
    <script>
        // global variables:
        var g_time = parseFloat('1552274605022');
        var g_signins = JSON.parse('[{"id":"weibo","icon":"weibo","name":"Sign in with Weibo"}]');
        //
        var g_user = null;
        //
        var g_ads = JSON.parse(decodeURIComponent('%7B%22a%22%3A%7B%22name%22%3A%22A%22%2C%22width%22%3A336%2C%22height%22%3A280%2C%22auto_fill%22%3A%22%3Cins%20class%3D%5C%22adsbygoogle%5C%22%20style%3D%5C%22display%3Ainline-block%3Bwidth%3A336px%3Bheight%3A280px%5C%22%20data-ad-client%3D%5C%22ca-pub-6727358730461554%5C%22%20data-ad-slot%3D%5C%228492060710%5C%22%3E%3C%2Fins%3E%5Cn%3Cscript%3E%5Cn(adsbygoogle%20%3D%20window.adsbygoogle%20%7C%7C%20%5B%5D).push(%7B%7D)%3B%5Cn%3C%2Fscript%3E%22%2C%22num_auto_fill%22%3A2%2C%22adperiods%22%3A%5B%7B%22user%22%3A%22%E5%BC%80%E8%AF%BE%E5%90%A7%E5%AE%98%E6%96%B9%E5%BE%AE%E5%8D%9A%22%2C%22admaterials%22%3A%5B%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F0015307792921604c694e6f52484b95a172330562ca5537000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22javascript%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fweb%3Fss%3Dfs3%22%7D%2C%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F00153077933541301079ab48174446984cf31ed5502a66d000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22python%2Cgit%2Cindex%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fpython%3Fss%3Dfs1%22%7D%2C%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F001530779368629a70e732648d14f34a70843db39c9a4c5000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fpython%3Fss%3Dfs2%22%7D%5D%7D%2C%7B%22user%22%3A%22%E5%BC%80%E8%AF%BE%E5%90%A7%E5%AE%98%E6%96%B9%E5%BE%AE%E5%8D%9A%22%2C%22admaterials%22%3A%5B%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F001530779306382ebf382b76d3846248dfbc35f192f35ac000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22javascript%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fpython%3Fss%3Dss3%22%7D%2C%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F001530779486466f66c87e0fc794ca79d66bf59cd42a10f000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22python%2Cgit%2Cindex%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fweb%3Fss%3Dss1%22%7D%2C%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F001530779955145513c19ad239446a683a912e3229f7740000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fweb%3Fss%3Dss2%22%7D%2C%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F001530780935500c4618c8be6cc48a69260dbb200325124000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22python%2Cgit%2Cindex%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fjava%3Fss%3Dss4%22%7D%5D%7D%5D%7D%2C%22b%22%3A%7B%22name%22%3A%22B%22%2C%22width%22%3A300%2C%22height%22%3A600%2C%22auto_fill%22%3A%22%3Cins%20class%3D%5C%22adsbygoogle%5C%22%20style%3D%5C%22display%3Ainline-block%3Bwidth%3A300px%3Bheight%3A600px%5C%22%20data-ad-client%3D%5C%22ca-pub-6727358730461554%5C%22%20data-ad-slot%3D%5C%224769867116%5C%22%3E%3C%2Fins%3E%5Cn%3Cscript%3E%5Cn(adsbygoogle%20%3D%20window.adsbygoogle%20%7C%7C%20%5B%5D).push(%7B%7D)%3B%5Cn%3C%2Fscript%3E%22%2C%22num_auto_fill%22%3A2%2C%22adperiods%22%3A%5B%7B%22user%22%3A%22%E5%BC%80%E8%AF%BE%E5%90%A7%E5%AE%98%E6%96%B9%E5%BE%AE%E5%8D%9A%22%2C%22admaterials%22%3A%5B%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F0015307797110987f55c6b87fd54083bc390e8ff6b0d60c000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22python%2Cgit%2Cindex%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fpython%3Fss%3Dfbg1%22%7D%2C%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F001530779800744e83fef4eebab401aab4bbe8699af6b51000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22javascript%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fweb%3Fss%3Dfbg3%22%7D%2C%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F001530780197211282e93c0467f4b79b6e1be1a0efb414e000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fpython%3Fss%3Dfbg2%22%7D%5D%7D%2C%7B%22user%22%3A%22%E5%BC%80%E8%AF%BE%E5%90%A7%E5%AE%98%E6%96%B9%E5%BE%AE%E5%8D%9A%22%2C%22admaterials%22%3A%5B%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F001530167032294c342ce74629b41ffaebf0ba8528d5f37000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22python%2Cgit%2Cindex%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fjava%3Fss%3Dsbg1%22%7D%2C%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F001530167057850ab00994c0e914e59a996b275fc1aac42000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fjava%3Fss%3Dsbg2%22%7D%2C%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F0015307798443236e70647769674722a45bf2635b31c045000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22javascript%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fpython%3Fss%3Dsbg3%22%7D%2C%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F001530779942804e5a23ac1c027456499629baec954b7e0000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fweb%3Fss%3Dsbg2%22%7D%2C%7B%22image%22%3A%22%2Ffiles%2Fattachments%2F001530780351101304e7e7655174965b2357ef3512940c4000%2F0%22%2C%22weight%22%3A100%2C%22keywords%22%3A%22python%2Cgit%2Cindex%22%2C%22url%22%3A%22http%3A%2F%2Fpro.kaikeba.com%2Fcourse%2Fweb%3Fss%3Dsbg1%22%7D%5D%7D%5D%7D%7D'));
        var meta_keywords = $('meta[property="og:tag"]').attr('content');
        if (meta_keywords) {
            meta_keywords = meta_keywords.toLowerCase().split(',');
            _.mapObject(g_ads, function (adslot, adkey) {
                _.map(adslot.adperiods, function (adp) {
                    var matched_adms = _.filter(adp.admaterials, function (adm) {
                        var ks = adm.keywords.toLowerCase().split(',');
                        // ad keywords = [a, b, c, d]
                        // meta keywords = [b, c]
                        var ms = _.filter(meta_keywords, function (mkey) {
                            return ks.indexOf(mkey) >= 0;
                        });
                        return ms.length > 0;
                    });
                    if (matched_adms.length > 0) {
                        adp.admaterials = matched_adms;
                    }
                });
            });
        }
        $(function () {
            var fnRandom = function (adms) {
                if (adms.length === 1) {
                    return adms[0];
                }
                var
                        weights = _.map(adms, function (m) {
                            return m.weight;
                        }),
                        total_weights = _.reduce(weights, function (ax, w) {
                            return ax + w;
                        }, 0),
                        rnd = Math.random(),
                        ws = 0,
                        i,
                        hit;
                for (i=0; i<weights.length; i++) {
                    ws = ws + weights[i];
                    if (rnd < ws / total_weights) {
                        return adms[i];
                    }
                }
                return adms[0];
            };
            _.mapObject(g_ads, function (ad, k) {
                _.map(ad.adperiods, function (adp) {
                    if (adp.admaterials.length === 0) {
                        add_sponsor('#x-sponsor-' + k, ad.width, ad.height, adp.user, 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAAAkCAMAAAB2bcIBAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyNpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChNYWNpbnRvc2gpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjE0NDhCRDA3QTM3MjExRTc4QjI0RjRCQjQzOTgwRDc3IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjE0NDhCRDA4QTM3MjExRTc4QjI0RjRCQjQzOTgwRDc3Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MTQ0OEJEMDVBMzcyMTFFNzhCMjRGNEJCNDM5ODBENzciIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MTQ0OEJEMDZBMzcyMTFFNzhCMjRGNEJCNDM5ODBENzciLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5Adyw0AAAADFBMVEXm5uazs7NdXV3///8WehxTAAAABHRSTlP///8AQCqp9AAAAaVJREFUeNrslsuWwyAMQyXy//88LX7JhEw7q9mQRQ8QEBcjO8X1zw8OwAE4AAdA2xzvh7Nj7eq/RuYQ+STl71PR1ayPlBt4AkCbUgBGgBwwySLjsoCLGheAwT0A7Hz0GZwdOxVCoPpXncUA2F+L2pTD6HobAAor8lwxzlgHV2yXhYoI6zXiIjiXse/zCFA7CgCK25sVzABw2dew8FrzbwAgNQJzqa6ydnOLATkw2XeZbwoATwDoFu8RUEE4AJluCQ+gbarAX0QgjEo2ALtDiiBmTN8/Qy+LS45cewA+mjAzOc+VTxe8IgJuh4DLRFVHRMS+SEOFYANQR8gVjLoe9FqGbQT2lUhMSGqIow6Q68UxI2DJNwHMueqZmweyDjxEoKCpgVUoNZgNTF2fri4XYPQswMdC5Dt0gF55x5W3TA8qxq1u1IZrIcJzGkbRvc/z/ICU4iCrNHQTsLISVco/Afxiu2vzcWofHbSvDe9q3xQiWYM7qOzAbplI7MxCbtQ6QHPXkoMMN2dD/y/IYCZNzUQmzU1tvlvnn79kB+AAHIADMJ8fAQYAbSgvpXjD4xEAAAAASUVORK5CYII=', '/');
                        return;
                    }
                    var hit = fnRandom(adp.admaterials);
                    add_sponsor('#x-sponsor-' + k, ad.width, ad.height, adp.user, 'https://cdn.liaoxuefeng.com/cdn'+ hit.image, hit.url);
                });
                var i;
                for (i=0; i<ad.num_auto_fill; i++) {
                    add_sponsor('#x-sponsor-' + k, ad.width, ad.height, ad.auto_fill);
                }
            });
        });
    </script>
    <script>
        (function () {
            eval(decodeURIComponent('%69f%28%21get%43%6F%6F%6B%69%65(%27%61tsp%27))%73%65%74C%6F%6F%6B%69%65(%27%61tsp%27%2C%20%271552274605022%5F%27%2Bnew%20Date%28%29.getTime%28%29%2C%20580%29%3B'));
        })();
    </script>





    <style>
        .x-index-visible {
            display: block;
        }
    </style>



    <style>
        .x-center {
            margin: 0;
        }
        .x-center {
            margin-right: 316px;
            padding-right: 15px;
        }


    </style>

    <!-- BEGIN custom_header -->
    <script src="{{ asset('js/home/wb.js') }}" type="text/javascript" charset="utf-8"></script>
    <script async src="{{ asset('js/home/adsbygoogle.js') }}"></script>

    <script>
        var CDN = 'https://cdn.liaoxuefeng.com/cdn';

        // add table class:
        $(function () {
            $('table').addClass('uk-table');
        });

        function shareToWeibo() {
            var url = 'http://service.weibo.com/share/share.php?type=button&ralateUid=1658384301&language=zh_cn&appkey=1391944217&searchPic=false&style=full';
            url = url + '&title=' + encodeURIComponent(document.title);
            url = url + '&url=' + encodeURIComponent(location.href);
            url = url + '&pic=' + encodeURIComponent($('meta[property="og:image"]').attr('content'));
            window.open(url, 'share_liaoxuefeng_com', 'top=200,left=400,width=600,height=380,directories=no,menubar=no,toolbar=no,resizable=no');
        }

        var SHARE_TO_WEIBO = '<p><a href="#0" onclick="shareToWeibo()" class="uk-button uk-button-danger"><i class="uk-icon-weibo"></i> 分享到微博</button></p>';
    </script>

    <script>
        // crypto:
        if (location.pathname.indexOf('/wiki/0015223693709562f80977e6c9549f0a1e17640a61433d6000') === 0) {
            $.ajax({ url: '/static/js/crypto.js?v1', dataType: 'script', cache: true });
        }
        // sql: import alasql
        if (location.pathname.indexOf('/wiki/001508284671805d39d23243d884b8b99f440bfae87b0f4000') === 0) {
            $.ajax({
                url: '//cdn.liaoxuefeng.com/static/js/alasql.js',
                dataType: 'script',
                cache: true,
                success: function () {
                    console.log('alasql loaded.');
                    alasql.options.joinstar = 'underscore';
                    var
                            i,
                            classes_data = [['一班'], ['二班'], ['三班'], ['四班']],
                            students_data = [[1, '小明', 'M', 90], [1, '小红', 'F', 95], [1, '小军', 'M', 88], [1, '小米', 'F', 73], [2, '小白', 'F', 81], [2, '小兵', 'M', 55], [2, '小林', 'M', 85], [3, '小新', 'F', 91], [3, '小王', 'M', 89], [3, '小丽', 'F', 88]];
                    alasql('CREATE TABLE classes (id BIGINT NOT NULL AUTO_INCREMENT, name VARCHAR(10) NOT NULL, PRIMARY KEY (id))');
                    alasql('CREATE TABLE students (id BIGINT NOT NULL AUTO_INCREMENT, class_id BIGINT NOT NULL, name VARCHAR(10) NOT NULL, gender CHAR(1) NOT NULL, score BIGINT NOT NULL, PRIMARY KEY (id))');
                    for (i=0; i<classes_data.length; i++) {
                        alasql('INSERT INTO classes (name) VALUES (?)', classes_data[i]);
                    }
                    for (i=0; i<students_data.length; i++) {
                        alasql('INSERT INTO students (class_id, name, gender, score) VALUES (?, ?, ?, ?)', students_data[i]);
                    }
                }
            });
        }
    </script>

    <script>
        $(function () {
            $('pre>code.lang-java-practice').each(function () {
                var
                        url, h, i, name,
                        $code = $(this),
                        $pre = $code.parent(),
                        ss = $.trim($code.text()).split('\n\n');
                if (ss.length > 0) {
                    url = $.trim(ss[0]).replace(/\n/g, '');
                    i = url.lastIndexOf('/');
                    name = url.substring(i+1);
                    if (url.indexOf('https://')===0 || url.indexOf('http://')===0) {
                        h = '';
                        for (i=1; i<ss.length; i++) {
                            if ($.trim(ss[i])!=='') {
                                h = h + '<p>' + encodeHtml(ss[i]) + '</p>';
                            }
                        }
                        h = h + '<p>下载练习：<a href="' + url + '">' + encodeHtml(name) + '</a> （推荐使用<a target="_blank" href="/wiki/001543970808338ad98bbeaa6fc405c8df49d6a015b6e67000/0015504045557000bc76e4d743f41e9a7ab4116f105ba24000">IDE练习插件</a>快速下载）</p>';
                        $pre.replaceWith(h);
                    }
                }
            });
        });
    </script>



    <script>
        // add share:
        $(function () {
            if (location.pathname.indexOf('/wiki/')===0) {
                $('.x-wiki-content').find('a[href^=http]').attr('target', '_blank');
                if (!window.hurry) {
                    $('.x-wiki-content').after('<h3>感觉本站内容不错，读后有收获？</h3><p><a target="_blank" href="/webpage/donate" class="uk-button uk-button-primary"><i class="uk-icon-cny"></i> 我要小额赞助，鼓励作者写出更好的教程</a></p><h3>还可以分享给朋友</h3>' + SHARE_TO_WEIBO);
                } else {
                    $('.x-wiki-content').after('<h3>等待时间太久？</h3><p><a target="_blank" href="/webpage/donate" class="uk-button uk-button-primary"><i class="uk-icon-cny"></i> 我要催促作者更新教程</a></p><h3>还可以分享给朋友</h3>' + SHARE_TO_WEIBO);
                }
            }
        });
    </script>


    <script>
        // tongji:
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?2efddd14a5f2b304677462d06fb4f964";
            hm.async = "async";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <!-- END custom_header -->
</head>

<body>
<div class="x-goto-top">
    <div class="x-arrow"></div>
    <div class="x-stick"></div>
</div>

<div id="header" class="uk-navbar uk-navbar-attached">
    <div class="uk-container x-container">
        <div id="navbar" class="uk-navbar uk-navbar-attached">

            <a id="brand" href="/" class="uk-navbar-brand uk-visible-large">{{ $Wedsite_name }}</a>
            <a id="brand-small" href="/" class="uk-navbar-brand uk-hidden-large"><i class="uk-icon-home"></i></a>
            <a class="uk-hidden" href="/blog/1552274605022">Blog</a>
            <ul id="ul-navbar" class="uk-navbar-nav uk-hidden-small">

                <li class="x-nav"><a href="/category/0013738748415562fee26e070fa4664ad926c8e30146c67000">编程</a></li>

                <li class="x-nav"><a href="/category/0013738748248885ddf38d8cd1b4803aa74bcda32f853fd000">读书</a></li>

                <li class="x-nav"><a href="https://www.feiyangedu.com/category/JavaSE">JavaSE课程</a></li>

                <li class="x-nav"><a href="http://pro.kaikeba.com/course/java/?ss=topj">JavaEE课程</a></li>

                <li class="x-nav"><a href="https://www.feiyangedu.com/category/CryptoCurrency">数字货币</a></li>

                <li class="x-nav"><a href="/wiki/001434446689867b27157e896e74d51a89c25cc8b43bdb3000">JavaScript教程</a></li>

                <li class="x-nav"><a href="/wiki/0014316089557264a6b348958f449949df42a6d3a2e542c000">Python教程</a></li>

                <li class="x-nav"><a href="/wiki/001508284671805d39d23243d884b8b99f440bfae87b0f4000">SQL教程</a></li>

                <li class="x-nav"><a href="/wiki/0013739516305929606dd18361248578c67b8067c8c017b000">Git教程</a></li>

                <li class="x-nav"><a href="/discuss">问答</a></li>

                <li class="x-nav"><a href="/webpage/donate">赞助</a></li>

                <li id="navbar-more" class="uk-parent" data-uk-dropdown style="display:none">
                    <a href="#0"><i class="uk-icon-chevron-down"></i> More</a>
                    <div class="uk-dropdown uk-dropdown-navbar">
                        <ul id="ul-navbar-more" class="uk-nav uk-nav-navbar">

                            <li class="x-nav"><a href="/category/0013738748415562fee26e070fa4664ad926c8e30146c67000">编程</a></li>

                            <li class="x-nav"><a href="/category/0013738748248885ddf38d8cd1b4803aa74bcda32f853fd000">读书</a></li>

                            <li class="x-nav"><a href="https://www.feiyangedu.com/category/JavaSE">JavaSE课程</a></li>

                            <li class="x-nav"><a href="http://pro.kaikeba.com/course/java/?ss=topj">JavaEE课程</a></li>

                            <li class="x-nav"><a href="https://www.feiyangedu.com/category/CryptoCurrency">数字货币</a></li>

                            <li class="x-nav"><a href="/wiki/001434446689867b27157e896e74d51a89c25cc8b43bdb3000">JavaScript教程</a></li>

                            <li class="x-nav"><a href="/wiki/0014316089557264a6b348958f449949df42a6d3a2e542c000">Python教程</a></li>

                            <li class="x-nav"><a href="/wiki/001508284671805d39d23243d884b8b99f440bfae87b0f4000">SQL教程</a></li>

                            <li class="x-nav"><a href="/wiki/0013739516305929606dd18361248578c67b8067c8c017b000">Git教程</a></li>

                            <li class="x-nav"><a href="/discuss">问答</a></li>

                            <li class="x-nav"><a href="/webpage/donate">赞助</a></li>

                        </ul>
                    </div>
                </li>
            </ul>

            <ul id="ul-navbar-small" class="uk-navbar-nav uk-visible-small">
                <li class="uk-parent" data-uk-dropdown>
                    <a href="#0"><i class="uk-icon-navicon"></i></a>
                    <div class="uk-dropdown uk-dropdown-navbar">
                        <ul class="uk-nav uk-nav-navbar">

                            <li><a href="/category/0013738748415562fee26e070fa4664ad926c8e30146c67000">编程</a></li>

                            <li><a href="/category/0013738748248885ddf38d8cd1b4803aa74bcda32f853fd000">读书</a></li>

                            <li><a href="https://www.feiyangedu.com/category/JavaSE">JavaSE课程</a></li>

                            <li><a href="http://pro.kaikeba.com/course/java/?ss=topj">JavaEE课程</a></li>

                            <li><a href="https://www.feiyangedu.com/category/CryptoCurrency">数字货币</a></li>

                            <li><a href="/wiki/001434446689867b27157e896e74d51a89c25cc8b43bdb3000">JavaScript教程</a></li>

                            <li><a href="/wiki/0014316089557264a6b348958f449949df42a6d3a2e542c000">Python教程</a></li>

                            <li><a href="/wiki/001508284671805d39d23243d884b8b99f440bfae87b0f4000">SQL教程</a></li>

                            <li><a href="/wiki/0013739516305929606dd18361248578c67b8067c8c017b000">Git教程</a></li>

                            <li><a href="/discuss">问答</a></li>

                            <li><a href="/webpage/donate">赞助</a></li>

                        </ul>
                    </div>
                </li>
            </ul>

            <div id="navbar-user-info" class="uk-navbar-flip">
                <ul class="uk-navbar-nav">
                    <li class="uk-parent x-display-if-signin" data-uk-dropdown>
                        <a href="#0"><i class="uk-icon-user"></i><span class="x-hidden-tiny">&nbsp;</span><span class="x-user-name x-hidden-tiny"></span></a>
                        <div class="uk-dropdown uk-dropdown-navbar">
                            <ul class="uk-nav uk-nav-navbar">
                                <li><a target="_blank" href="/me/profile"><i class="uk-icon-cog"></i> Profile</a></li>
                                <li class="uk-nav-divider"></li>


                                <li><a href="/auth/signout"><i class="uk-icon-power-off"></i> Sign Out</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="x-display-if-not-signin uk-hidden-small"><a href="javascript:showSignin()"><i class="uk-icon-sign-in"></i> Sign In</a></li>
                    <li class="x-display-if-not-signin uk-visible-small"><a href="javascript:showSignin()"><i class="uk-icon-sign-in"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div><!-- // header -->