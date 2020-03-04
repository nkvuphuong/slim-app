<?php


namespace App\Models;



class AccessToken extends Model
{
    protected $primaryKey = 'token_value';
    public $incrementing = false;
    protected $keyType = 'string';
}