<?php namespace App\APP;

use Illuminate\Auth\Authenticatable;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;

/**
 * App\APP\User
 *
 * @property integer $id 
 * @property string $name 
 * @property string $email 
 * @property string $password 
 * @property string $remember_token 
 * @property integer $user_type_id 
 * @property integer $owning_dealer_id 
 * @property \Carbon\Carbon $last_login 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \App\PERS\UserType $user_type 
 * @property-read \App\PERS\Customer $customer 
 * @property-read \App\PERS\Dealer $dealer 
 * @property-read \Illuminate\Database\Eloquent\Collection|\$related[] $morphedByMany 
 * @method static \Illuminate\Database\Query\Builder|\App\PERS\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PERS\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PERS\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PERS\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PERS\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PERS\User whereUserTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PERS\User whereOwningDealerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PERS\User whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PERS\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PERS\User whereUpdatedAt($value)
 */
class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['last_login'];


    public function user_type()
    {
        return $this->belongsTo('App\PERS\UserType');
    }

    public function customer()
    {
        return $this->hasOne('App\PERS\Customer');
    }

    public function dealer()
    {
        return $this->hasOne('App\PERS\Dealer');
    }

    public static function all_users()
    {
        return DB::table('user')
            ->join('user_type', 'user_type.id', '=', 'user.user_type_id')
            ->leftJoin('customer', 'customer.user_id', '=', 'user.id')
            ->leftJoin('dealer', 'dealer.user_id', '=', 'user.id')
            ->select(array(
                'user.id',
                'user_type.user_type_name',
                'user.name',
                'user.email',
                'user.updated_at',
                'customer.id as customer_id',
                'customer.full_name',
                'customer.account_number',
                'dealer.id as dealer_id',
                'dealer.name as dealer_name'
                )
            );
    }
}
