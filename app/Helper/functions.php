<?php


if(! function_exists('show_ueditor')){
    /*
     * 百度编辑器
     * $ueditor  编辑器id 默认值为 ueditor
     * $name 编辑器区域名称
     * $content 编辑器内容 默认为空
     * $width 编辑器的宽度
     * $height 编辑器的高度
     */
    function show_ueditor($ueditor='ueditor',$name='content',$content= '',$width=600,$height=300){
        $str = '';
        $str .= '<script id="'.$ueditor.'" name="'.$name.'" type="text/plain" style="width:'.$width.'px;height:'.$height.'px;">'.$content.'</script>';

        $str .= '<script type="text/javascript" charset="utf-8" src="'.asset('lib/utf8-php/ueditor.config.js').'"></script>';
        $str .= '<script type="text/javascript" charset="utf-8" src="'.asset('lib/utf8-php/ueditor.all.min.js').'"> </script>';
        $str .= '<script type="text/javascript" charset="utf-8" src="'.asset('lib/utf8-php/lang/zh-cn/zh-cn.js').'"></script>';
        $str .= '<script src="'.asset('lib/utf8-php/jquery-2.0.3.min.js').'"></script>';

        $str .= '<script src="'.asset('lib/utf8-php/bootstrap.min.js').'"></script>';
        $str .= '<script type="text/javascript">';
        $str .= 'var ue = UE.getEditor(\''.$ueditor.'\')';
        $str .= '</script>';
        return $str;
    }
}

/**
 *打印数组
 * @param $array 打印的数组
 * @param $error 是否终止
 * */
function p($array=array(),$error=0){
    echo '<pre>';
    print_R($array);
    echo '</pre>';
    if(empty($error)){
        die();
    }
}

/**
 * 成功josn返回
 * @code 状态
 * @message 留言
 * @data 数据
 * */
function success($data=array(),$code=200,$message=''){
    exit(json_encode(array('code'=>$code,'message'=>$message,'data'=>$data,'success'=>true)));
}

/**
 * 失败json返回
 * @code 状态
 * @message 留言
 * @href
 * */
function error($code=400,$message='',$href=''){
    exit(json_encode(array('code'=>$code,'message'=>$message,'href'=>$href,'success'=>false)));
}

