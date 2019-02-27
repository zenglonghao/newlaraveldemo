<?php
namespace App\Http\Controllers\Admin;

use App\Models\article_class;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;

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
        $article = DB::table('article')->select($field)->where($where)->whereNotIn('article_class_id',[4])->leftjoin('article_class','article.article_class_id','=','article_class.ac_id')->orderBy('article_id','asc')->paginate($this->pagesize);
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

    /**
     * 教程文章列表
     * */
    public function nCourselist(){
        $course_class = DB::table('course_class')->where('parent_id',0)->get()->toArray();
        if(!empty($course_class)){
            foreach($course_class as $ck=>$cv){
                $course_class[$ck]->chlid = DB::table('course_class')->where('parent_id',$cv->class_id)->get()->toArray();
            }
        }
        return view('Admin/Article/Courselist',['pagesize'=>$this->pagesize,'course_class'=>$course_class]);
    }

    /**
     * 教程列表教程异步请求
     * */
    public function nCourseAlist(){
        $field = $this->AField();
        $where = array();
        $orwhere = array();
        if(isset($_GET['class_id'])){
            $class_id = substr($_GET['class_id'],2);
            if(strpos($_GET['class_id'],'a_') !== false){
                $where['article_Course_class_1'] = $class_id;
            }else{
                $where['article_Course_class_2'] = $class_id;
            }
            $orwhere['article_id'] = $class_id;

        }
        $where['article_class_id'] = 4;//教程
        if(isset($_GET['title'])){
            $article = DB::table('article')->select($field)->where($where)->where('article_title','like','%'.$_GET['title'].'%')->orWhere($orwhere)->leftjoin('article_class','article.article_class_id','=','article_class.ac_id')->orderBy('article_id','asc')->paginate($this->pagesize);
        }else{
            $article = DB::table('article')->select($field)->where($where)->orWhere($orwhere)->leftjoin('article_class','article.article_class_id','=','article_class.ac_id')->orderBy('article_id','asc')->paginate($this->pagesize);
        }
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
     * 教程添加
     * */
    public function nCourseadd(){
        $time = time();
        $course_class = DB::table('course_class')->where('parent_id',0)->get()->toArray();
        return view('Admin/Article/Courseadd',['time'=>$time,'course_class'=>$course_class]);
    }

    /**
     * 教程编辑
     * */
    public function nCourseUpdate($id){
        $article = DB::table('article')->where('article_id',$id)->first();
        $starte_time = date('Y-m-d',$article->article_start_time);
        $end_time = date('Y-m-d',$article->article_end_time);
        $article->article_time = $starte_time.'~'.$end_time;
        $time = date('Y-m-d',time());
        $course_class = DB::table('course_class')->where('parent_id',0)->get()->toArray();
        $course_class_1 = array();
        if($article->article_Course_class_1 != 0){
            $course_class_1 = DB::table('course_class')->where('parent_id',$article->article_Course_class_1)->get()->toArray();
        }
        return view('Admin/Article/CourseUpdate',['article'=>$article,'time'=>$time,'course_class'=>$course_class,'course_class_1'=>$course_class_1]);
    }

    /**
     * 教程编辑保存
     * */
    public function nCourseupdateSave($id){
        $updateArray = array();
        $post = $_POST;
        DB::beginTransaction();
        try{
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
            $updateArray['article_Course_class_1'] = $post['article_Course_class_1'];
            $updateArray['article_Course_class_2'] = $post['article_Course_class_2'];
            DB::table('article')->where('article_id',$id)->update($updateArray);

            $course = array();
            $course['class_name'] = $post['article_title'];
            if($post['article_Course_class_2']){
                $course['parent_id'] = $post['article_Course_class_2'];
            }else{
                $course['parent_id'] = $post['article_Course_class_1'];
            }
            DB::table('course_class')->where('class_id',$id)->update($course);
            DB::commit();
            echo json_encode(array('code'=>200,'message'=>'操作成功','success'=>true));
        }catch (\Exception $e){
            DB::rollBack();
            echo json_encode(array('code'=>400,'message'=>'操作失败','success'=>false));die();
        }
    }


    /**
     * 教程添加保存
     * */
    public function nCourseSave(){
        $post = $_POST;
        DB::beginTransaction();
        try{
            //添加article
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
            $insert_data['article_image'] = '';
            $insert_data['article_Course_class_1'] = $post['article_Course_class_1'];
            $insert_data['article_Course_class_2'] = $post['article_Course_class_2'];
            $article_id =  DB::table('article')->insertGetId($insert_data);
            //添加course_class
            $course_insert = array();
            $course_insert['class_id'] = $article_id;
            $course_insert['class_name'] = $insert_data['article_title'];
            if($post['article_Course_class_2']){
                $course_insert['parent_id'] = $post['article_Course_class_2'];
            }else{
                $course_insert['parent_id'] = $post['article_Course_class_1'];
            }
            $course_id =  DB::table('course_class')->insert($course_insert);
            DB::commit();
            echo json_encode(array('code'=>200,'message'=>'操作成功','success'=>true));die();
        }catch (\Exception $e){
            DB::rollBack();
            echo json_encode(array('code'=>400,'message'=>'操作失败','success'=>false));die();
        }

    }

    /**
     * 教程分类的子类
     * */
    public function nCourseClass($id){
        if($id < 1){
            error('400','非法操作');
        }
        $course_class = DB::table('course_class')->where('parent_id',$id)->get()->toArray();
        success($course_class);
    }

    /**
     * 教程文章删除
     * */
    public function nCoursedelete($id){
        $course_class = DB::table('course_class')->where('parent_id',$id)->get()->toArray();
        $newsarray = array();
        foreach($course_class as $k=>$v){
            $newsarray[] = $v->class_id;
        }
        $newsarray[] = $id;
        DB::beginTransaction();
        try{
            DB::table('article')->where('article_id',$id)->delete();//删除本身文章
            $orwhere = array();
            $orwhere['article_Course_class_1'] = $id;
            $orwhere['article_Course_class_2'] = $id;
            DB::table('article')->orWhere($orwhere)->delete();//删除关联下级文章
            //删除course_class
            DB::table('course_class')->where('class_id',$id)->delete();//删除教程分类
            DB::table('course_class')->whereIn('parent_id',$newsarray)->delete();
            DB::commit();
            echo json_encode(array('code'=>200,'success'=>true,'message'=>'删除成功'));
        }catch (\Exception $e){
            DB::rollBack();
            echo json_encode(array('code'=>400,'success'=>false,'message'=>'删除失败'));
        }
    }

}