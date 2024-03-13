<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->set("nickname", "mizumitsu");
echo("nickname: {$redis->get("nickname")}\n");

echo("nickname length: {$redis->strLen("nickname")}\n");

echo("nickname: {$redis->get("nickname")}\n");
echo("nickname part: {$redis->getRange("nickname", 2, 5)}\n");
echo($redis->setRange("nickname", 2, "kote") . "\n");
echo("nickname: {$redis->get("nickname")}\n");

echo("nickname: {$redis->get("nickname")}\n");
echo("nickname bit: {$redis->getBit("nickname", 2)}\n");
echo($redis->setBit("nickname", 2, 0) . "\n");
echo("nickname: {$redis->get("nickname")}\n");
echo("nickname bit: {$redis->getBit("nickname", 2)}\n");

$redis->set("nickname", "mizu");
echo("nickname: {$redis->get("nickname")}\n");
echo($redis->append("nickname", "mitsu") . "\n");
echo("nickname: {$redis->get("nickname")}\n");
