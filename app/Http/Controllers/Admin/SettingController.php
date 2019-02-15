<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingController extends Controller{

    /**
     * 个人设置
     * */
    public function nset(Request $request){
        $id = $request->session()->get('admin_id');
        $admin_user = DB::table('admin')->where('admin_id',$id)->first();
        return view('Admin/Setting/nset',['admin_user'=>$admin_user]);
    }

    /**
     * 上传头像
     * */
    public function nupload(){
        per($_FILES);
    }

}
