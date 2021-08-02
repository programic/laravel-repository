<?php

namespace Programic\Repository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            Commands\MakeRepositoryCommand::class,
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Repository::class, function ($app) {
            return new Repository($app);
        });

        $this->app->alias(Repository::class, 'repository');
    }
}
