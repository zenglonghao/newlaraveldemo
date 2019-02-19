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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/buttons',function(){
    return view('buttons');
});
Route::get('/l',function(){
    return view('layui');
});
Route::get('/lr',function(){
    return view('layuir');
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




