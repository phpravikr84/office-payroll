<?php

namespace App\Helpers;

class CommonHelper
{
    public static function getCurrentDateTime()
    {
        return date('Y-m-d H:i:s');
    }

    public static function getCurrentDate()
    {
        return date('Y-m-d');
    }

    public static function getCurrentTime()
    {
        return date('H:i:s');
    }

    public static function formatDate($date, $format = 'Y-m-d')
    {
        return date($format, strtotime($date));
    }

    public static function str_split($string, $length = 1)
    {
        return str_split($string, $length);
    }
}