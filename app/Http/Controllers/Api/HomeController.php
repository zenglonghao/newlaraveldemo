<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\article_class;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller{

    public function index(){
        //导航信息
        $navlist = DB::table('navigation')->orderBy('nav_sort','desc')->get()->toArray();
        foreach($navlist as $k=>$v){
            $navlist[$k]->child= array();//子路由
        }
        //首页banner视图
        $bannerList = DB::table('adv')->where('ap_id',1)->orderBy('slide_sort','desc')->get()->toArray();
        foreach($bannerList as $k=>$v){
            $bannerList[$k]->adv_content = unserialize($v->adv_content);
        }
        //首页热门专题
        $hotList = DB::table('adv')->where('ap_id',2)->orderBy('slide_sort','desc')->get()->toArray();
        foreach($hotList as $k=>$v){
            $hotList[$k]->adv_content = unserialize($v->adv_content);
        }
        return response()->json(['status'=>1,'msg'=>'','data'=>array('navlist'=>$navlist,'bannerList'=>$bannerList,'hotList'=>$hotList)]);
    }

    /**
     * 测试发送邮件
     * */
    public function ce(){
        $name = '傻妞';
        $flag = Mail::send('test',['name'=>$name],function($message){
            $to = '196972191@qq.com';
            $message ->to($to)->subject('邮件测试');
        });
        if($flag){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件失败，请重试！';
        }
    }

}

