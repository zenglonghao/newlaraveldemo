<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NavigationController extends Controller{
    //导航列表
    public function nlist(Request $request){
        $admin_name = $request->session()->get('admin_name');
        return view('Admin/Navigation/nlist',array('name'=>$admin_name));
    }
}