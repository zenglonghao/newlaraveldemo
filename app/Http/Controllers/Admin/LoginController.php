<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoginController extends Controller{

    /**
     * 登录页面
     * */
    public function login(Request $request){
         return view('Admin/Login/login');
    }

    /**
     *登录操作
     * */
    public function save(Request $request){
      $adminarray = DB::select('select * from case_admin where admin_name=:admin_name and admin_password=:admin_password',['admin_name'=>$_POST['Username'],'admin_password'=>md5($_POST['Password'])]);
        if(empty($adminarray)){
           //账号密码不对
           return view('message')->with(['message'=>'账号密码错误','jumpTime'=>3,'url'=>'/login']);
       }else{
           $request->session()->put('admin_id', $adminarray[0]->admin_id);
           $request->session()->put('admin_name', $adminarray[0]->admin_name);
           return view('message')->with(['message'=>'登录成功','jumpTime'=>3,'url'=>'/admin/index']);
       }
    }


}












