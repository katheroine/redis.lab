# Numbers

`INCR key`

Increments the integer value of a key by one.

`DECR key`

Decrements the integer value of a key by one.

```bash
127.0.0.1:6379> SET counter 1024
OK
127.0.0.1:6379> GET counter
"1024"
127.0.0.1:6379> INCR counter
(integer) 1025
127.0.0.1:6379> GET counter
"1025"
127.0.0.1:6379> DECR counter
(integer) 1024
127.0.0.1:6379> GET counter
"1024"
```

```php
<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->set("counter", "1024");
echo("counter: {$redis->get("counter")}\n");

echo("counter: {$redis->incr("counter")}\n");
echo("counter: {$redis->get("counter")}\n");
echo("counter: {$redis->decr("counter")}\n");
echo("counter: {$redis->get("counter")}\n");
```

```bash
counter: 1024
counter: 1025
counter: 1025
counter: 1024
counter: 1024
```

`INCRBY key increment`

Increments the integer value of a key by the given amount.

`DECRBY key decrement`

Decrements the integer value of a key by the given number.

```bash
127.0.0.1:6379> GET counter
"1024"
127.0.0.1:6379> INCRBY counter 5
(integer) 1029
127.0.0.1:6379> GET counter
"1029"
127.0.0.1:6379> DECRBY counter 3
(integer) 1026
127.0.0.1:6379> GET counter
"1026"
```

```php
echo("counter: {$redis->incrBy("counter", 5)}\n");
echo("counter: {$redis->get("counter")}\n");
echo("counter: {$redis->decrBy("counter", 3)}\n");
echo("counter: {$redis->get("counter")}\n");
```

```bash
counter: 1029
counter: 1029
counter: 1026
counter: 1026
```

`INCRBYFLOAT key increment`

Increments the float value of a key by the given amount.
