<?php namespace App\Handlers\Events;

use App\PERS\User;
use Carbon\Carbon;

class AuthLogin {

	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  auth.login  $event
	 * @return void
	 */
	public function handle(User $user)
	{
        $user->last_login = new Carbon;
        $user->save();
	}

}
