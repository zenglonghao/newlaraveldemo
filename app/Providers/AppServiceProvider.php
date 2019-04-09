<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *引导任何应用程序服务。
     * @return void
     */
    public function boot()
    {
        //记录sql
        DB::listen(function ($query) {
            $sql = $query->sql;
            $bindings = $query->bindings;
            $time = $query->time;
            //写入sql
            if ($bindings) {
                file_put_contents('./log/'.date('Y-m-d').'SqlLog.txt', "[" . date("Y-m-d H:i:s") . "]" . $sql . "\r\nparmars:" . json_encode($bindings, 320) . "\r\n\r\n", FILE_APPEND);
            } else {
                file_put_contents('./log/'.date('Y-m-d').'SqlLog.txt', "[" . date("Y-m-d H:i:s") . "]" . $sql . "\r\n\r\n", FILE_APPEND);
            }
        });
        view()->composer(
            ['Layout/Admin/head'], //模板名
            'App\Http\ViewComposers\MovieComposer'  //方法名或者类中的方法
        );
        view()->composer(
            ['Layout/Home/head'], //模板名
            'App\Http\ViewComposers\HomeComposer'  //方法名或者类中的方法
        );
    }

    /**
     * Register any application services.
     *注册服务提供商。
     * @return void
     */
    public function register()
    {
        //
    }
}
