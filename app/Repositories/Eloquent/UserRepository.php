<?php


namespace App\Repositories\Eloquent;


use App\Models\User;
use App\Repositories\Contracts\UserInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends Repository implements UserInterface
{
    /**
     * @inheritDoc
     */
    function model()
    {
        return User::class;
    }
}