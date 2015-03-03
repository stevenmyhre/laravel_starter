<?php  namespace App\APP\Services;
use Illuminate\Support\ServiceProvider;

/**
 * User: Steven
 * Date: 6/27/14
 * Time: 8:41 PM
 */
class ServicesServiceProvider extends ServiceProvider {

     protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->singleton('App\APP\Services\ITaxCodeService', 'App\APP\Services\TaxCodeService');
    }

    public function provides()
    {
        return array(

        );
    }
}