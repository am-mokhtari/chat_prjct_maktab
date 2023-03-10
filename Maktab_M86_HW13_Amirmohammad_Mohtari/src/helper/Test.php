<?php
namespace src\helper;

class Test{

    public static function print($value)
    {
        echo "<br><pre>".
        var_dump($value).
        "<pre><br>";
        die();
    }
}
