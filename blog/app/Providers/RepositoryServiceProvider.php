<?php

namespace Blog\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Blog\Repositories\ProjectRepository::class, \Blog\Repositories\ProjectRepositoryEloquent::class);
        $this->app->bind(\Blog\Repositories\ProjectNoteRepository::class, \Blog\Repositories\ProjectNoteRepositoryEloquent::class);
        //:end-bindings:
    }
}
