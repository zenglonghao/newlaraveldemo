@extends('Layout.Admin.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/admin/navigation/save" method="post">
                    {{ csrf_field() }}
                    <div class="card">
                    <div class="card-header bg-light">添加首页导航</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="normal-input" class="form-control-label">导航名称</label>
                                    <input id="normal-input" name="name" class="form-control" placeholder="导航名称">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="placeholder-input" class="form-control-label">导航连接</label>
                                    <input id="placeholder-input" name="href" class="form-control" placeholder="导航连接">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="help-text-input" class="form-control-label">排序</label>
                                    <input id="help-text-input" name="store" class="form-control" placeholder="0">
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