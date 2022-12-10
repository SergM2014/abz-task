<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.employees.partials.uploadPhoto', function ($view) {

            // following code will create $posts variable which we can use
            // in our post.list view you can also create more variables if needed
            $view->with('photo', \old('photo')?? 'no-avatar.png');
        });
    }
}
