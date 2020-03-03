<?php


namespace App\Helpers;


class AuthHelper
{
    /**
     * @param $password
     * @param $salt
     * @return string
     */
    static function hashPassword($password, $salt)
    {
        return md5(md5($salt) . md5($password));
    }
}