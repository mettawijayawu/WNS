<?php
$logFile = "log/mylog.txt";
$ip = $_SERVER['REMOTE_ADDR'];
$uri = $_SERVER['REQUEST_URI'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$query = $_SERVER['QUERY_STRING'];
$time = date("Y-m-d H:i:s");

$post_data = json_encode($_POST); // kalau ada form

$log = "[$time] IP: $ip | URI: $uri | QUERY: $query | POST: $post_data | AGENT: $agent" . PHP_EOL;
file_put_contents($logFile, $log, FILE_APPEND);
?>
