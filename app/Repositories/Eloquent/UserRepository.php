<?php


namespace App\Repositories\Eloquent;


use App\Models\User;
use App\Repositories\Contracts\UserInterface;

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