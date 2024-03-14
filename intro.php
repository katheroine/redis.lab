<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
echo("Connection to server sucessfully\n");
echo("Server is running: {$redis->ping()}\n");
