<?php namespace App\Services;

use App\PERS\Contact;
use App\PERS\ContactInfo;
use App\PERS\ContactList;
use App\PERS\ContactListContactInfo;
use App\PERS\Customer;
use App\PERS\UserType;
use App\PERS\User;
use App\PERS\Util\PersException;
use DB;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:user',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array $data
	 * @return User
	 * @throws PersException
	 */
	public function create(array $data)
	{
		$success = true;
		$customer = Customer::get_customer_by_registration_code($data['code']);
		$user = new User();
		$user->forceFill([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'user_type_id' => UserType::$customer
		]);
		DB::transaction((function() use ($user, $customer, $success) {
			$success &= $user->save();
			if($success) {
				$customer->user_id = $user->id;
				$customer->registration_code = null;
				$customer->registration_expire = null;
				$success &= $customer->save();
			}
		}));
		if(!$success) {
			throw new PersException("Unable to register user successfully");
		}

		return $user;
	}

}
