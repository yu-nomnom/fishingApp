<?php

namespace App\Providers;

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
        $this->app->bind(
            \App\Repositories\Interfaces\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class,
        );
        $this->app->bind(
            \App\Repositories\Interfaces\FieldRepositoryInterface::class,
            \App\Repositories\FieldRepository::class,
        );
        $this->app->bind(
            \App\Repositories\Interfaces\DiaryRepositoryInterface::class,
            \App\Repositories\DiaryRepository::class
        );
        $this->app->bind(
            \App\Repositories\Interfaces\FishResultRepositoryInterface::class,
            \App\Repositories\FishResultRepositoryInterface::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
