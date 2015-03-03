<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use Context;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers {
		getRegister as getRegisterParent;
	}

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => array('getLogout', 'getUnimpersonate')]);
	}

	public function getRegister(UserRegisterRequest $request)
	{
		if (is_null($request->code))
		{
			throw new NotFoundHttpException;
		}
		return view('auth.register')->with('code', $request->code);
	}

	public function postRegister(UserRegisterRequest $request)
	{
		$validator = $this->registrar->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		$this->auth->login($this->registrar->create($request->all()));

		return redirect("/?first_login=1");
	}

	public function getUnimpersonate()
	{
		Context::clear_impersonation();
		return Context::redirect_to_user_page();
	}

	public function getLogout()
	{
		Context::clear_impersonation();
		$this->auth->logout();

		return redirect('/auth/login');
	}

	public function redirectPath()
	{
		return property_exists($this, 'redirectTo') ? $this->redirectTo : Context::redirect_to_user_page()->getTargetUrl();
	}



}
