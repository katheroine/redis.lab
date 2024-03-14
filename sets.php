<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->sAdd("vegetables", "carrot");
$redis->sAdd("vegetables", "pepper");
print_r($redis->sMembers("vegetables"));
echo("vegetables quantity: {$redis->sCard("vegetables")}\n");

$redis->sAdd("vegetables", "tomato");
$redis->sAdd("vegetables", "potato");
print_r($redis->sMembers("vegetables"));
$redis->sAdd("garden", "carrot");
$redis->sAdd("garden", "tomato");
$redis->sAdd("garden", "cucumber");
print_r($redis->sMembers("garden"));
print_r($redis->sDiff("vegetables", "garden"));
$redis->sDiffStore("garden_vegetables", "vegetables", "garden");
print_r($redis->sMembers("garden_vegetables"));

print_r($redis->sMembers("vegetables"));
print_r($redis->sMembers("garden"));
print_r($redis->sInter("vegetables", "garden"));
$redis->sInterStore("no_garden_vegetables", "vegetables", "garden");
print_r($redis->sMembers("no_garden_vegetables"));

$redis->del("vegetables");
