<?php


namespace App\Models;



class AccessToken extends Model
{
    protected $primaryKey = 'token_value';
    protected $incrementing = false;
    protected $keyType = 'string';
}