<?php


namespace App\Repositories\Eloquent;


use App\Models\Auth;
use App\Repositories\Contracts\AuthInterface;

class AuthRepository extends Repository implements AuthInterface
{
    /**
     * @inheritDoc
     */
    function model()
    {
        return Auth::class;
    }
}