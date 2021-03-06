<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/l',function(){
    return view('layui');
});
Route::get('/lr',function(){
    return view('layuir');
});
Route::get('/buttons',function(){
    return view('buttons');
});
//get的方式
/*Route::get('foo/{id}',function($id){
    return '你好,foo'.$id;
})->where('id','[0-9]+');

Route::get('user/{id}/{name}', function ($id, $name) {
    return '你好,user'.$id.'name='.$name;
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
//Route::redirect('/here', '/there');重定向*/

Route::get('/login','Admin\LoginController@login');
Route::post('/login/save','Admin\LoginController@save');
Route::get('/login/logout','Admin\LoginController@logout');
Route::get('/admin/index','Admin\IndexController@index')->middleware('adminuser');
Route::get('/admin/navigation/list','Admin\NavigationController@nlist')->middleware('adminuser');
Route::get('/admin/navigation/add','Admin\NavigationController@nadd')->middleware('adminuser');
Route::post('/admin/navigation/save','Admin\NavigationController@nsave')->middleware('adminuser');
Route::get('/admin/navigation/update/{id}','Admin\NavigationController@nupdate')->middleware('adminuser');
Route::post('/admin/navigation/updateSave/{id}','Admin\NavigationController@nUpdateSave')->middleware('adminuser');
Route::get('/admin/navigtion/nDelete/{id}','Admin\NavigationController@nDelete')->middleware('adminuser');
Route::get('/admin/article_type/list','Admin\ArticleTypeController@nList')->middleware('adminuser');
Route::get('/admin/article_type/add','Admin\ArticleTypeController@nadd')->middleware('adminuser');
Route::post('/admin/article_type/save','Admin\ArticleTypeController@nsave')->middleware('adminuser');
Route::get('/admin/article_type/update/{id}','Admin\ArticleTypeController@nupdate')->middleware('adminuser');
Route::post('/admin/article_type/UpSave/{id}','Admin\ArticleTypeController@nUpSave')->middleware('adminuser');
Route::get('/admin/article_type/detele/{id}','Admin\ArticleTypeController@ndetele')->middleware('adminuser');
Route::get('/admin/article/add','Admin\ArticleController@nadd')->middleware('adminuser');
Route::post('/admin/article/save','Admin\ArticleController@nsave')->middleware('adminuser');
Route::get('/admin/article/list','Admin\ArticleController@nlist')->middleware('adminuser');
Route::get('/admin/article/Alist','Admin\ArticleController@nAlist')->middleware('adminuser');

Route::get('/admin/article/Courselist','Admin\ArticleController@nCourselist')->middleware('adminuser');
Route::get('/admin/article/CourseAlist','Admin\ArticleController@nCourseAlist')->middleware('adminuser');
Route::get('/admin/article/Courseadd','Admin\ArticleController@nCourseadd')->middleware('adminuser');
Route::post('/admin/article/CourseSave','Admin\ArticleController@nCourseSave')->middleware('adminuser');
Route::get('/admin/article/CourseClass/{id}','Admin\ArticleController@nCourseClass')->middleware('adminuser');
Route::get('/admin/article/CourseUpdate/{id}','Admin\ArticleController@nCourseUpdate')->middleware('adminuser');
Route::match(['get','post'],'/admin/article/CourseupdateSave/{id}','Admin\ArticleController@nCourseupdateSave')->middleware('adminuser');
Route::get('/admin/article/Coursedelete/{id}','Admin\ArticleController@nCoursedelete')->middleware('adminuser');

Route::get('/admin/article/Astate/{state}/{value}/{id}','Admin\ArticleController@Astate')->middleware('adminuser');
Route::get('/admin/article/update/{id}','Admin\ArticleController@nUpdate')->middleware('adminuser');
Route::match(['get','post'],'/admin/article/updateSave/{id}','Admin\ArticleController@nUpdateSave')->middleware('adminuser');
Route::get('/admin/article/ndelete/{id}','Admin\ArticleController@ndelete')->middleware('adminuser');
Route::get('/admin/setting','Admin\SettingController@nset')->middleware('adminuser');
Route::match(['get','post'],'/admin/setting/nupload','Admin\SettingController@nupload')->middleware('adminuser');
Route::post('/admin/setting/save','Admin\SettingController@nSave')->middleware('adminuser');
Route::get('/admin/make','Admin\SettingController@nMake')->middleware('adminuser');
Route::get('/admin/Manage/set','Admin\ManageController@nset')->middleware('adminuser');
Route::post('/admin/Manage/save','Admin\ManageController@nsave')->middleware('adminuser');
Route::get('/admin/Manage/cache','Admin\ManageController@ncache')->middleware('adminuser');
Route::post('/admin/Manage/cacheSave','Admin\ManageController@ncacheSave')->middleware('adminuser');

Route::get('/admin/Adv/list','Admin\AdvController@nlist')->middleware('adminuser');
Route::get('/admin/Adv/padd','Admin\AdvController@npadd')->middleware('adminuser');
Route::post('/admin/Adv/psave','Admin\AdvController@psave')->middleware('adminuser');
Route::get('/admin/Adv/alist','Admin\AdvController@nalist')->middleware('adminuser');
Route::get('/admin/Adv/astate/{state}/{value}/{id}','Admin\AdvController@nAstate')->middleware('adminuser');
Route::get('/admin/Adv/Upadv/{id}','Admin\AdvController@nUpadv')->middleware('adminuser');
Route::post('/admin/Adv/Upsave/{id}','Admin\AdvController@nUpsave')->middleware('adminuser');
Route::get('/admin/Adv/add/{id}','Admin\AdvController@nadd')->middleware('adminuser');

Route::post('/admin/Adv/save/{id}','Admin\AdvController@nsave')->middleware('adminuser');

Route::match(['get','post'],'/admin/Adv/Upload/{width}/{height}','Admin\AdvController@nUpload')->middleware('adminuser');
Route::get('/admin/Adv/Advlist/{id}','Admin\AdvController@nAdvlist')->middleware('adminuser');
Route::get('/admin/Adv/Aadvlist/{id}','Admin\AdvController@Aadvlist')->middleware('adminuser');
Route::get('/admin/Adv/AdvDelete/{id}','Admin\AdvController@AdvDelete')->middleware('adminuser');
Route::get('/admin/Adv/UAdv/{id}','Admin\AdvController@UAdv')->middleware('adminuser');
Route::post('/admin/Adv/nsave/{id}','Admin\AdvController@save')->middleware('adminuser');
Route::get('/admin/adv/advPD/{id}','Admin\AdvController@AdvPositionD')->middleware('adminuser');

//前端的页面
Route::get('/','Home\IndexController@Index');//首页布局
Route::get('/home.html','Home\IndexController@Home');//首页板块
Route::get('/ca.html',function(){
    return view('/ca');
});






