<?php 
if(! function_exists('show_ueditor')){
    /*
     * 百度编辑器
     * $ueditor  编辑器id 默认值为 ueditor
     * $name 编辑器区域名称
     * $content 编辑器内容 默认为空
     */
    function show_ueditor($ueditor='ueditor',$name='content',$content= ''){
        $str = '';
        $str .= '<script id="'.$ueditor.'" name="'.$name.'" type="text/plain" style="width:100%px;height:300px;">'.$content.'</script>';

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