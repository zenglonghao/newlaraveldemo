<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IndexController extends Controller{
    //后台首页
    public function index(Request $request){
        return view('Admin/Index/index');
    }



}
