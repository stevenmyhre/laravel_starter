<?php namespace App\APP;



/**
 * App\APP\UserType
 *
 * @property integer $id 
 * @property string $user_type_name 
 * @property-read \Illuminate\Database\Eloquent\Collection|\$related[] $morphedByMany 
 * @method static \Illuminate\Database\Query\Builder|\App\PERS\UserType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PERS\UserType whereUserTypeName($value)
 */
class UserType extends BaseModel {
	protected $table = 'user_type';

    public static $admin = 1;
    public static $customer = 2;
    public static $dealer = 3;
}