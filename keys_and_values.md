# Keys and values

`SET key value`

This command sets the value at the specified key.

`GET key`

Gets the value of a key.

```bash
127.0.0.1:6379> SET nickname "katheroine"
OK
127.0.0.1:6379> GET nickname
"katheroine"
```

```php
<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->set("nickname", "katheroine");
echo("nickname: {$redis->get("nickname")}\n");
```

```bash
nickname: katheroine
```

`EXISTS key`

This command checks whether the key exists or not.

```bash
127.0.0.1:6379> SET nickname "katheroine"
OK
127.0.0.1:6379> GET nickname
"katheroine"
127.0.0.1:6379> EXISTS nickname
(integer) 1
127.0.0.1:6379> EXISTS nonexistent
(integer) 0
```

```php
$redis->set("nickname", "katheroine");
echo("nickname: {$redis->get("nickname")}\n");
echo($redis->exists("nickname") . "\n");
echo($redis->exists("nonexistent") . "\n");
```

```bash
nickname: katheroine
1
0
```

`GETSET key value`

Sets the string value of a key and return its old value.

```bash
127.0.0.1:6379> GETSET name "mizumitsu"
"katheroine"
127.0.0.1:6379> GET name
"mizumitsu"
```

```php
echo("nickname: {$redis->getSet("nickname", "mizumitsu")}\n");
echo("nickname: {$redis->get("nickname")}\n");
```

```bash
nickname: katheroine
nickname: mizumitsu
```

`SETNX key value`

Sets the value of a key, only if the key does not exist.

```bash
127.0.0.1:6379> DEL notpreviouslyexisted
(integer) 0
127.0.0.1:6379> SETNX notpreviouslyexisted 5
(integer) 1
127.0.0.1:6379> SETNX notpreviouslyexisted 3
(integer) 0
127.0.0.1:6379> GET notpreviouslyexisted
"5"
```

```php
$redis->delete("notpreviouslyexisted");
var_dump($redis->setnx("notpreviouslyexisted", 5));
var_dump($redis->setnx("notpreviouslyexisted", 3));
echo("notpreviouslyexisted: {$redis->get("notpreviouslyexisted")}\n");
```

```bash
bool(true)
bool(false)
notpreviouslyexisted: 5
```

`MGET key1 [key2..]`

Gets the values of all the given keys.

`MSET key value [key value ...]`

Sets multiple keys to multiple values.

```bash
127.0.0.1:6379> MSET name "Miko" nickname "mikotetsu"
OK
127.0.0.1:6379> MGET name surname nickname
1) "Miko"
2) (nil)
3) "mikotetsu"
```

```php
$redis->mSet(["name" => "Miko", "nickname" => "mikotetsu"]);
print_r($redis->mGet(["name", "surname", "nickname"]));
```

```bash
Array
(
    [0] => Miko
    [1] =>
    [2] => mikotetsu
)
```

`RENAME key newkey`

Changes the key name.

```bash
127.0.0.1:6379> GET nickname
"mikotetsu"
127.0.0.1:6379> RENAME nickname nick
OK
127.0.0.1:6379> GET nick
"mikotetsu"
127.0.0.1:6379> GET nickname
(nil)
```

```php
echo("nickname: {$redis->get("nickname")}\n");
$redis->rename("nickname", "nick");
echo("nick: {$redis->get("nick")}\n");
echo("nickname: {$redis->get("nickname")}\n");
```

```bash
nickname: mikotetsu
nick: mikotetsu
nickname:
```

`RENAMENX key newkey`

Renames the key, if a new key doesn't exist.

`SETEX key seconds value`

Sets the value with the expiry of a key.

```bash
127.0.0.1:6379> SETEX volatile 3 "moment"
OK
127.0.0.1:6379> GET volatile
"moment"
127.0.0.1:6379> GET volatile
(nil)
```

```php
var_dump($redis->setex("volatile", 3, "moment"));
echo("volatile: {$redis->get("volatile")}\n");
sleep(4);
echo("volatile: {$redis->get("volatile")}\n");
```

```bash
volatile: moment
volatile:
```

`EXPIRE key seconds`

Sets the expiry of the key after the specified time.

`EXPIREAT key timestamp`

Sets the expiry of the key after the specified time. Here time is in Unix timestamp format.

`TTL key`

Gets the remaining time in keys expiry.

```bash
127.0.0.1:6379> SET limited "moment"
OK
127.0.0.1:6379> GET limited
"moment"
127.0.0.1:6379> TTL limited
(integer) -1
127.0.0.1:6379> EXPIRE limited 10
(integer) 1
127.0.0.1:6379> TTL limited
(integer) 8
127.0.0.1:6379> GET limited
"moment"
127.0.0.1:6379> TTL limited
(integer) 2
127.0.0.1:6379> TTL limited
(integer) -2
127.0.0.1:6379> GET limited
(nil)
```

```php
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
```

```bash
limited: moment
ttl: -1
ttl: 8
limited: moment
ttl: 2
ttl: -2
limited:
```

`PEXPIRE key milliseconds`

Set the expiry of key in milliseconds.

`PEXPIREAT key milliseconds-timestamp`

Sets the expiry of the key in Unix timestamp specified as milliseconds.

`PSETEX key milliseconds value`

Sets the value and expiration in milliseconds of a key.

`PTTL key`

Gets the remaining time in keys expiry in milliseconds.

`MSETNX key value [key value ...]`

Sets multiple keys to multiple values, only if none of the keys exist.

`PERSIST key`

Removes the expiration from the key.

`DEL key`

This command deletes the key, if it exists.

```bash
127.0.0.1:6379> SET nickname "mikotetsu"
OK
127.0.0.1:6379> GET nickname
"mikotetsu"
127.0.0.1:6379> DEL nickname
(integer) 1
127.0.0.1:6379> GET nickname
(nil)
```

```php
echo("nickname: {$redis->get("nickname")}\n");
$redis->delete("nickname");
echo("nickname: {$redis->get("nickname")}\n");
```

```bash
nick: mikotetsu
nick:
```

`RANDOMKEY`

Returns a random key from Redis.

```bash
127.0.0.1:6379> RANDOMKEY
"users"
```

```php
echo("random key: {$redis->randomKey("nick")}\n");
```

```bash
random key: name
```

`KEYS pattern`

Finds all keys matching the specified pattern.

`DUMP key`

This command returns a serialized version of the value stored at the specified key.

`MOVE key db`

Moves a key to another database.

`TYPE key`

Returns the data type of the value stored in the key.
