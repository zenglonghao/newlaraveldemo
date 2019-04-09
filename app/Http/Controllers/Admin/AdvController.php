<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class AdvController extends Controller{
    /**
     * 广告管理
     * */

    public $pagesize = 10;
    public $img_route = 'images/admin/adv/';

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
     * 广告位的删除
     * */
    public function AdvPositionD($id){
        DB::beginTransaction();
        try{
            DB::table('adv_position')->where('ap_id',$id)->delete();//删除广告位
            //删除广告信息以及图片信息
            $adv = DB::table('adv')->where('ap_id',$id)->get()->toArray();
            if(!empty($adv)){
                foreach($adv as $v){
                    $adv_pic = unserialize($v->adv_content)['adv_pic'];
                    if($adv_pic[0] == '/'){
                        $adv_pic = '.'.$adv_pic;
                    }
                    unlink($adv_pic);
                }
                DB::table('adv')->where('ap_id',$id)->delete();
            }
            DB::commit();
            echo json_encode(array('code'=>200,'message'=>'操作成功','success'=>true));die();
        }catch (\Exception $e){
            DB::rollBack();
            echo json_encode(array('code'=>400,'message'=>'操作失败','success'=>false));die();
        }
    }


    /**
     * 添加广告
     * */
    public function nadd($id){
        $advposition = DB::table('adv_position')->where('ap_id',$id)->first();
        $time = date('Y-m-d',time());
        return view('Admin/Adv/nadd',['advposition'=>$advposition,'time'=>$time]);
    }

    /**
     * 广告图片上传
     * */
    public function nUpload($width,$height){
        $files = $_FILES['file'];
        if(!empty($files)){
            $extension = explode('.',$files['name'])[1];
            $img = Image::make($files['tmp_name']);//打开图片资源
            $img->resize($width, $height);//压缩成大小
            $route = $this->img_route.md5(time()).random_int(5,5).".".$extension;
            $res = $img->save($route);//保存图片
            echo json_encode(array('code'=>'200','message'=>'上传成功','route'=>'/'.$route));
        }else{
            echo json_encode(array('code'=>'400','message'=>'上传失败','route'=>''));
        }
    }

    /**
     * 广告保存
     * */
    public function nsave($id){
        $post = $_POST;
        $insert_adv = array();
        $adv_time = explode('~',$post['adv_time']);
        $insert_adv['adv_start_date'] = strtotime($adv_time[0]);
        $insert_adv['adv_end_date'] = strtotime($adv_time[1]);
        $insert_adv['adv_title'] = $post['adv_title'];
        $insert_adv['slide_sort'] = $post['slide_sort'];
        $adv_content = array();
        $adv_content['adv_pic'] = $post['img_file'];
        $adv_content['adv_pic_url'] = $post['href'];
        $insert_adv['adv_content'] = serialize($adv_content);
        $insert_adv['ap_id'] = $id;
        $res =  DB::table('adv')->insert($insert_adv);
        if($res){
            success(array(),200,'操作成功');
        }else{
            error(400,'操作失败');
        }
    }

    /**
     * 广告列表
     * */
    public function nAdvlist($id){
        return view('Admin/Adv/advlist',['pagesize'=>$this->pagesize,'id'=>$id]);
    }

    /**
     * 广告列表的异步数据请求
     * */
    public function Aadvlist($id){
        $advlist = DB::table('adv')->where('ap_id',$id)->orderBy('slide_sort','asc')->paginate($this->pagesize);
        if(!empty($advlist)){
            foreach($advlist as $k=>$v){
                $advlist[$k]->adv_start_date_name = date('Y-m-d',$v->adv_start_date);
                $advlist[$k]->adv_end_date_name = date('Y-m-d',$v->adv_end_date);
            }
        }
        $advlist = $advlist->toArray();
        $array = array('code'=>0,'msg'=>'','count'=>$advlist['total'],'data'=>$advlist['data']);
        echo json_encode($array);
    }

    /**
     * 广告删除
     * */
    public function AdvDelete($id){
        $advInfo = DB::table('adv')->where('adv_id',$id)->first();
        $adv_content = unserialize($advInfo->adv_content);
        if($adv_content['adv_pic'][0]=='/'){
            $adv_content['adv_pic'] = '.'.$adv_content['adv_pic'];
        }
        unlink($adv_content['adv_pic']);
        $res = DB::table('adv')->where('adv_id',$id)->delete();
        if($res){
            echo json_encode(array('code'=>200,'success'=>true,'message'=>'删除成功'));
        }else{
            echo json_encode(array('code'=>400,'success'=>false,'message'=>'删除失败'));
        }
    }

    /**
     * 广告编辑
     * */
    public function UAdv($id){
        $advInfo = DB::table('adv')->where('adv_id',$id)->first();
        $advInfo->adv_time = date('Y-m-d',$advInfo->adv_start_date).'~'.date('Y-m-d',$advInfo->adv_end_date);
        $advInfo->adv_content = unserialize($advInfo->adv_content);
        $advposition = DB::table('adv_position')->where('ap_id',$advInfo->ap_id)->first();
        $time = date('Y-m-d',time());
        return view('Admin/Adv/UAdv',['advInfo'=>$advInfo,'advposition'=>$advposition,'time'=>$time]);
    }


    /**
     * 广告编辑保存
     * */
    public function save($id){
        $post =$_POST;
        $update_adv = array();
        $adv_time = explode('~',$post['adv_time']);
        $update_adv['adv_start_date'] = strtotime($adv_time[0]);
        $update_adv['adv_end_date'] = strtotime($adv_time[1]);
        $update_adv['adv_title'] = $post['adv_title'];
        $update_adv['slide_sort'] = $post['slide_sort'];
        $adv_content = array();
        $adv_content['adv_pic'] = $post['img_file'];
        $adv_content['adv_pic_url'] = $post['href'];
        $update_adv['adv_content'] = serialize($adv_content);
        $res =  DB::table('adv')->where('adv_id',$id)->update($update_adv);
        if($res){
            success(array(),200,'操作成功');
        }else{
            error(400,'操作失败');
        }
    }

}