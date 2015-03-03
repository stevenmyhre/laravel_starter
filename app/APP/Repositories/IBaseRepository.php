<?php  namespace App\APP\Repositories;
use Illuminate\Database\Eloquent\Model;

interface IBaseRepository {

    /**
     * @return Model[]
     */
    public function getList();

    /**
     * @param $id
     * @return Model
     */
    public function find($id);
} 