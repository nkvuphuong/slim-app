<?php


namespace App\Models;


use App\Helpers\JwtHelper;

class Auth
{
    /**
     * @param $username
     * @return string
     */
    public function login($username)
    {
        //Create access token
        $tokenData = [
            'username' => $username,
            'iat' => time(),
            'exp' => time() + (3600 * 2 * 30)
        ];

        $accessToken = JwtHelper::generate($tokenData);

        $insertAccessToken = [
            'token_value' => $accessToken,
            'username' => $username,
            'token_created_at' => $tokenData['iat'],
            'token_expired_at' => $tokenData['exp'],
            'token_ip' => $_SERVER['REMOTE_ADDR'],
        ];

        dd($insertAccessToken);

        return $accessToken;
    }
}