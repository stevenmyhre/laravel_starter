<?php  namespace App\APP\Facades;
use Illuminate\Support\ServiceProvider;

/**
 * User: Steven
 * Date: 6/16/14
 * Time: 9:40 PM
 */
class FacadeServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('context', 'App\PERS\Util\Context');
    }

    public function provides()
    {
        return array('context');
    }
}