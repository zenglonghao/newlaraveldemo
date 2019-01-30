<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArticleController extends Controller{

    /**
     * 文章添加页面
     * */
    public function nadd(){
       $article_class = DB::table('article_class')->where('ac_parent_id',0)->orderBy('ac_sort','desc')->get();
        return view('Admin/Article/nadd',['article_class' => $article_class]);
    }

    /**
     * 文章添加保存
     * */
    public function nsave(Request $request){
        $post = $_POST;
       //$images = $request->file('article_image');
       //$article_image = $this->AUpload($images);
        per($_POST);
    }

    /**
     * 文章图片上传处理(单图片)
     * @param $image =>图片资源
     * */
    public function AUpload($images){
        $time = date('Y/m/d',time());
        $filedir="images/admin/article/".$time; //2、定义图片上传路径
        $imagesName=$images->getClientOriginalName(); //3、获取上传图片的文件名
        $extension = $images -> getClientOriginalExtension(); //4、获取上传图片的后缀名
        $newImagesName=md5(time()).random_int(5,5).".".$extension;//5、重新命名上传文件名
        $res = $images->move($filedir,$newImagesName); //6、使用move方法移动文件.
        if($res){
            return $filedir.$newImagesName;
        }else{
            return '';
        }
    }

}