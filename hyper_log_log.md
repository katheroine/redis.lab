# HyperLogLog

## What is the HyperLogLog?

The **HyperLogLog** is a probabilistic data structure available in Redis. It is used to estimate the number of distinct elements in a set or a stream of data.

As a probabilistic data structure, HyperLogLog trades perfect accuracy for efficiency in terms of memory usage. It provides an approximation of the cardinality (number of unique elements) of a set using a small, constant amount of memory.

The basic idea behind HyperLogLog is to use randomization to estimate the number of unique elements. It achieves this by hashing the elements and counting the number of leading zeros in the binary representation of the hash values. By analyzing the distribution of leading zeros, HyperLogLog can estimate the cardinality of the set.

Redis HyperLogLog is an algorithm that uses randomization to provide an approximation of the number of unique elements in a set using just a constant amount of memory. It is particularly useful in scenarios where you need to estimate the cardinality of large data sets with a low memory footprint.

Please note that HyperLogLog is a probabilistic data structure, which means that it can have an error rate of up to 0.81% with a large data set. However, it is still widely used in various applications where an approximate count of distinct elements is sufficient.

`PFADD key element [element ...]`

Adds the specified elements to the specified HyperLogLog.

`PFCOUNT key [key ...]`

Returns the approximated cardinality of the set(s) observed by the HyperLogLog at key(s).

`PFMERGE destkey sourcekey [sourcekey ...]`

Merges N different HyperLogLogs into a single one.

```bash
127.0.0.1:6379> PFADD programming_languages "C++"
(integer) 1
127.0.0.1:6379> PFADD programming_languages "Java" "C#"
(integer) 1
127.0.0.1:6379> PFADD programming_languages "Perl" "PHP" "Ruby" "Python"
(integer) 1
127.0.0.1:6379> PFCOUNT programming_languages
(integer) 7
127.0.0.1:6379> PFADD scripting_languages "Perl" "PHP" "Ruby" "Python"
(integer) 1
127.0.0.1:6379> PFCOUNT scripting_languages
(integer) 4
127.0.0.1:6379> PFMERGE languages programming_languages scripting_languages
OK
127.0.0.1:6379> PFCOUNT languages
(integer) 7
```

```php
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
```

```bash
programming languages cardinality: 7
script languages cardinality: 4
languages cardinality: 7
```
