<?php

function  getIPAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $file = file_get_contents("php://input");
  $ip = getIPAddress();
  $ip = str_replace(".", "-", $ip);
  $date = $ip."-".date("Y-m-d-H-i-s");
  file_put_contents("result-".$date.".jpg", $file);
}

?>
