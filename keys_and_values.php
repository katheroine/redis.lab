<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->set("nickname", "katheroine");
echo("nickname: {$redis->get("nickname")}\n");
echo($redis->exists("nickname") . "\n");
echo($redis->exists("nonexistent") . "\n");

echo("nickname: {$redis->getSet("nickname", "mizumitsu")}\n");
echo("nickname: {$redis->get("nickname")}\n");

$redis->delete("notpreviouslyexisted");
var_dump($redis->setnx("notpreviouslyexisted", 5));
var_dump($redis->setnx("notpreviouslyexisted", 3));
echo("notpreviouslyexisted: {$redis->get("notpreviouslyexisted")}\n");

$redis->mSet(["name" => "Miko", "nickname" => "mikotetsu"]);
print_r($redis->mGet(["name", "surname", "nickname"]));

echo("nickname: {$redis->get("nickname")}\n");
$redis->rename("nickname", "nick");
echo("nick: {$redis->get("nick")}\n");
echo("nickname: {$redis->get("nickname")}\n");

var_dump($redis->setex("volatile", 3, "moment"));
echo("volatile: {$redis->get("volatile")}\n");
sleep(4);
echo("volatile: {$redis->get("volatile")}\n");

$redis->set("limited", "moment");
echo("limited: {$redis->get("limited")}\n");
echo("ttl: {$redis->ttl("limited")}\n");
$redis->expire("limited", 10);
sleep(2);
echo("ttl: {$redis->ttl("limited")}\n");
echo("limited: {$redis->get("limited")}\n");
sleep(6);
echo("ttl: {$redis->ttl("limited")}\n");
sleep(3);
echo("ttl: {$redis->ttl("limited")}\n");
echo("limited: {$redis->get("limited")}\n");

echo("nick: {$redis->get("nick")}\n");
$redis->delete("nick");
echo("nick: {$redis->get("nick")}\n");

echo("random key: {$redis->randomKey("nick")}\n");
