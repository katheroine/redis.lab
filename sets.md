# Sets

`SADD key member1 [member2]`

Adds one or more members to a set.

`SISMEMBER key member`

Determines if a given value is a member of a set.

`SMEMBERS key`

Gets all the members in a set.

`SCARD key`

Gets the number of members in a set.

```bash
127.0.0.1:6379> SADD vegetables "carrot"
(integer) 1
127.0.0.1:6379> SADD vegetables "pepper"
(integer) 1
127.0.0.1:6379> SMEMBERS vegetables
1) "carrot"
2) "pepper"
127.0.0.1:6379> SCARD vegetables
(integer) 2
```

```php
<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->sAdd("vegetables", "carrot");
$redis->sAdd("vegetables", "pepper");
print_r($redis->sMembers("vegetables"));
echo("vegetables quantity: {$redis->sCard("vegetables")}\n");
```

```bash
Array
(
    [0] => carrot
    [1] => pepper
)
vegetables quantity: 2
```

`SDIFF key1 [key2]`

Subtracts multiple sets.

`SDIFFSTORE destination key1 [key2]`

Subtracts multiple sets and stores the resulting set in a key.

```bash
127.0.0.1:6379> SADD vegetables "tomato"
(integer) 1
127.0.0.1:6379> SADD vegetables "potato"
(integer) 1
127.0.0.1:6379> SMEMBERS vegetables
1) "carrot"
2) "pepper"
3) "tomato"
4) "potato"
127.0.0.1:6379> SADD garden "carrot"
(integer) 1
127.0.0.1:6379> SADD garden "tomato"
(integer) 1
127.0.0.1:6379> SADD garden "cucumber"
(integer) 1
127.0.0.1:6379> SMEMBERS garden
1) "carrot"
2) "tomato"
3) "cucumber"
127.0.0.1:6379> SDIFF vegetables garden
1) "pepper"
2) "potato"
127.0.0.1:6379> SDIFFSTORE garden_vegetables vegetables garden
(integer) 2
127.0.0.1:6379> SMEMBERS garden_vegetables
1) "pepper"
2) "potato"
```

```php
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
```

```bash
Array
(
    [0] => carrot
    [1] => pepper
    [2] => tomato
    [3] => potato
)
Array
(
    [0] => carrot
    [1] => tomato
    [2] => cucumber
)
Array
(
    [0] => pepper
    [1] => potato
)
Array
(
    [0] => pepper
    [1] => potato
)
```

`SPOP key`

Removes and returns a random member from a set.

`SINTER key1 [key2]`

Intersects multiple sets.

`SINTERSTORE destination key1 [key2]`

Intersects multiple sets and stores the resulting set in a key.

```bash
127.0.0.1:6379> SMEMBERS vegetables
1) "carrot"
2) "pepper"
3) "tomato"
4) "potato"
127.0.0.1:6379> SMEMBERS garden
1) "carrot"
2) "tomato"
3) "cucumber"
127.0.0.1:6379> SINTER vegetables garden
1) "carrot"
2) "tomato"
127.0.0.1:6379> SINTERSTORE no_garden_vegetables vegetables garden
(integer) 2
127.0.0.1:6379> SMEMBERS no_garden_vegetables
1) "carrot"
2) "tomato"
```

```php
print_r($redis->sMembers("vegetables"));
print_r($redis->sMembers("garden"));
print_r($redis->sInter("vegetables", "garden"));
$redis->sInterStore("no_garden_vegetables", "vegetables", "garden");
print_r($redis->sMembers("no_garden_vegetables"));
```

```bash
Array
(
    [0] => carrot
    [1] => pepper
    [2] => tomato
    [3] => potato
)
Array
(
    [0] => carrot
    [1] => tomato
    [2] => cucumber
)
Array
(
    [0] => carrot
    [1] => tomato
)
Array
(
    [0] => carrot
    [1] => tomato
)
```

`SUNION key1 [key2]`

Adds multiple sets.

`SUNIONSTORE destination key1 [key2]`

Adds multiple sets and stores the resulting set in a key.

```bash
127.0.0.1:6379> SMEMBERS vegetables
1) "carrot"
2) "pepper"
3) "tomato"
4) "potato"
127.0.0.1:6379> SMEMBERS garden
1) "carrot"
2) "tomato"
3) "cucumber"
127.0.0.1:6379> SUNIONSTORE garden_and_vegetables vegetables garden
(integer) 5
127.0.0.1:6379> SMEMBERS garden_and_vegetables
1) "carrot"
2) "pepper"
3) "tomato"
4) "potato"
5) "cucumber"
```

`SMOVE source destination member`

Moves a member from one set to another.

`SRANDMEMBER key [count]`

Gets one or multiple random members from a set.

`SREM key member1 [member2]`

Removes one or more members from a set.

`SSCAN key cursor [MATCH pattern] [COUNT count]`

Incrementally iterates set elements.
