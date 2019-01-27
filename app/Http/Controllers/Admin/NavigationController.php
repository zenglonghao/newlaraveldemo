<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NavigationController extends Controller{
    //导航列表
    public function nlist(Request $request){
        return view('Admin/Navigation/nlist');
    }

    //添加导航
    public function nadd(){
        return view('Admin/Navigation/nadd');
    }


}