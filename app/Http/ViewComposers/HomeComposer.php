<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;//**记得引入这个啊（因为在composer函数参数里使用了View类）**
use Illuminate\Http\Request;//这个是读取session的类
use Illuminate\Support\Facades\DB;

class HomeComposer
{
    public $movieList = [];
    public $user = array();
    public function __construct(Request $request){}

    public function compose(View $view)
    {
        $array = $this->common();
        $view->with($array);
    }

    /**
     *公共的数据
     * */
    private function common(){
        $set = DB::table('setting')->get();
        $setArray = $set->toArray();
        $newsArray = array();
        foreach($setArray as $k=>$v){
            $newsArray[$v->name] = $v->value;
        }
        foreach($this->getTimeZone() as $k=>$v){
            if($v == $newsArray['time_zone']){
                $newsArray['time_zone_id'] = $k;
            }
        }
        return $newsArray;
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