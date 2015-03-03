<?php  namespace App\APP\Repositories;
use App\PERS\User;

interface IUserRepository {
    /**
     * @return \Illuminate\Database\Query\Builder|User[]
     */
    public function getList();

    /**
     * @param $id
     * @return User
     */
    public function find($id);
}