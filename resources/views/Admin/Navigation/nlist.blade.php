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
                                        <th class="border-0 text-uppercase small font-weight-bold">导航标题</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">导航链接</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">是否以新窗口打开</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">排序</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($navlist as $v)
                                            <tr class="ndelete{{ $v->nav_id }}">
                                                <td>{{ $v->nav_id }}</td>
                                                <td>{{ $v->nav_title }}</td>
                                                <td>{{ $v->nav_url }}</td>
                                                <td><?php if($v->nav_new_open){echo '是';}else{echo '否';} ?></td>
                                                <td>{{ $v->nav_sort }}</td>
                                                <td><a href="/admin/navigation/update/{{ $v->nav_id }}">编辑</a> | <a href="#" class="ndelete" data-id="{{ $v->nav_id }}">删除</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div style="margin:0 auto;">
                                {{ $navlist->links() }}
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
            var r = confirm('是否删除该导航');
            if(r){
                $.ajax({
                    type:'get',
                    url:'/admin/navigtion/nDelete/'+id,
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

