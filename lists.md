# Lists

`LLEN key`

Gets the length of a list.

`LINDEX key index`

Gets an element from a list by its index.

`LPUSH key value1 [value2]`

Prepends one or multiple values to a list.

`RPUSH key value1 [value2]`

Appends one or multiple values to a list.

```bash
127.0.0.1:6379> LPUSH fruits "apple"
(integer) 1
127.0.0.1:6379> LLEN fruits
(integer) 1
127.0.0.1:6379> RPUSH fruits "orange"
(integer) 2
127.0.0.1:6379> LLEN fruits
(integer) 2
127.0.0.1:6379> LLEN vegetables
(integer) 0
127.0.0.1:6379> LINDEX fruits 0
"apple"
127.0.0.1:6379> LINDEX fruits 1
"orange"
127.0.0.1:6379> LINDEX fruits 2
(nil)
127.0.0.1:6379> LPUSH fruits "plum"
(integer) 3
127.0.0.1:6379> LINDEX fruits 0
"plum"
127.0.0.1:6379> RPUSH fruits "banana"
(integer) 4
127.0.0.1:6379> LINDEX fruits 3
"banana"
```

```php
<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->lPush("fruits", "apple");
echo("fruits length: {$redis->lLen("fruits")}\n");
$redis->rPush("fruits", "orange");
echo("fruits length: {$redis->lLen("fruits")}\n");
echo("vegetables length: {$redis->lLen("vegetables")}\n");
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
$redis->lPush("fruits", "plum");
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
$redis->rPush("fruits", "banana");
echo("fruits[0]: {$redis->lIndex("fruits", 3)}\n");
```

```bash
fruits length: 1
fruits length: 2
vegetables length:
fruits[0]: apple
fruits[1]: orange
fruits[2]:
fruits[0]: plum
fruits[0]: banana
```

`LPOP key`

Removes and gets the first element in a list.

`RPOP key`

Removes and gets the last element in a list.

```bash
127.0.0.1:6379> LINDEX fruits 0
"plum"
127.0.0.1:6379> LPOP fruits
1) "plum"
127.0.0.1:6379> LINDEX fruits 0
"apple"
127.0.0.1:6379> LINDEX fruits 2
"banana"
127.0.0.1:6379> RPOP fruits
"banana"
127.0.0.1:6379> LINDEX fruits 2
(nil)
127.0.0.1:6379> LINDEX fruits 1
"orange"
```

```php
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
$redis->lPop("fruits");
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
$redis->rPop("fruits");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
```

```bash
fruits[0]: plum
fruits[0]: apple
fruits[2]: banana
fruits[2]:
fruits[1]: orange
```

`LINSERT key BEFORE|AFTER pivot value`

Inserts an element before or after another element in a list.

```bash
127.0.0.1:6379> LINDEX fruits 0
"apple"
127.0.0.1:6379> LINDEX fruits 1
"orange"
127.0.0.1:6379> LINDEX fruits 2
(nil)
127.0.0.1:6379> LINSERT fruits BEFORE "apple" "pear"
(integer) 3
127.0.0.1:6379> LINDEX fruits 0
"pear"
127.0.0.1:6379> LINDEX fruits 1
"apple"
127.0.0.1:6379> LINDEX fruits 2
"orange"
127.0.0.1:6379> LINSERT fruits AFTER "apple" "peach"
(integer) 4
127.0.0.1:6379> LINDEX fruits 0
"pear"
127.0.0.1:6379> LINDEX fruits 1
"apple"
127.0.0.1:6379> LINDEX fruits 2
"peach"
127.0.0.1:6379> LINDEX fruits 3
"orange"
```

```php
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
$redis->lInsert("fruits", Redis::BEFORE, "apple", "pear");
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
$redis->lInsert("fruits", Redis::AFTER, "apple", "peach");
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
echo("fruits[03: {$redis->lIndex("fruits", 3)}\n");
```

```bash
fruits[0]: apple
fruits[1]: orange
fruits[2]:
fruits[0]: pear
fruits[1]: apple
fruits[2]: orange
fruits[0]: pear
fruits[1]: apple
fruits[2]: peach
fruits[03: orange
```

`LSET key index value`

Sets the value of an element in a list by its index.

```bash
127.0.0.1:6379> LSET fruits 2 "pineapple"
OK
127.0.0.1:6379> LINDEX fruits 2
"pineapple"
```

