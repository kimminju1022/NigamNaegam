<?php

namespace App\Providers;

use App\Exceptions\MyAuthException;
use App\Utils\MyEncrypt;
use App\Utils\MyToken;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('MyEncrypt', function() {
            return new MyEncrypt();
        });
        $this->app->bind('MyToken', function() {
            return new MyToken();
        });
        $this->app->bind('MyAuthException', function() {
            return new MyAuthException();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if ($this->app->environment('local')) {
            Mail::alwaysTo('taylor@example.com'); // 이거 주소 env랑 똑같이 해야하나?
        }
    }
}
