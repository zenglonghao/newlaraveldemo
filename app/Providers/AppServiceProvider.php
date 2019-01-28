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
        view()->composer(
            ['Layout/Admin/head'], //模板名
            'App\Http\ViewComposers\MovieComposer'  //方法名或者类中的方法
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
