<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->pfAdd("programming_languages", ["C++"]);
$redis->pfAdd("programming_languages", ["Java", "C#"]);
$redis->pfAdd("programming_languages", ["Perl", "PHP", "Ruby", "Python"]);
echo("programming languages cardinality: {$redis->pfCount("programming_languages")}\n");
$redis->pfAdd("script_languages", ["Perl", "PHP", "Ruby", "Python"]);
echo("script languages cardinality: {$redis->pfCount("script_languages")}\n");
$redis->pfMerge("languages", ["programming_languages", "script_languages"]);
echo("languages cardinality: {$redis->pfCount("languages")}\n");

$redis->del("programming_languages");
$redis->del("script_languages");
$redis->del("languages");
