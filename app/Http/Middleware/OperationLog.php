<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LogModel;


class OperationLog{
    public function handle($request, Closure $next)
    {
        $user_id = 0;
        $user_name = '';
        if(!empty($request->session()->get('admin_id'))) {
            $user_id = $request->session()->get('admin_id');
            $user_name = $request->session()->get('admin_name');
        }
        $_SERVER['admin_uid'] = $user_id;
        if('GET' != $request->method()){
            $input = $request->all();
            $log = new LogModel();
            $log->user_id = $user_id;
            $log->user_name = $user_name;
            $log->url = $request->path();
            $log->method = $request->method();
            $log->ip = $request->ip();
            $log->input = json_encode($input, JSON_UNESCAPED_UNICODE);
            $log->save();
        }
        return $next($request);
    }
}
