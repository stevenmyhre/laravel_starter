<?php namespace App\Http\Requests;

use App\PERS\Customer;
use Carbon\Carbon;
use Illuminate\Http\Response;

class UserRegisterRequest extends Request {

    public function rules()
    {
        return []; // rules are in the Registrar
    }

    public function authorize()
    {
        if(!$this->code)
            return false;
        $customer = Customer::get_customer_by_registration_code($this->code);
        if(!$customer || !$customer->registration_expire)
            return false;
        $expired = new Carbon($customer->registration_expire) < new Carbon();
        if($expired)
            return false;
        return $customer->registration_code == $this->code;
    }

    public function forbiddenResponse()
    {
        return new Response('Forbidden - the registration code provided is either expired or invalid.', 403);
    }


}