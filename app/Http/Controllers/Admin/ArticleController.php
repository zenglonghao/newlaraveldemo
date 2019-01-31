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
        $insert_data = array();
        $insert_data['article_title'] = $post['article_title'];
        $insert_data['article_class_id'] = $post['article_class_id'];
        $insert_data['article_origin'] = $post['article_origin'];
        $insert_data['article_author'] = $post['article_author'];
        $insert_data['article_abstract'] = $post['article_abstract'];
        $insert_data['article_content'] = $post['article_content'];
        $article_time = explode('~',$post['article_time']);
        $insert_data['article_start_time'] = strtotime($article_time[0]);
        $insert_data['article_end_time'] = strtotime($article_time[1]);
        $insert_data['article_publish_time'] = time();
        $insert_data['article_sort'] = $post['article_sort'];
        $insert_data['article_commend_flag'] = isset($post['article_commend_flag'])?1:0;
        $insert_data['article_comment_flag'] = isset($post['article_comment_flag'])?1:0;
        $images = $request->file('article_image');
        if(!empty($images)){
            $article_image = $this->AUpload($images);
            $insert_data['article_image'] = $article_image;
        }else{
            $insert_data['article_image'] = '';
        }

        $res =  DB::table('article')->insert($insert_data);
        if($res){
            return view('message')->with(['message'=>'操作成功','jumpTime'=>3,'url'=>'/admin/article/add']);
        }else{
            return view('message')->with(['message'=>'操作失败','jumpTime'=>3,'url'=>'/admin/article/add']);
        }
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


    /**
     * 文章列表
     * */
    public function nlist(){
        $field = $this->AField();
        $article = DB::table('article')->select($field)->orderBy('article_sort','desc')->paginate(20);
        $articlenew = array();
        if(!empty($article)){
            foreach($article as $k=>$v){
                $starttime = date('Y-m-d',$v->article_start_time);
                $endtime = date('Y-m-d',$v->article_end_time);
                $article[$k]->article_publish_time = date('Y-m-d',$v->article_publish_time);
                $article[$k]->article_time = $starttime.'~'.$endtime;
            }
        }
        //echo json_encode($articlenew);die();
        return view('Admin/Article/nlist',['article' => json_encode($article)]);
    }


    /**
     * 文章列表显示的字段
     * */
    public function AField(){
        $field = array();
        $field[] = 'article_id';
        $field[] = 'article_title';
        $field[] = 'article_origin';
        $field[] = 'article_class_id';
        $field[] = 'article_author';
        $field[] = 'article_start_time';
        $field[] = 'article_end_time';
        $field[] = 'article_publish_time';
        $field[] = 'article_commend_flag';
        $field[] = 'article_comment_flag';
        $field[] = 'article_state';
        return $field;
    }

}