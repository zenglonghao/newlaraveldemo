@extends('Layout.Admin.index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row p-5">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">id</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">分类名称</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">父ID</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">排序</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($article_class as $v)
                                        <tr class="ndelete{{ $v->ac_id }}">
                                            <td>{{ $v->ac_id }}</td>
                                            <td>{{ $v->ac_name }}</td>
                                            <td>{{ $v->ac_parent_id }}</td>
                                            <td>{{ $v->ac_sort }}</td>
                                            <td><a href="/admin/article_type/update/{{ $v->ac_id }}">编辑</a> | <a href="#" class="ndelete" data-id="{{ $v->ac_id }}">删除</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div style="margin:0 auto;">
                                {{ $article_class->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.ndelete').click(function(){
            var id = $(this).attr('data-id');
            var r = confirm('是否删除该分类');
            if(r){
                $.ajax({
                    type:'get',
                    url:'/admin/article_type/detele/'+id,
                    data:{},
                    dataType:'json',
                    success:function(res){
                        if(res['code']==200){
                            $('.ndelete'+id).remove();
                        }else{
                            alert(res['message']);
                        }
                    }
                });
            }else{
                console.log('0');
            }
        });

    </script>
@endsection

