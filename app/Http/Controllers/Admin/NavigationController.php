<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NavigationController extends Controller{
    //导航列表
    public function nlist(Request $request){
        $navlist = DB::table('navigation')->orderBy('nav_sort','desc')->paginate(20);
        return view('Admin/Navigation/nlist',['navlist' => $navlist]);
    }

    //添加导航
    public function nadd(){
        return view('Admin/Navigation/nadd');
    }

    //保存导航信息
    public function nsave(){
       $post = $_POST;
       $res = DB::insert("insert into case_navigation(nav_title,nav_url,nav_new_open,nav_sort)values(:nav_title,:nav_url,:nav_new_open,:nav_sort)",
            ['nav_title'=>$post['nav_title'],'nav_url'=>$post['nav_url'],'nav_new_open'=>$post['open'],'nav_sort'=>$post['nav_sort']]);
        if($res){
            return view('message')->with(['message'=>'添加成功','jumpTime'=>3,'url'=>'/admin/navigation/add']);
        }else{
            return view('message')->with(['message'=>'添加失败','jumpTime'=>3,'url'=>'/admin/navigation/add']);
        }
    }

    //编辑导航信息
    public function nupdate($id){
        $NavRow = DB::table('navigation')->where('nav_id',$id)->first();
        if(empty($NavRow->nav_id)){
            return view('message')->with(['message'=>'非法操作','jumpTime'=>3,'url'=>'/admin/navigation/add']);
        }else{
            return view('Admin/Navigation/nupdate',['NavRow'=>$NavRow]);
        }
    }


    //编辑导航信息保存
    public function nUpdateSave($id){
        $updateArray = array();
        $post = $_POST;
        $updateArray['nav_title'] = $post['nav_title'];
        $updateArray['nav_url'] = $post['nav_url'];
        $updateArray['nav_new_open'] = $post['open'];
        $updateArray['nav_sort'] = $post['nav_sort'];
        $res = DB::table('navigation')->where('nav_id',$id)->update($updateArray);
        if($res){
            return view('message')->with(['message'=>'编辑成功','jumpTime'=>3,'url'=>'/admin/navigation/update/'.$id]);
        }else{
            return view('message')->with(['message'=>'编辑失败','jumpTime'=>3,'url'=>'/admin/navigation/update/'.$id]);
        }
    }

    //删除导航信息
    public function nDelete($id){
        $res = DB::table('navigation')->where('nav_id',$id)->delete();
        if($res){
            echo json_encode(array('code'=>200,'success'=>true,'message'=>'删除成功'));
        }else{
            echo json_encode(array('code'=>400,'success'=>false,'message'=>'删除失败'));
        }
    }





}