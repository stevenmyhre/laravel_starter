<?php namespace App\APP\Util;

use App\PERS\Customer;
use App\PERS\User;
use App\PERS\UserType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;

define('USER_IMPERSONATION', 'user_impersonation');
define('CUSTOMER_IMPERSONATION', 'customer_impersonation');

class Context
{
    private $customer;
    private $user;

    /**
     * @return null|Model|\App\PERS\Customer
     */
    public function customer()
    {
        if (!isset($this->customer)) {
            if ($this->is_impersonating_customer()) {
                $this->customer = $this->get_impersonating_customer() ?: null;
            } else {
                $this->customer = $this->user() ? $this->user()->customer : null;
            }
        }
        return $this->customer;
    }

    /**
     * @return null|Model|\App\PERS\User
     */
    public function user()
    {
        if(!isset($this->user))
        {
            $this->user = $this->get_user();
        }
        return $this->user;
    }

    public function isPowerUser()
    {
        return $this->is_admin() || $this->is_dealer();
    }

    public function is_admin()
    {
        return Auth::user() && Auth::user()->user_type_id == UserType::$admin;
    }

    public function is_dealer()
    {
        return Auth::user() && Auth::user()->user_type_id == UserType::$dealer;
    }

    public function is_currently_admin()
    {
        return !$this->is_impersonating() && $this->is_admin();
    }
    public function is_currently_dealer()
    {
        $impersonating = $this->is_impersonating();
        return (!$impersonating && $this->is_dealer())
        || ($impersonating && $this->is_impersonating_dealer());
    }
    public function is_currently_customer()
    {
        $impersonating = $this->is_impersonating();
        return (!$impersonating && $this->is_customer())
            || ($impersonating && $this->is_impersonating_customer());
    }

    public function impersonation_name()
    {
        if($this->is_impersonating_user())
            return $this->user()->name;
        if($this->is_impersonating_customer())
            return $this->customer()->full_name;
        throw new PersException("Not impersonating anyone");
    }

    public function is_customer()
    {
        return $this->user() && $this->user()->user_type_id == UserType::$customer;
    }

    public function is_impersonating_user()
    {
        return $this->isPowerUser()
            && Session::has(USER_IMPERSONATION);
    }

    public function is_impersonating_customer()
    {
        return $this->isPowerUser()
            && Session::has(CUSTOMER_IMPERSONATION);
    }

    public function is_impersonating_dealer()
    {
        return $this->is_impersonating_user() && $this->user()->user_type_id == UserType::$dealer;
    }

    public function is_impersonating()
    {
        return $this->is_impersonating_user() || $this->is_impersonating_customer();
    }

    public function impersonate_user($id)
    {
        if ($this->isPowerUser())
        {
            $this->clear_impersonation();
            Session::put(USER_IMPERSONATION, $id);
            return true;
        }
        return false;
    }

    public function impersonate_customer($id)
    {
        if ($this->isPowerUser())
        {
            $this->clear_impersonation();
            Session::put(CUSTOMER_IMPERSONATION, $id);
            return true;
        }
        return false;
    }

    public function clear_impersonation()
    {
        if (Session::has(USER_IMPERSONATION)) {
            Session::forget(USER_IMPERSONATION);
        }
        if (Session::has(CUSTOMER_IMPERSONATION)) {
            Session::forget(CUSTOMER_IMPERSONATION);
        }
    }

    public function redirect_to_user_page() {
        if( $this->is_currently_dealer())
            return Redirect::to(DEALER_HOME);
        if ($this->is_currently_customer())
            return Redirect::to(USER_HOME);
        if ($this->is_currently_admin())
            return Redirect::to(ADMIN_HOME);
        return Redirect::to('/');
    }

    private function get_user()
    {
        if ($this->is_impersonating_user()) {
            $id = Session::get(USER_IMPERSONATION);
            $usr = User::find($id);
            if ($usr)
                return $usr;
            else
            {
                $this->clear_impersonation();
                return null;
            }
        }
        return Auth::user();
    }

    private function get_impersonating_customer()
    {
        $id = Session::get(CUSTOMER_IMPERSONATION);
        if ($id && $id > 0) {
            $customer = Customer::find($id);
            if ($customer)
                return $customer;
            else
            {
                $this->clear_impersonation();
                return null;
            }
        }
        return $this->user()->customer();
    }
} 