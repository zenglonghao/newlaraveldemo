<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArticleController extends Controller{
    public $pagesize = 10;

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
        $filedir="images/admin/article/".$time.'/'; //2、定义图片上传路径
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
        return view('Admin/Article/nlist',['pagesize'=>$this->pagesize]);
    }

    /**
     * 文章编辑
     * */
    public function nUpdate($id){
        $article = DB::table('article')->where('article_id',$id)->first();
        $article_class = DB::table('article_class')->where('ac_parent_id',0)->orderBy('ac_sort','desc')->get();
        $starte_time = date('Y-m-d',$article->article_start_time);
        $end_time = date('Y-m-d',$article->article_end_time);
        $article->article_time = $starte_time.'~'.$end_time;
        $time = date('Y-m-d',time());
        return view('Admin/Article/nUpdate',['article'=>$article,'article_class' => $article_class,'time'=>$time]);
    }


    /**
     * 文章编辑保存
     * */
    public function nUpdateSave($id){
       $updateArray = array();
       $post = $_POST;
        $updateArray['article_title'] = $post['article_title'];
        $updateArray['article_class_id'] = $post['article_class_id'];
        $updateArray['article_origin'] = $post['article_origin'];
        $updateArray['article_author'] = $post['article_author'];
        $updateArray['article_abstract'] = $post['article_abstract'];
        $updateArray['article_sort'] = $post['article_sort'];
        $updateArray['article_content'] = $post['article_content'];
        $article_time = explode('~',$post['article_time']);
        $updateArray['article_start_time'] = strtotime($article_time[0]);
        $updateArray['article_end_time'] = strtotime($article_time[1]);
        $res = DB::table('article')->where('article_id',$id)->update($updateArray);
        if($res){
            echo json_encode(array('code'=>200,'message'=>'操作成功','success'=>true));
        }else{
            echo json_encode(array('code'=>400,'message'=>'操作失败','success'=>false));
        }
    }


    /**
     * 文章列表异步请求
     * */
    public function nAlist(){
        $field = $this->AField();
        $where = array();
        if(isset($_GET['keyword'])){
            $where['article_author'] = $_GET['keyword'];
        }
        $article = DB::table('article')->select($field)->where($where)->leftjoin('article_class','article.article_class_id','=','article_class.ac_id')->orderBy('article_id','asc')->paginate($this->pagesize);
        if(!empty($article)){
            foreach($article as $k=>$v){
                $starttime = date('Y-m-d',$v->article_start_time);
                $endtime = date('Y-m-d',$v->article_end_time);
                $article[$k]->article_publish_time = date('Y-m-d',$v->article_publish_time);
                $article[$k]->article_time = $starttime.'~'.$endtime;
            }
        }
        $articlenew = $article->toArray();//将对象转换为数组
        $array = array('code'=>0,'msg'=>'','count'=>$articlenew['total'],'data'=>$articlenew['data']);
        echo json_encode($array);
    }

    /**
     * 文章状态请求
     * */
    public function Astate($state,$value,$id){
        $update = array();
        if($value == 'true'){
            $update[$state] = 1;
        }else{
            $update[$state] = 0;
        }
        $res = DB::table('article')->where('article_id',$id)->update($update);
        if($res){
            echo json_encode(array('code'=>200,'msg'=>'操作成功','success'=>true));
        }else{
            echo json_encode(array('code'=>400,'msg'=>'操作失败','success'=>false));
        }
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
        $field[] = 'ac_name';
        return $field;
    }


    /**
     * 文章删除接口
     *
     * */
    public function ndelete($id){
        $res = DB::table('article')->where('article_id',$id)->delete();
        if($res){
            echo json_encode(array('code'=>200,'success'=>true,'message'=>'删除成功'));
        }else{
            echo json_encode(array('code'=>400,'success'=>false,'message'=>'删除失败'));
        }
    }
}