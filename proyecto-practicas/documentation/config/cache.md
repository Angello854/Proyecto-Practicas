# Documentation: cache.php

Original file: `config/cache.php`

# cache.php Documentation

### Table of Contents

* [Introduction](#introduction)
* [Cache Stores](#cache-stores)
	+ [Array Store](#array-store)
	+ [Database Store](#database-store)
	+ [File Store](#file-store)
	+ [Memcached Store](#memcached-store)
	+ [Redis Store](#redis-store)
	+ [DynamoDB Store](#dynamodb-store)
	+ [Octane Store](#octane-store)
* [Cache Key Prefix](#cache-key-prefix)

### Introduction

The `cache.php` file is a configuration file for the Laravel framework's cache system. It defines the default cache store and provides options for customizing the cache stores.

### Cache Stores

The `cache.php` file allows you to define multiple cache "stores" with their respective drivers. You can use one of the supported drivers: "array", "database", "file", "memcached", "redis", "dynamodb", or "octane".

#### Array Store

The array store is a simple in-memory cache that stores data as key-value pairs.

* `driver`: The driver for this store, which is set to "array".
* `serialize`: A boolean indicating whether the stored values should be serialized. Set to false by default.
```php
'array' => [
    'driver' => 'array',
    'serialize' => false,
],
```

#### Database Store

The database store uses a database as its underlying storage.

* `driver`: The driver for this store, which is set to "database".
* `connection`: The database connection to use.
* `table`: The table name used for storing cache data.
* `lock_connection`: The connection to use for locking cache records.
* `lock_table`: The table name used for locking cache records.

```php
'database' => [
    'driver' => 'database',
    'connection' => env('DB_CACHE_CONNECTION'),
    'table' => env('DB_CACHE_TABLE', 'cache'),
    'lock_connection' => env('DB_CACHE_LOCK_CONNECTION'),
    'lock_table' => env('DB_CACHE_LOCK_TABLE'),
],
```

#### File Store

The file store uses a directory as its underlying storage.

* `driver`: The driver for this store, which is set to "file".
* `path`: The path to the cache data files.
* `lock_path`: The path to the lock files used by the cache store.

```php
'file' => [
    'driver' => 'file',
    'path' => storage_path('framework/cache/data'),
    'lock_path' => storage_path('framework/cache/data'),
],
```

#### Memcached Store

The memcached store uses a memcached server as its underlying storage.

* `driver`: The driver for this store, which is set to "memcached".
* `persistent_id`: The ID of the persistent connection.
* `sasl`: An array containing the username and password for SASL authentication.
* `options`: An array of options for the memcached client.
* `servers`: An array of server connections.

```php
'memcached' => [
    'driver' => 'memcached',
    'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
    'sasl' => [
        env('MEMCACHED_USERNAME'),
        env('MEMCACHED_PASSWORD'),
    ],
    'options' => [
        // Memcached::OPT_CONNECT_TIMEOUT => 2000,
    ],
    'servers' => [
        [
            'host' => env('MEMCACHED_HOST', '127.0.0.1'),
            'port' => env('MEMCACHED_PORT', 11211),
            'weight' => 100,
        ],
    ],
],
```

#### Redis Store

The redis store uses a redis server as its underlying storage.

* `driver`: The driver for this store, which is set to "redis".
* `connection`: The connection name used for this store.
* `lock_connection`: The connection name used for locking cache records.

```php
'redis' => [
    'driver' => 'redis',
    'connection' => env('REDIS_CACHE_CONNECTION', 'cache'),
    'lock_connection' => env('REDIS_CACHE_LOCK_CONNECTION', 'default'),
],
```

#### DynamoDB Store

The dynamodb store uses a DynamoDB table as its underlying storage.

* `driver`: The driver for this store, which is set to "dynamodb".
* `key`: The AWS access key ID.
* `secret`: The AWS secret access key.
* `region`: The AWS region used by this store.
* `table`: The name of the DynamoDB table used for storing cache data.

```php
'dynamodb' => [
    'driver' => 'dynamodb',
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
    'endpoint' => env('DYNAMODB_ENDPOINT'),
],
```

#### Octane Store

The octane store uses an Octane cache as its underlying storage.

* `driver`: The driver for this store, which is set to "octane".

```php
'octane' => [
    'driver' => 'octane',
],
```

### Cache Key Prefix

When using the APC, database, memcached, Redis, and DynamoDB cache stores, you may prefix every cache key to avoid collisions.

* `prefix`: The prefix used for all cache keys. Set to a default value based on the application name.

```php
'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_cache_'),
```

This documentation provides an overview of the `cache.php` file, including its purpose, configuration options, and supported cache stores.