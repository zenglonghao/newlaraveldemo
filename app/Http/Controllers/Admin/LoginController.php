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
        $admin_id = $request->session()->get('admin_id');
        if($admin_id){
            return redirect('/admin/index');
        }else{
            return view('Admin/Login/login');
        }
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

    /**
     * 退出操作
     * */
    public function logout(Request $request){
        $request->session()->forget('admin_id');
        $request->session()->forget('admin_name');
        if(empty($request->session()->get('admin_id'))){
            //退出登录
            return view('message')->with(array('message'=>'退出成功','jumpTime'=>3,'url'=>'/login'));
        }else{
            //退出失败
            return view('message')->with(array('message'=>'退出失败','jumpTime'=>3,'url'=>'/admin/index'));
        }
    }
}












