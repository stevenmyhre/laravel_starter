<?php  namespace App\APP\Repositories\Admin;
use App\PERS\Repositories\IUserRepository;
use App\PERS\User;
use DB;

class UserRepository implements IUserRepository {

    /**
     * @return User[]
     */
    public function getList()
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

    /**
     * @param $id
     * @return User
     */
    public function find($id)
    {
        return User::with('user_type', 'customer')->find($id);
    }
}