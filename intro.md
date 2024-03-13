# Redis

**Redis** (/ˈrɛdɪs/; Remote Dictionary Server) is an open-source in-memory storage, used as a distributed, in-memory key–value database, cache and message broker, with optional durability.

Because it holds all data in memory and because of its design, Redis offers low-latency reads and writes, making it particularly suitable for use cases that require a cache. Redis is the most popular NoSQL database, and one of the most popular databases overall. Redis is used in companies
like Twitter, Airbnb, Tinder, Yahoo, Adobe, Hulu, Amazon and OpenAI.

Redis supports different kinds of abstract data structures, such as strings, lists, maps, sets, sorted sets, HyperLogLogs, bitmaps, streams, and spatial indices.

The project was developed and maintained by Salvatore Sanfilippo, starting in 2009. From 2015 until 2020, he led a project core team sponsored by Redis Labs. Salvatore Sanfilippo left Redis as the maintainer in 2020. In 2021 Redis Labs dropped the Labs from its name and now is known simply as "Redis".

Redis is released under a BSD 3-clause license.

– https://en.wikipedia.org/wiki/Redis


## Installation

### Installation for PHP

```bash
$ sudo aptitude install php8.3-redis
```

## Working in shell

### Running server

```bash
$ redis-server
```

### Running client

```bash
$ redis-cli
```

### Connection in PHP

```php
<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
echo("Connection to server sucessfully\n");
echo("Server is running: {$redis->ping()}\n");
```
