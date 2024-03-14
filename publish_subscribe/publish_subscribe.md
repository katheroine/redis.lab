# Publish-Subscribe

`PUBLISH channel message`

Posts a message to a channel.

`SUBSCRIBE channel [channel ...]`

Listens for messages published to the given channels.

`UNSUBSCRIBE [channel [channel ...]]`

Stops listening for messages posted to the given channels.

`PSUBSCRIBE pattern [pattern ...]`

Subscribes to channels matching the given patterns.

`PUNSUBSCRIBE [pattern [pattern ...]]`

Stops listening for messages posted to channels matching the given patterns.

`PUBSUB subcommand [argument [argument ...]]`

Tells the state of Pub/Sub system. For example, which clients are active on the server.

```bash
127.0.0.1:6379> SUBSCRIBE infoway
1) "subscribe"
2) "infoway"
3) (integer) 1
```

```bash
127.0.0.1:6379> PUBLISH infoway "Hi, there!"
(integer) 1
```

```bash
1) "message"
2) "infoway"
3) "Hi, there!"
```

```bash
127.0.0.1:6379> PUBLISH infoway "Hello, world!"
(integer) 1
```

```bash
1) "message"
2) "infoway"
3) "Hello, world!"
127.0.0.1:6379> UNSUBSCRIBE infoway
1) "unsubscribe"
2) "infoway"
3) (integer) 0
```

```php
<?php

// ini_set('default_socket_timeout', -1);

$redis = new Redis();
$redis->setOption (Redis::OPT_READ_TIMEOUT, -1);
$redis->connect('127.0.0.1', 6379);

function output_message($redis, $channel, $message) {
	switch($channel) {
		case 'infoway':
			echo($message . PHP_EOL);
			break;
	}
}

$redis->subscribe(['infoway'], 'output_message');

$redis->close();
```

```php
<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$redis->publish('infoway', "Hi, there!");
sleep(5);
$redis->publish('infoway', "Hello, world!");
sleep(5);

$redis->close();
```

```bash
Hi, there!
Hello, world!
```
