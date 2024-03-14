<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->lPush("fruits", "apple");
echo("fruits length: {$redis->lLen("fruits")}\n");
$redis->rPush("fruits", "orange");
echo("fruits length: {$redis->lLen("fruits")}\n");
echo("vegetables length: {$redis->lLen("vegetables")}\n");
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
$redis->lPush("fruits", "plum");
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
$redis->rPush("fruits", "banana");
echo("fruits[03: {$redis->lIndex("fruits", 3)}\n");

echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
$redis->lPop("fruits");
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
$redis->rPop("fruits");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");

echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
$redis->lInsert("fruits", Redis::BEFORE, "apple", "pear");
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
$redis->lInsert("fruits", Redis::AFTER, "apple", "peach");
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
echo("fruits[3]: {$redis->lIndex("fruits", 3)}\n");

$redis->lSet("fruits", 2, "pineapple");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");

echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
echo("fruits[3]: {$redis->lIndex("fruits", 3)}\n");
echo("fruits[4]: {$redis->lIndex("fruits", 4)}\n");
print_r($redis->lRange("fruits", 1, 2));

echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
echo("fruits[3]: {$redis->lIndex("fruits", 3)}\n");
echo("fruits[4]: {$redis->lIndex("fruits", 4)}\n");
$redis->lTrim("fruits", 1, 2);
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");

$redis->rPush("fruits", "apple");
$redis->rPush("fruits", "apple");
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
echo("fruits[3]: {$redis->lIndex("fruits", 3)}\n");
echo("fruits[4]: {$redis->lIndex("fruits", 4)}\n");
$redis->lRem("fruits", "apple", 2);
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");

$redis->del("fruits");
