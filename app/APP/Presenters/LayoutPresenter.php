<?php  namespace App\APP\Presenters;
use Context;

class LayoutPresenter {
    public function compose($view)
    {
        $homeUrl = Context::is_currently_dealer() ? DEALER_HOME :
            (Context::is_currently_admin() ? ADMIN_HOME : USER_HOME);

        $view->with('homeUrl', $homeUrl);
    }
}