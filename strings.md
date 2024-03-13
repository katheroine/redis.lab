# Strings

`STRLEN key`

Gets the length of the value stored in a key.

```bash
127.0.0.1:6379> SET name "mizumitsu"
OK
127.0.0.1:6379> GET name
"mizumitsu"
127.0.0.1:6379> STRLEN name
(integer) 9
```

```php
<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->set("nickname", "mizumitsu");
echo("nickname: {$redis->get("nickname")}\n");

echo("nickname length: {$redis->strLen("nickname")}\n");
```

```bash
nickname: mizumitsu
nickname length: 9
```

`GETRANGE key start end`

Gets a substring of the string stored at a key.

`SETRANGE key offset value`

Overwrites the part of a string at the key starting at the specified offset.

```bash
127.0.0.1:6379> GET nickname
"mizumitsu"
127.0.0.1:6379> GETRANGE nickname 2 5
"zumi"
127.0.0.1:6379> SETRANGE nickname 2 "kote"
(integer) 9
127.0.0.1:6379> GET nickname
"mikotetsu"
```

```php
echo("nickname: {$redis->get("nickname")}\n");
echo("nickname part: {$redis->getRange("nickname", 2, 5)}\n");
echo($redis->setRange("nickname", 2, "kote") . "\n");
echo("nickname: {$redis->get("nickname")}\n");
```

```bash
nickname: mizumitsu
nickname part: zumi
9
nickname: mikotetsu
```

`GETBIT key offset`

Returns the bit value at the offset in the string value stored at the key.

`SETBIT key offset value`

Sets or clears the bit at the offset in the string value stored at the key.

```bash
127.0.0.1:6379> GET nickname
"mikotetsu"
127.0.0.1:6379> GETBIT nickname 2
(integer) 1
127.0.0.1:6379> SETBIT nickname 2 0
(integer) 1
127.0.0.1:6379> GET nickname
"Mikotetsu"
127.0.0.1:6379> GETBIT nickname 2
(integer) 0
```

```php
echo("nickname: {$redis->get("nickname")}\n");
echo("nickname bit: {$redis->getBit("nickname", 2)}\n");
echo($redis->setBit("nickname", 2, 0) . "\n");
echo("nickname: {$redis->get("nickname")}\n");
echo("nickname bit: {$redis->getBit("nickname", 2)}\n");
```

```bash
nickname: mikotetsu
nickname bit: 1
1
nickname: Mikotetsu
nickname bit: 0
```

`APPEND key value`

Appends a value to a key.

```bash
127.0.0.1:6379> SET nickname "mizu"
OK
127.0.0.1:6379> GET nickname
"mizu"
127.0.0.1:6379> APPEND nickname "mitsu"
(integer) 9
127.0.0.1:6379> GET nickname
"mizumitsu"
127.0.0.1:6379>
```

```php
$redis->set("nickname", "mizu");
echo("nickname: {$redis->get("nickname")}\n");
echo($redis->append("nickname", "mitsu") . "\n");
echo("nickname: {$redis->get("nickname")}\n");
```

```bash
nickname: mizu
9
nickname: mizumitsu
```
