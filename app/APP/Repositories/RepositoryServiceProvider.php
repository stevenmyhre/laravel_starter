<?php namespace App\APP\Repositories;

use Context;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

   // protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->singleton('App\APP\Repositories\Admin\IEventCodeRepository', 'App\APP\Repositories\Admin\EventCodeRepository');
    }

    public function provides()
    {
        return array(

        );
    }
}