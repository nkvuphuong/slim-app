<?php


namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    protected $primaryKey = 'token_value';
    public $incrementing = false;
    protected $keyType = 'string';
}