<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
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
        $categories = Category::with("children")->where("parent_id",null)->get();


//        dd($categories);
//        view()->share("categories",$categories); // all views
        view()->composer('layout', function($view) use ($categories)
        {
            $view->with('categories',$categories);
        });

    }
}
