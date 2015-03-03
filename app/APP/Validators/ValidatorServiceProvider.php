<?php  namespace App\APP\Validators;
use Illuminate\Support\ServiceProvider;

/**
 * User: Steven
 * Date: 6/16/14
 * Time: 10:26 PM
 */
class ValidatorServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() { }

    public function boot()
    {
//        $this->app->validator->resolver(function($translator, $data, $rules, $messages) {
//            return new NotificationValidator($translator, $data, $rules, $messages);
//        });
    }
}