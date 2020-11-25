<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Custom\ValidYearParser;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('complete_name', function($attribute, $value){
            return preg_match('/^[a-z\sÑñ.,-]+$/i', $value);
        });

        Validator::extend('name_alpha_hyphen_space', function($attribute, $value){
            return preg_match('/^[a-z\sÑñ-]+$/i', $value);
        });

        Validator::extend('name_alpha_comma_space', function($attribute, $value){
            return preg_match('/^[a-z\sÑñ,]+$/i', $value);
        });

        Validator::extend('name_alpha_space', function($attribute, $value){
            return preg_match('/^[a-z\sÑñ]+$/i', $value);
        });

        Validator::extend('alpha_space', function($attribute, $value){
            return preg_match('/^[a-z\s]+$/i', $value);
        });

        $this->app->singleton('ValidYearParser', function ($app) {
            return new ValidYearParser;
        });

        Paginator::defaultView('vendor.pagination.default');

        Paginator::defaultSimpleView('vendor.pagination.simple-default');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
