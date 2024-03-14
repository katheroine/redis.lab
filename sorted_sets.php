<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->zAdd("ingredients", 0, "flour");
$redis->zAdd("ingredients", 1, "sugar");
$redis->zAdd("ingredients", 1, "eggs");
echo("ingredients quantity: {$redis->zCount("ingredients", 0, 10)}\n");
echo("ingredients quantity: {$redis->zCard("ingredients")}\n");
print_r($redis->zRange("ingredients", 0, 10));
print_r($redis->zRange("ingredients", 0, 10, true));

echo("ingredients \"sugar\" score: {$redis->zScore("ingredients", "sugar")}\n");
echo("ingredients \"eggs\" score: {$redis->zScore("ingredients", "eggs")}\n");
echo("ingredients \"sugar\" rank: {$redis->zRank("ingredients", "sugar")}\n");
echo("ingredients \"eggs\" rank: {$redis->zRank("ingredients", "eggs")}\n");
echo("ingredients \"sugar\" reverse rank: {$redis->zRevRank("ingredients", "sugar")}\n");
echo("ingredients \"eggs\" reverse rank: {$redis->zRevRank("ingredients", "eggs")}\n");

$redis->zIncrBy("ingredients", 3, "sugar");
echo("ingredients \"sugar\" score: {$redis->zScore("ingredients", "sugar")}\n");
echo("ingredients \"sugar\" rank: {$redis->zRank("ingredients", "sugar")}\n");
echo("ingredients \"sugar\" reverse rank: {$redis->zRevRank("ingredients", "sugar")}\n");

$redis->del("ingredients");
