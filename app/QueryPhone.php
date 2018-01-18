<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 2017/10/17
 * Time: 15:28
 */
namespace app;
use libs\httpRequest;
header('content-type:text/html;charset=utf-8');
class QueryPhone
{

    const TAOBAO_API = "https://tcc.taobao.com/cc/json/mobile_tel_segment.htm";

    public static function query($phone)
    {
        $res = self::verifyPhone($phone);
        if ($res["status"]) {
            $response = httpRequest::request(self::TAOBAO_API,array("tel" => $phone));
            $data = self::formatDate($response);
            $res = $data;
        }
        return $res;
    }

    /*
     * 验证手机的合法性
     *
     * */
    public static function verifyPhone($phone = null)
    {
        $ret = array();
        if ($phone) {
           if (preg_match('/^1[34578]{1}\d{9}/', $phone)) {
               $ret["status"] = true;
           } else {
               $ret["msg"] = "请输入正确的手机号";
               $ret["status"] = false;
           }
        } else {
            $ret["status"] = false;
            $ret["msg"] = "请输入手机号码";

        }
        return $ret;
    }
    /*
     * 格式化API请求回来的数据
     *
     * */
    public static function formatDate($data = null)
    {
        $ret = false;
        $datas = array();
        if ($data) {
            preg_match_all("/(\w+):'([^']+)/", $data, $res);
            $ret = array_combine($res[1],$res[2]);

            //获取编码方式
            $encode = mb_detect_encoding($ret['province'],array("ASCII","UTF-8","GB2312","GBK"));
            
            foreach ($ret as $key => $value) {
                $datas[$key] = iconv($encode, 'utf-8', $value);
            }
//            $datas["status"] = 200;
            $ret = $datas;
        }
        return $ret;
    }
}