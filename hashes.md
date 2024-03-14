# Hashes

`HSET key field value`

Sets the string value of a hash field.

`HGET key field`

Gets the value of a hash field stored at the specified key.

`HGETALL key`

Gets all the fields and values stored in a hash at the specified key

```bash
127.0.0.1:6379> HSET person name "Kathe" surname "Roine" plang PHP
(integer) 3
127.0.0.1:6379> HGET person name
"Kathe"
127.0.0.1:6379> HGETALL person
1) "name"
2) "Kathe"
3) "surname"
4) "Roine"
5) "plang"
6) "PHP"
```

```php
<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->hSet("person", "name", "Kathe");
$redis->hSet("person", "surname", "Roine");
$redis->hSet("person", "plang", "PHP");
echo("person name: {$redis->hGet("person", "name")}\n");
print_r($redis->hGetAll("person"));
```

```bash
person name: Kathe
Array
(
    [name] => Kathe
    [surname] => Roine
    [plang] => PHP
)
```

`HLEN key`

Gets the number of fields in a hash.

```bash
127.0.0.1:6379> HLEN person
(integer) 3
```

```php
echo("person length: {$redis->hLen("person")}\n");
```

```bash
person length: 3
```

`HEXISTS key field`

Determines whether a hash field exists or not.

```bash
127.0.0.1:6379> HEXISTS person plang
(integer) 1
127.0.0.1:6379> HEXISTS person unexistent-field
(integer) 0
```

```php
echo(json_encode($redis->hExists("person", "plang")) . "\n");
echo(json_encode($redis->hExists("person", "unexistent-field")) . "\n");
```

```bash
true
false
```

`HMGET key field1 [field2]`

Gets the values of all the given hash fields.

`HMSET key field1 value1 [field2 value2]`

Sets multiple hash fields to multiple values.

```bash
127.0.0.1:6379> HMSET person name "Mizu" surname "Mitsu" plang "Python"
OK
127.0.0.1:6379> HMGET person name surname unexistent-field
1) "Mizu"
2) "Mitsu"
3) (nil)
```

```php
$redis->hMSet("person", ["name" => "Mizu", "surname" => "Mitsu", "plang" => "Python"]);
print_r($redis->hMGet("person", ["name", "surname", "unexistent-field"]));
```

```bash
Array
(
    [name] => Mizu
    [surname] => Mitsu
    [unexistent-field] =>
)
```

`HKEYS key`

Gets all the fields in a hash.

`HVALS key`

Gets all the values in a hash.

```bash
127.0.0.1:6379> HKEYS person
1) "name"
2) "surname"
3) "plang"
127.0.0.1:6379> HVALS person
1) "Mizu"
2) "Mitsu"
3) "Python"
```

```php
print_r($redis->hKeys("person"));
print_r($redis->hVals("person"));
```

```bash
Array
(
    [0] => name
    [1] => surname
    [2] => plang
)
Array
(
    [0] => Mizu
    [1] => Mitsu
    [2] => Python
)
```

`HINCRBY key field increment`

Increments the integer value of a hash field by the given number.

```bash
127.0.0.1:6379> HSET person id 1024
(integer) 1
127.0.0.1:6379> HGET person id
"1024"
127.0.0.1:6379> HINCRBY person id 2
(integer) 1026
127.0.0.1:6379> HGET person id
"1026"
```

```php
$redis->hSet("person", "id", 1024);
echo("person id: {$redis->hGet("person", "id")}\n");
echo("person id: {$redis->hIncrBy("person", "id", 2)}\n");
echo("person id: {$redis->hGet("person", "id")}\n");
```

```bash
person id: 1024
person id: 1026
person id: 1026
```

`HINCRBYFLOAT key field increment`

Increments the float value of a hash field by the given amount.

`HSETNX key field value`

Sets the value of a hash field, only if the field does not exist.

`HSCAN key cursor [MATCH pattern] [COUNT count]`

Incrementally iterates hash fields and associated values.

`HDEL key field2 [field2]`

Deletes one or more hash fields.

```bash
127.0.0.1:6379> HGETALL person
1) "name"
2) "Mizu"
3) "surname"
4) "Mitsu"
5) "plang"
6) "Python"
7) "id"
8) "1026"
127.0.0.1:6379> HDEL person surname id
(integer) 2
127.0.0.1:6379> HGETALL person
1) "name"
2) "Mizu"
3) "plang"
4) "Python"
```

```php
print_r($redis->hGetAll("person"));
echo($redis->hDel("person", "surname") . "\n");
echo($redis->hDel("person", "id") . "\n");
echo($redis->hDel("person", "unexistent-field") . "\n");
print_r($redis->hGetAll("person"));
```

```bash
Array
(
    [name] => Mizu
    [plang] => Python
    [id] => 1026
    [surname] => Mitsu
)
1
1
0
Array
(
    [name] => Mizu
    [plang] => Python
)
```
