@extends('Layout.Admin.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/admin/article_type/UpSave/{{ $ClassRow->ac_id }}" method="post">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header bg-light">添加文章分类</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="normal-input" class="form-control-label">分类名称</label>
                                        <input id="normal-input" name="ac_name" class="form-control" placeholder="分类名称" value="{{ $ClassRow->ac_name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">父ID</label>
                                        <br/>
                                        <select name="ac_parent_id"><option value="0">顶级分类</option></select>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="help-text-input" class="form-control-label">排序</label>
                                        <input id="help-text-input" name="ac_sort" class="form-control" placeholder="0" value="{{ $ClassRow->ac_sort }}">
                                        <small class="form-text">数字越大,越靠前</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <button>提交</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection