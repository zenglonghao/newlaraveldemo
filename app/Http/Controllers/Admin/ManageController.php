<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Cache;

//管理
class ManageController extends Controller{

    /**
     * 站点设置
     * */
    public function nset(){
        $set = DB::table('setting')->get();
        $setArray = $set->toArray();
        //缓存菜单数据
       Cache::forever(config('admin.globals.cache.setList'), $setArray);
        return view('Admin/Manage/nset');
    }


    /**
     * 站点信息保存
     * */
    public function nsave(){
        $update_array = array();
        $update_array['time_zone'] = $this->setTimeZone($_POST['time_zone']);//时区
        $update_array['Wedsite_name'] = $_POST['Wedsite_name'];//网站名称
        $update_array['Copyright'] = $_POST['Copyright'];//版权底部信息
        $update_array['icp_number'] = $_POST['icp_number'];//ICP证书号
        $newsdata_array = array();
        $array = array();
        foreach($update_array as $k=>$v){
            $array['name']= $k ;
            $array['value'] = $v;
            $newsdata_array[] = $array;
        }
        $res = $this->updateBatch('case_setting',$newsdata_array);
        echo json_encode(array('code'=>200,'message'=>'设置成功','success'=>true));
    }

    public function updateBatch($tableName = "", $multipleData = array()){
        if( $tableName && !empty($multipleData) ) {
            $updateColumn = array_keys($multipleData[0]);
            $q = "UPDATE ".$tableName." SET ";
            $whereIn = "";
            $q .= $updateColumn[1].' = CASE '.$updateColumn[0].' ';
            foreach($multipleData as $k=>$v){
                $q .= " WHEN '".$v[$updateColumn[0]]."' THEN '".$v[$updateColumn[1]]."' ";
                $whereIn .= "'".$v[$updateColumn[0]]."', ";
            }
            $whereIn = rtrim($whereIn, ', ');
            $q .= " END WHERE $updateColumn[0] in($whereIn)";
            return DB::update(DB::raw($q));
        }else{
            return false;
        }
    }

    /**
     * 设置时区
     *
     * @param int $time_zone 时区键值
     */
    private function setTimeZone($time_zone){
        $zonelist = $this->getTimeZone();
        return empty($zonelist[$time_zone]) ? 'Asia/Shanghai' : $zonelist[$time_zone];
    }

    private function getTimeZone(){
        return array(
            '-12' => 'Pacific/Kwajalein',
            '-11' => 'Pacific/Samoa',
            '-10' => 'US/Hawaii',
            '-9' => 'US/Alaska',
            '-8' => 'America/Tijuana',
            '-7' => 'US/Arizona',
            '-6' => 'America/Mexico_City',
            '-5' => 'America/Bogota',
            '-4' => 'America/Caracas',
            '-3.5' => 'Canada/Newfoundland',
            '-3' => 'America/Buenos_Aires',
            '-2' => 'Atlantic/St_Helena',
            '-1' => 'Atlantic/Azores',
            '0' => 'Europe/Dublin',
            '1' => 'Europe/Amsterdam',
            '2' => 'Africa/Cairo',
            '3' => 'Asia/Baghdad',
            '3.5' => 'Asia/Tehran',
            '4' => 'Asia/Baku',
            '4.5' => 'Asia/Kabul',
            '5' => 'Asia/Karachi',
            '5.5' => 'Asia/Calcutta',
            '5.75' => 'Asia/Katmandu',
            '6' => 'Asia/Almaty',
            '6.5' => 'Asia/Rangoon',
            '7' => 'Asia/Bangkok',
            '8' => 'Asia/Shanghai',
            '9' => 'Asia/Tokyo',
            '9.5' => 'Australia/Adelaide',
            '10' => 'Australia/Canberra',
            '11' => 'Asia/Magadan',
            '12' => 'Pacific/Auckland'
        );
    }
}
