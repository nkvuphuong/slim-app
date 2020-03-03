<?php


namespace App\Helpers;


class PhoneHelper
{
    static function formatUs($phoneNumber)
    {
        return preg_replace('/^(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4})/', '($1) $2-$3', $phoneNumber);
    }

    static function clear($phoneNumber)
    {
        return preg_replace('/\D/', '', $phoneNumber);
    }
}