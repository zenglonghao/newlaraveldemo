<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IndexController extends Controller{
    //后台首页
    public function index(Request $request){
        $admin_name = $request->session()->get('admin_name');
        return view('Admin/Index/index',array('name'=>$admin_name));
    }



}
