<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->set("counter", "1024");
echo("counter: {$redis->get("counter")}\n");

echo("counter: {$redis->incr("counter")}\n");
echo("counter: {$redis->get("counter")}\n");
echo("counter: {$redis->decr("counter")}\n");
echo("counter: {$redis->get("counter")}\n");

echo("counter: {$redis->incrBy("counter", 5)}\n");
echo("counter: {$redis->get("counter")}\n");
echo("counter: {$redis->decrBy("counter", 3)}\n");
echo("counter: {$redis->get("counter")}\n");

