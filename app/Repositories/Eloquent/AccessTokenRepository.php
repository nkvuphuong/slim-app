<?php


namespace App\Repositories\Eloquent;


use App\Models\AccessToken;
use App\Repositories\Contracts\AccessTokenInterface;

class AccessTokenRepository extends Repository implements AccessTokenInterface
{

    /**
     * @inheritDoc
     */
    function model()
    {
        return AccessToken::class;
    }
}