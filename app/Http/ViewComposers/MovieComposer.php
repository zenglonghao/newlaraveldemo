<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;//**记得引入这个啊（因为在composer函数参数里使用了View类）**
use Illuminate\Http\Request;//这个是读取session的类

class MovieComposer
{
    public $movieList = [];
    public function __construct()
    {
        $this->movieList = [
            'Shawshank redemption',
            'Forrest Gump',
        ];
    }
    public function compose(View $view)
    {
        //$view->with('latestMovie');
        /*$admin_name = $request->session()->get('admin_name');*/
        $view->with(array('name'=>'123'));
    }
}