<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\MenuComposer;
use App\Http\View\Composers\SlideComposer;
use App\Http\View\Composers\HomeComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
    public function boot()
    {
        View::composer(
            'admin.customers.*',
            MenuComposer::class
        );

        View::composer(
            'admin.customers.home',
            SlideComposer::class
        );

        View::composer(
            'admin.users.home',
            HomeComposer::class
        );
    }
}
