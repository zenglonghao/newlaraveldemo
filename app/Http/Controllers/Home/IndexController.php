<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller{
    public function index(){
        return view('Home/Index/index');
    }

    public function Home(){
        $article = $this->article();
        return view('Home/Index/home',array('article'=>$article));
    }


    private function article($page=4){
        $where['article_class_id'] = 3;
        $where['article_commend_flag'] = 1;
        $where['article_state'] = 1;
        $AField = $this->AField();
        $article_array = DB::table('article')->select($AField)->where($where)->orderBy('article_start_time','desc')->paginate($page);
        return $article_array;
    }

    private function AField(){
        $field = array();
        $field[] = 'article_id';
        $field[] = 'article_title';
        $field[] = 'article_origin';
        $field[] = 'article_class_id';
        $field[] = 'article_author';
        $field[] = 'article_image';
        $field[] = 'article_abstract';
        return $field;
    }
}





