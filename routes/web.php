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
//get的方式
/*Route::get('foo/{id}',function($id){
    return '你好,foo'.$id;
})->where('id','[0-9]+');

Route::get('user/{id}/{name}', function ($id, $name) {
    return '你好,user'.$id.'name='.$name;
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);*/


Route::get('/login','Admin\LoginController@login');
Route::post('/login/save','Admin\LoginController@save');
Route::get('/login/logout','Admin\LoginController@logout');
Route::get('/admin/index','Admin\IndexController@index')->middleware('adminuser');
Route::get('/admin/navigation/list','Admin\NavigationController@nlist')->middleware('adminuser');









