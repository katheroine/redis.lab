<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->publish('infoway', "Hi, there!");
sleep(5);
$redis->publish('infoway', "Hello, world!");
sleep(5);

$redis->close();
