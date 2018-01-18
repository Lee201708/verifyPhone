<?php

class autoload_test
{
    public static function load($classname)
    {
        $filename = sprintf("%s.php",str_replace("\\", "/", $classname));
//        echo $filename;exit;
        if (file_exists($filename)) {
            require_once "$filename";
            if (class_exists($classname)) {
                return true;
            } else {
                return false;
            }
        }
    }
}


spl_autoload_register('autoload_test::load');