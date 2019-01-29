<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArticleTypeController extends Controller{

    public function nList(){
        $article_class = DB::table('article_class')->orderBy('ac_sort','desc')->paginate(20);
        return view('Admin/ArticleType/nlist',['article_class' => $article_class]);
    }

    /**
     * 添加文章分类
     * */
    public function nadd(){
        return view('Admin/ArticleType/nadd');
    }

    /**
     * 添加文章分类保存
     * */
    public function nsave(){
        $insert_data = array();
        $post = $_POST;
        $insert_data['ac_name'] = $post['ac_name'];
        $insert_data['ac_parent_id'] = $post['ac_parent_id'];
        $insert_data['ac_sort'] = $post['ac_sort'];
        $res =  DB::table('article_class')->insert($insert_data);
        if($res){
            return view('message')->with(['message'=>'操作成功','jumpTime'=>3,'url'=>'/admin/article_type/add']);
        }else{
            return view('message')->with(['message'=>'操作失败','jumpTime'=>3,'url'=>'/admin/article_type/add']);
        }
    }


    /**
     * 编辑文章
     * */
    public function nupdate($id){
        $ClassRow = DB::table('article_class')->where('ac_id',$id)->first();
        if(empty($ClassRow->ac_id)){
            return view('message')->with(['message'=>'非法操作','jumpTime'=>3,'url'=>'/admin/navigation/add']);
        }else{
            return view('Admin/ArticleType/nupdate',['ClassRow'=>$ClassRow]);
        }
    }


    /**
     * 编辑文章分类保存
     * */
    public function nUpSave($id){
        $updateArray = array();
        $post = $_POST;
        $updateArray['ac_name'] = $post['ac_name'];
        $updateArray['ac_parent_id'] = $post['ac_parent_id'];
        $updateArray['ac_sort'] = $post['ac_sort'];
        $res = DB::table('article_class')->where('ac_id',$id)->update($updateArray);
        if($res){
            return view('message')->with(['message'=>'编辑成功','jumpTime'=>3,'url'=>'/admin/article_type/update/'.$id]);
        }else{
            return view('message')->with(['message'=>'编辑失败','jumpTime'=>3,'url'=>'/admin/article_type/update/'.$id]);
        }
    }

    /**
     * 删除文章分类
     * */
    public function ndetele($id){
        $res = DB::table('article_class')->where('ac_id',$id)->delete();
        if($res){
            echo json_encode(array('code'=>200,'success'=>true,'message'=>'删除成功'));
        }else{
            echo json_encode(array('code'=>400,'success'=>false,'message'=>'删除失败'));
        }
    }



}