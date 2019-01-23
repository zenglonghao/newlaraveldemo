<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;//**记得引入这个啊（因为在composer函数参数里使用了View类）**

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
        $view->with('latestMovie');
    }
}