<?php

namespace src;

class Request
{
    public static function getPath(){
        $path = $_SERVER['REQUEST_URI'] ?? '';
        $pos = strpos($path , '?');
        if ($pos === false){
            return $path;
        }
        return substr($path , 0 , $pos);
    }

    public static function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}