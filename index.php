<?php
require 'vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__)->load();
$redis = new Redis();
$redis->connect($_ENV['REDIS_URL'], $_ENV['REDIS_PORT']);
if($_ENV['REDIS_PASSWORD']){
    $redis->auth($_ENV['REDIS_PASSWORD']);
}
$max_calls_limit  = $_ENV['MAX_CALLS_LIMIT'];
$time_period      = $_ENV['TIME_PERIOD'];
$user_calls = 0;

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $user_address = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $user_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $user_address = $_SERVER['REMOTE_ADDR'];
}

if (!$redis->exists($user_address)) {
    $redis->set($user_address, 1);
    $redis->expire($user_address, $time_period);
    $user_calls = 1;
} else {
    $redis->INCR($user_address);
    $user_calls = $redis->get($user_address);
    if ($user_calls > $max_calls_limit) {
        echo "User " . $user_address . " limit exceeded.";
        exit();
    }
}

echo "Client " . $user_address . " calls made " . $user_calls . " in " . $time_period . " seconds";