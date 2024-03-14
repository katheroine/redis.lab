<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->hSet("person", "name", "Kathe");
$redis->hSet("person", "surname", "Roine");
$redis->hSet("person", "plang", "PHP");
echo("person name: {$redis->hGet("person", "name")}\n");
print_r($redis->hGetAll("person"));

echo("person length: {$redis->hLen("person")}\n");

echo(json_encode($redis->hExists("person", "plang")) . "\n");
echo(json_encode($redis->hExists("person", "unexistent-field")) . "\n");

$redis->hMSet("person", ["name" => "Mizu", "surname" => "Mitsu", "plang" => "Python"]);
print_r($redis->hMGet("person", ["name", "surname", "unexistent-field"]));

print_r($redis->hKeys("person"));
print_r($redis->hVals("person"));

$redis->hSet("person", "id", 1024);
echo("person id: {$redis->hGet("person", "id")}\n");
echo("person id: {$redis->hIncrBy("person", "id", 2)}\n");
echo("person id: {$redis->hGet("person", "id")}\n");

print_r($redis->hGetAll("person"));
echo($redis->hDel("person", "surname") . "\n");
echo($redis->hDel("person", "id") . "\n");
echo($redis->hDel("person", "unexistent-field") . "\n");
print_r($redis->hGetAll("person"));
