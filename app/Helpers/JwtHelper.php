<?php


namespace App\Helpers;


use Firebase\JWT\JWT;

class JwtHelper
{
    /**
     * @param $payload
     * @return string
     */
    static function generate($payload)
    {
        return JWT::encode($payload, getenv('JWT_SECRET'));
    }
}