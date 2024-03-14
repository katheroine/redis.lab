# Sorted Sets

`ZADD key score1 member1 [score2 member2]`

Adds one or more members to a sorted set, or updates its score, if it already exists.

`ZCARD key`

Gets the number of members in a sorted set.

`ZCOUNT key min max`

Counts the members in a sorted set with scores within the given values.

`ZLEXCOUNT key min max`

Counts the number of members in a sorted set between a given lexicographical range.

`ZRANGE key start stop [WITHSCORES]`

Returns a range of members in a sorted set, by index.

`ZRANGEBYLEX key min max [LIMIT offset count]`

Returns a range of members in a sorted set, by lexicographical range.

`ZRANGEBYSCORE key min max [WITHSCORES] [LIMIT]`

Returns a range of members in a sorted set, by score.

```bash
127.0.0.1:6379> ZADD ingredients 0 "flour"
(integer) 1
127.0.0.1:6379> ZADD ingredients 1 "sugar"
(integer) 1
127.0.0.1:6379> ZADD ingredients 4 "eggs"
(integer) 1
127.0.0.1:6379> ZCOUNT ingredients 0 10
(integer) 3
127.0.0.1:6379> ZCARD ingredients
(integer) 3
127.0.0.1:6379> ZRANGE ingredients 0 10
1) "flour"
2) "sugar"
3) "eggs"
127.0.0.1:6379> ZRANGE ingredients 0 10 WITHSCORES
1) "flour"
2) "0"
3) "sugar"
4) "1"
5) "eggs"
6) "4"
```

```php
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
```

```bash
ingredients quantity: 3
ingredients quantity: 3
Array
(
    [0] => flour
    [1] => eggs
    [2] => sugar
)
Array
(
    [flour] => 0
    [eggs] => 1
    [sugar] => 1
)
```

`ZSCORE key member`

Gets the score associated with the given member in a sorted set.

`ZRANK key member`

Determines the index of a member in a sorted set.

`ZREVRANK key member`

Determines the index of a member in a sorted set, with scores ordered from high to low.

```bash
127.0.0.1:6379> ZSCORE ingredients "sugar"
"1"
127.0.0.1:6379> ZSCORE ingredients "eggs"
"4"
127.0.0.1:6379> ZRANK ingredients "sugar"
(integer) 1
127.0.0.1:6379> ZRANK ingredients "eggs"
(integer) 2
127.0.0.1:6379> ZREVRANK ingredients "sugar"
(integer) 1
127.0.0.1:6379> ZREVRANK ingredients "eggs"
(integer) 0
```

```php
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
```

```bash
ingredients quantity: 3
ingredients quantity: 3
Array
(
    [0] => flour
    [1] => eggs
    [2] => sugar
)
Array
(
    [flour] => 0
    [eggs] => 1
    [sugar] => 1
)
ingredients "sugar" score: 1
ingredients "eggs" score: 1
ingredients "sugar" rank: 2
ingredients "eggs" rank: 1
ingredients "sugar" reverse rank: 0
ingredients "eggs" reverse rank: 1
```

`ZINCRBY key increment member`

Increments the score of a member in a sorted set.

```bash
127.0.0.1:6379> ZINCRBY ingredients 3 "sugar"
"4"
127.0.0.1:6379> ZSCORE ingredients "sugar"
"4"
127.0.0.1:6379> ZRANK ingredients "sugar"
(integer) 2
127.0.0.1:6379> ZREVRANK ingredients "sugar"
(integer) 0
```

```php
$redis->zIncrBy("ingredients", 3, "sugar");
echo("ingredients \"sugar\" score: {$redis->zScore("ingredients", "sugar")}\n");
echo("ingredients \"sugar\" rank: {$redis->zRank("ingredients", "sugar")}\n");
echo("ingredients \"sugar\" reverse rank: {$redis->zRevRank("ingredients", "sugar")}\n");
```

```bash
ingredients "sugar" score: 4
ingredients "sugar" rank: 2
ingredients "sugar" reverse rank: 0
```

`ZREVRANGE key start stop [WITHSCORES]`

Returns a range of members in a sorted set, by index, with scores ordered from high to low.

`ZREVRANGEBYSCORE key max min [WITHSCORES]`

Returns a range of members in a sorted set, by score, with scores ordered from high to low.

`ZREM key member [member ...]`

Removes one or more members from a sorted set.

`ZREMRANGEBYLEX key min max`

Removes all members in a sorted set between the given lexicographical range.

`ZREMRANGEBYRANK key start stop`

Removes all members in a sorted set within the given indexes.

`ZREMRANGEBYSCORE key min max`

Removes all members in a sorted set within the given scores.

`ZINTERSTORE destination numkeys key [key ...]`

Intersects multiple sorted sets and stores the resulting sorted set in a new key.

`ZUNIONSTORE destination numkeys key [key ...]`

Adds multiple sorted sets and stores the resulting sorted set in a new key.

`ZSCAN key cursor [MATCH pattern] [COUNT count]`

Incrementally iterates sorted sets elements and associated scores.
