<?php

// $logFile = ['192.168.2.20 - - [28/Jul/2006:10:27:10 -0300] "GET /try/ HTTP/1.0" 200 3395',
// '127.0.0.1 - - [28/Jul/2006:10:22:04 -0300] "GET / HTTP/1.0" 200 2216',
// '127.0.0.1 - - [28/Jul/2006:10:27:32 -0300] "GET /hidden/ HTTP/1.0" 404 7218'];

$ip = [];
$code = [];

$length = count($logFile);


for($i = 0; $i < $length; $i++) {
    //extract ip address from text file
    if(preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $logFile[$i], $ip_matches)) {
        $ip[$i] = $ip_matches;
    }

    //extract error code from text file
    if(preg_match('/ 200 /', $logFile[$i], $ip_matches)) {
        $code[$i] = (int)$ip_matches;
    }
}


$ips = array_column($ip, 0);
$number = [0,0.5,0.5];

$reuturn = array_combine($ips, $number);

var_dump($code);
var_dump($reuturn);

