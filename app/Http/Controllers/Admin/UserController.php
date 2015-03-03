<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Shared\BaseUserController;
use App\PERS\Repositories\Admin\UserRepository;

class UserController extends BaseUserController {

    public function __construct(UserRepository $userRepository){
        parent::__construct($userRepository);
    }


}