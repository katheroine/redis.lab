# Transactions

`MULTI`

Marks the start of a transaction block.

`EXEC`

Executes all commands issued after MULTI.

`DISCARD`

Discards all commands issued after MULTI.

`WATCH key [key ...]`

Watches the given keys to determine the execution of the MULTI/EXEC block.

`UNWATCH`

Forgets about all watched keys.

```bash
127.0.0.1:6379> MULTI
OK
127.0.0.1:6379(TX)> SET shared "Let's share."
QUEUED
127.0.0.1:6379(TX)> SET shared "Let's change."
QUEUED
127.0.0.1:6379(TX)> GET shared
QUEUED
127.0.0.1:6379(TX)> EXEC
1) OK
2) OK
3) "Let's change."
```

**WATCH** is used to provide a check-and-set (CAS) behavior to Redis transactions.

WATCHed keys are monitored in order to detect changes against them. If at least one watched key is modified before the EXEC command, the whole transaction aborts, and EXEC returns a Null reply to notify that the transaction failed.

```bash
127.0.0.1:6379> WATCH shared
OK
127.0.0.1:6379> MULTI
OK
127.0.0.1:6379(TX)> SET shared "Change from client 1."
QUEUED
127.0.0.1:6379(TX)> GET shared
QUEUED
```

```bash
127.0.0.1:6379> SET shared "Change from client 2..."
OK
```

```bash
127.0.0.1:6379(TX)> SET shared "Change from client 1 again."
QUEUED
127.0.0.1:6379(TX)> GET shared
QUEUED
127.0.0.1:6379(TX)> EXEC
(nil)
127.0.0.1:6379> GET shared
"Change from client 2..."
```
