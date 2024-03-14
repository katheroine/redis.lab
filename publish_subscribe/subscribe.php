<?php

// ini_set('default_socket_timeout', -1);

$redis = new Redis();
$redis->setOption (Redis::OPT_READ_TIMEOUT, -1);
$redis->connect('127.0.0.1', 6379);

function output_message($redis, $channel, $message) {
	switch($channel) {
		case 'infoway':
			echo($message . PHP_EOL);
			break;
	}
}

$redis->subscribe(['infoway'], 'output_message');

$redis->close();
