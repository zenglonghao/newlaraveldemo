@extends('Layout.Admin.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/admin/article_type/save" method="post">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header bg-light">添加文章</div>
                        <div class="card-body">

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">文章标题</label>
                                        <input id="help-text-input" name="article_title" class="form-control" placeholder="文章标题">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">文章分类</label>
                                        <br/>
                                        <select name="article_class_id"><option>请选择</option></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">文章来源</label>
                                        <input id="help-text-input" name="article_origin" class="form-control" placeholder="文章来源">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">文章作者</label>
                                        <input id="help-text-input" name="article_author" class="form-control" placeholder="文章作者">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="normal-input" class="form-control-label">文章内容</label>
                                        <br/>
                                        {!! show_ueditor('ueditor','article_content') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">文章图片</label>
                                        <br/>
                                        <input  name="article_image" type="file">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">文章推荐</label>
                                        <br/>
                                        <input name="article_commend_flag" type="radio"  value="0" checked>否
                                        <input  name="article_commend_flag" type="radio"  value="1">是
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">是否允许评论</label>
                                        <br/>
                                        <input  name="article_comment_flag" type="radio"  value="0" checked>否
                                        <input  name="article_comment_flag" type="radio"  value="1">是
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">文章排序</label>
                                        <input id="help-text-input" name="article_sort" class="form-control" placeholder="0">
                                        <small class="form-text">数字越大,越靠前</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <button class="button button-action button-pill">提交</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection