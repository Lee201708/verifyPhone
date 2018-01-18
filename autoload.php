<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/17
 * Time: 15:32
 */

class autoload
{
    public static function load($classname)
    {
        $filename = sprintf('%s.php', str_replace('\\', '/', $classname));
        if (is_file($filename)) {
            require_once "$filename";
        }
    }
}

spl_autoload_register(array('autoload','load'));