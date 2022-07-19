<?php

namespace App\Helpers;

class Helper
{
    public static function apiResponse(array $arr)
    {
        return dd($$arr);
    }

    public static function isValidUrl(string $url){
        //TODO : refine this function for better validation 
        return filter_var($url, FILTER_VALIDATE_URL);
    }
}