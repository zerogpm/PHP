<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;

class CheckUserPassword extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('current_password', function($attribute, $value, $parameters, $validator) {
           
           return Hash::check($value, $parameters[0]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
