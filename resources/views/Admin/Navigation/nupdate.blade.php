@extends('Layout.Admin.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/admin/navigation/updateSave/{{ $NavRow->nav_id }}" method="post">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header bg-light">添加首页导航</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="normal-input" class="form-control-label">导航名称</label>
                                        <input id="normal-input" name="nav_title" class="form-control" placeholder="导航名称" value="{{ $NavRow->nav_title }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">导航连接</label>
                                        <input id="placeholder-input" name="nav_url" class="form-control" placeholder="导航连接" value="{{ $NavRow->nav_url }}">
                                        <small class="form-text">外部连接加上http</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="placeholder-input" class="form-control-label">是否新窗口打开</label>
                                        <br/>
                                        <input type="radio" name="open" value="0" <?php if($NavRow->nav_new_open == 0){echo 'checked';} ?> />否
                                        <input type="radio" name="open" value="1" <?php if($NavRow->nav_new_open == 1){echo 'checked';}?> />是
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="help-text-input" class="form-control-label">排序</label>
                                        <input id="help-text-input" name="nav_sort" class="form-control" placeholder="0" value="{{ $NavRow->nav_sort }}">
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