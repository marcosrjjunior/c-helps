<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\QuestionRepositoryInterface',
            'App\Repositories\QuestionRepository'
        );

        $this->app->bind(
            'App\Repositories\AnswerRepositoryInterface',
            'App\Repositories\AnswerRepository'
        );

        $this->app->bind(
            'App\Repositories\TagRepositoryInterface',
            'App\Repositories\TagRepository'
        );
    }
}