```php
$redis->lSet("fruits", 2, "pineapple");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
```

```bash
fruits[2]: pineapple
```

`LRANGE key start stop`

Gets a range of elements from a list.

```bash
127.0.0.1:6379> LINDEX fruits 0
"pear"
127.0.0.1:6379> LINDEX fruits 1
"apple"
127.0.0.1:6379> LINDEX fruits 2
"pineapple"
127.0.0.1:6379> LINDEX fruits 3
"orange"
127.0.0.1:6379> LINDEX fruits 4
(nil)
127.0.0.1:6379> LRANGE fruits 1 2
1) "apple"
2) "pineapple"
```

```php
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
echo("fruits[3]: {$redis->lIndex("fruits", 3)}\n");
echo("fruits[4]: {$redis->lIndex("fruits", 4)}\n");
print_r($redis->lRange("fruits", 1, 2));
```

```bash
Array
(
    [0] => apple
    [1] => pineapple
)
```

`LTRIM key start stop`

Trims a list to the specified range.

```bash
127.0.0.1:6379> LINDEX fruits 0
"pear"
127.0.0.1:6379> LINDEX fruits 1
"apple"
127.0.0.1:6379> LINDEX fruits 2
"pineapple"
127.0.0.1:6379> LINDEX fruits 3
"orange"
127.0.0.1:6379> LINDEX fruits 4
(nil)
127.0.0.1:6379> LTRIM fruits 1 2
OK
127.0.0.1:6379> LINDEX fruits 0
"apple"
127.0.0.1:6379> LINDEX fruits 1
"pineapple"
127.0.0.1:6379> LINDEX fruits 2
(nil)
```

```php
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
echo("fruits[3]: {$redis->lIndex("fruits", 3)}\n");
echo("fruits[4]: {$redis->lIndex("fruits", 4)}\n");
$redis->lTrim("fruits", 1, 2);
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
```

```bash
fruits[0]: pear
fruits[1]: apple
fruits[2]: pineapple
fruits[3]: orange
fruits[4]:
fruits[0]: apple
fruits[1]: pineapple
fruits[2]:
```

`LREM key count value`

Removes elements from a list.

```bash
127.0.0.1:6379> RPUSH fruits "apple"
(integer) 3
127.0.0.1:6379> RPUSH fruits "apple"
(integer) 4
127.0.0.1:6379> LINDEX fruits 0
"apple"
127.0.0.1:6379> LINDEX fruits 1
"pineapple"
127.0.0.1:6379> LINDEX fruits 2
"apple"
127.0.0.1:6379> LINDEX fruits 3
"apple"
127.0.0.1:6379> LINDEX fruits 4
(nil)
127.0.0.1:6379> LREM fruits 2 "apple"
(integer) 2
127.0.0.1:6379> LINDEX fruits 0
"pineapple"
127.0.0.1:6379> LINDEX fruits 1
"apple"
127.0.0.1:6379> LINDEX fruits 2
(nil)
```

```php
$redis->rPush("fruits", "apple");
$redis->rPush("fruits", "apple");
echo("fruits[0]: {$redis->lIndex("fruits", 0)}\n");
echo("fruits[1]: {$redis->lIndex("fruits", 1)}\n");
echo("fruits[2]: {$redis->lIndex("fruits", 2)}\n");
echo("fruits[3]: {$redis->lIndex("fruits", 3)}\n");
echo("fruits[4]: {$redis->lIndex("fruits", 4)}\n");
```

```bash
fruits[0]: apple
fruits[1]: pineapple
fruits[2]: apple
fruits[3]: apple
fruits[4]:
fruits[0]: pineapple
fruits[1]: apple
fruits[2]:
```

`BLPOP key1 [key2] timeout`

Removes and gets the first element in a list, or blocks until one is available.

`BRPOP key1 [key2] timeout`

Removes and gets the last element in a list, or blocks until one is available.

`LPUSHX key value`

Prepends a value to a list, only if the list exists.

`RPUSHX key value`

Appends a value to a list, only if the list exists.

`BRPOPLPUSH source destination timeout`

Pops a value from a list, pushes it to another list and returns it; or blocks until one is available.

`RPOPLPUSH source destination`

Removes the last element in a list, appends it to another list and returns it.
