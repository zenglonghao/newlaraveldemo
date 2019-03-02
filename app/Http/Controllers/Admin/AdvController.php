<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class AdvController extends Controller{
    /**
     * 广告管理
     * */

    public $pagesize = 10;

    /**
     * 广告位列表
     * */
    public function nlist(){
        return view('Admin/Adv/list',['pagesize'=>$this->pagesize]);
    }


    /**
     * 广告位列表异步请求
     * */
    public function nalist(){
        $nalist = DB::table('adv_position')->orderBy('ap_id','asc')->paginate($this->pagesize);
        $nalist = $this->state($nalist);
        $adv_position = $nalist->toArray();
        $array = array('code'=>0,'msg'=>'','count'=>$adv_position['total'],'data'=>$adv_position['data']);
        echo json_encode($array);
    }

    /**
     * 广告位状态转为文字
     * @list array
     * @return array
     * */
    private function state($list){
        foreach($list as $k=>$v){
            switch($v->ap_class){
                case 0:
                    $list[$k]->ap_class_name = '图片';
                    break;
                case 1:
                    $list[$k]->ap_class_name = '文字';
                    break;
                case 2:
                    $list[$k]->ap_class_name = '幻灯';
                    break;
                case 3:
                    $list[$k]->ap_class_name = 'Flash';
                    break;
            }
            switch($v->ap_display){
                case 0:
                    $list[$k]->ap_display_name = '幻灯片';
                    break;
                case 1:
                    $list[$k]->ap_display_name = '多广告展示';
                    break;
                case 2:
                    $list[$k]->ap_display_name = '单广告展示';
                    break;
            }
        }
        return $list;
    }


    /**
     * 广告位显示更改
     * */
    public function nAstate($state,$value,$id){
        $update = array();
        if($value == 'true'){
            $update[$state] = 1;
        }else{
            $update[$state] = 0;
        }
        $res = DB::table('adv_position')->where('ap_id',$id)->update($update);
        if($res){
            echo json_encode(array('code'=>200,'msg'=>'操作成功','success'=>true));
        }else{
            echo json_encode(array('code'=>400,'msg'=>'操作失败','success'=>false));
        }
    }

    /**
     * 添加广告位页面
     * */
    public function npadd(){
        return view('Admin/Adv/padd');
    }

    /**
     * 添加广告位页面保存
     * */
    public function psave(){
        $post = $_POST;
        $adv_position = array();
        $adv_position['ap_name'] = $post['ap_name'];
        $adv_position['ap_intro'] = $post['ap_intro'];
        $adv_position['ap_class'] = $post['ap_class'];
        $adv_position['ap_display'] = $post['ap_display'];
        $adv_position['ap_width'] = $post['ap_width'];
        $adv_position['ap_height'] = $post['ap_height'];
        $adv_position['is_use'] = isset($post['is_use'])?1:0;
        $res =  DB::table('adv_position')->insert($adv_position);
        if($res){
            success(array(),200,'操作成功');
        }else{
            error(400,'操作失败');
        }
    }

    /**
     * 编辑广告位
     * */
    public function nUpadv($id){
       $advposition = DB::table('adv_position')->where('ap_id',$id)->first();
        $_class = $this->_class();
        return view('Admin/Adv/Uposition',['advposition'=>$advposition,'_class'=>$_class]);
    }

    /**
     * 分类选择
     * */
    private function _class(){
        $array = array();
        $array['ap_display'][0] = '幻灯片';
        $array['ap_display'][1] = '多广告展示';
        $array['ap_display'][2] = '单广告展示';

        $array['ap_class'][0] = '图片';
        $array['ap_class'][1] = '文字';
        $array['ap_class'][2] = '幻灯';
        return $array;
    }

    /**
     * 编辑广告位保存
     * */
    public function nUpsave($id){
        $post = $_POST;
        $adv_position = array();
        $adv_position['ap_name'] = $post['ap_name'];
        $adv_position['ap_intro'] = $post['ap_intro'];
        $adv_position['ap_class'] = $post['ap_class'];
        $adv_position['ap_display'] = $post['ap_display'];
        $adv_position['ap_width'] = $post['ap_width'];
        $adv_position['ap_height'] = $post['ap_height'];
        $adv_position['is_use'] = isset($post['is_use'])?1:0;
        $res =  DB::table('adv_position')->where('ap_id',$id)->update($adv_position);
        if($res){
            success(array(),200,'操作成功');
        }else{
            error(400,'操作失败');
        }
    }


    /**
     * 添加广告
     * */
    public function nadd($id){
        $advposition = DB::table('adv_position')->where('ap_id',$id)->first();

        return view('Admin/Adv/nadd',['advposition'=>$advposition]);
    }

}