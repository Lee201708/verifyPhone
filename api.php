<?php
header("Content-type:text/html;charset=utf-8;");
require_once "autoload.php";


$phone = isset($_POST['tel']) ? $_POST['tel'] : null;

$info = app\QueryPhone::query($phone);

$data = array();
if (!isset($info["status"])) {
    $data = $info;
    $data['code'] = 200;
} else {
    $data['msg'] =  $info["msg"];
    $data['code'] = 400;
}
echo json_encode($data);