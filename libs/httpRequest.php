<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/17
 * Time: 16:02
 */
namespace libs;

class httpRequest
{
    public static function request($url, $params, $method='GET')
    {
        $response = null;
        if ($url) {
            $method = strtoupper($method);
            if ($method == "POST") {

            } else {
                if (is_array($params) && count($params)) {
                    if (strrpos($url, '?')) {
                        $url = $url . '&' . http_build_query($params);
                    } else {
                        $url = $url . '?' . http_build_query($params);
                    }
                }
                $response = file_get_contents($url);
            }
        }
        return $response;
    }
}