<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;//**记得引入这个啊（因为在composer函数参数里使用了View类）**
use Illuminate\Http\Request;//这个是读取session的类

class MovieComposer
{
    public $movieList = [];
    public $user = array();
    public function __construct(Request $request)
    {
        $id = $request->session()->get('admin_id');
        $name = $request->session()->get('admin_name');
        $this->user = array('id'=>$id,'name'=>$name);
        $this->movieList = [
            'Shawshank redemption',
            'Forrest Gump',
        ];
    }
    public function compose(View $view)
    {
        $_menu = $this->nav();
        $view->with(array('name'=>$this->user['name'],'menu'=>$_menu));
    }

    /**
     * 后台首页导航  active
     * */
    public function nav(){
        $_menu = array();
        $_menu['Navigation'] = array(
            array('name'=>'首页','href'=>'/admin/index','icon'=>'icon-speedometer','class'=>'','child'=>array(),'nav-link'=>''),
            array(
                'name'=>'管理','href'=>'#','icon'=>'layui-icon layui-icon-website',
                'class'=>'nav-dropdown','nav-link'=>'nav-dropdown-toggle',
                'child'=>array(
                    array('name'=>'站点设置','href'=>'/admin/Manage/set','icon'=>'layui-icon layui-icon-set','class'=>''),
                    array('name'=>'清除缓存','href'=>'/admin/Manage/cache','icon'=>'layui-icon layui-icon-refresh','class'=>''),
                )
            ),
            array(
                'name'=>'导航','href'=>'#','icon'=>'icon-target',
                'class'=>'nav-dropdown','nav-link'=>'nav-dropdown-toggle',
                'child'=>array(
                    array('name'=>'导航列表','href'=>'/admin/navigation/list','icon'=>'icon-target','class'=>''),
                    array('name'=>'添加导航','href'=>'/admin/navigation/add','icon'=>'icon-target','class'=>''),
                )
            ),
            array(
                'name'=>'文章分类','href'=>'#','icon'=>'icon-target',
                'class'=>'nav-dropdown','nav-link'=>'nav-dropdown-toggle',
                'child'=>array(
                    array('name'=>'分类列表','href'=>'/admin/article_type/list','icon'=>'layui-icon layui-icon-list','class'=>''),
                    array('name'=>'添加分类','href'=>'/admin/article_type/add','icon'=>'layui-icon layui-icon-add-circle','class'=>''),
                ),
            ),
            array(
                'name'=>'文章管理','href'=>'#','icon'=>'icon-target',
                'class'=>'nav-dropdown','nav-link'=>'nav-dropdown-toggle',
                'child'=>array(
                    array('name'=>'添加文章','href'=>'/admin/article/add','icon'=>'layui-icon layui-icon-add-circle','class'=>''),
                    array('name'=>'文章列表','href'=>'/admin/article/list','icon'=>'layui-icon layui-icon-list','class'=>''),
                    array('name'=>'教程列表','href'=>'/admin/article/Courselist','icon'=>'layui-icon layui-icon-list','class'=>''),
                ),
            ),
            array(
                'name'=>'评论','href'=>'#','icon'=>'layui-icon layui-icon-notice',
                'class'=>'nav-dropdown','nav-link'=>'nav-dropdown-toggle',
                'child'=>array(
                    array('name'=>'评论管理','href'=>'#','icon'=>'layui-icon layui-icon-form','class'=>''),
                ),
            ),
            array(
                'name'=>'广告管理','href'=>'#','icon'=>'layui-icon layui-icon-website',
                'class'=>'nav-dropdown','nav-link'=>'nav-dropdown-toggle',
                'child'=>array(
                    array('name'=>'广告列表','href'=>'/admin/Adv/list','icon'=>'layui-icon layui-icon-list','class'=>''),
                ),
            ),
        );
        return $_menu;
    }

}