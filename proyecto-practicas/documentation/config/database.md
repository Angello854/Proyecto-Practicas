# Documentation: database.php

Original file: `config/database.php`

# `database.php` Documentation

This documentation provides an in-depth look at the `database.php` file, which is a crucial part of any PHP application.

## Table of Contents
[TOC]

### Introduction

The `database.php` file is responsible for configuring database connections and settings for your PHP application. This file is typically located in the root directory of your project and provides a centralized location for managing database configurations.

### Default Database Connection

The first section of this file defines the default database connection name. This setting determines which database connection will be used by default unless another connection is explicitly specified.

```php
'default' => env('DB_CONNECTION', 'sqlite'),
```

### Database Connections

The next section defines the available database connections for your application. These connections include:

* `sqlite`: A SQLite database connection.
* `mysql`: A MySQL database connection.
* `mariadb`: A MariaDB database connection.
* `pgsql`: A PostgreSQL database connection.
* `sqlsrv`: A SQL Server (Microsoft) database connection.

Each connection is defined by the following parameters:

* `driver`: The database driver to use for this connection.
* `url`: The URL for this connection, which can be used to establish a connection.
* `host`, `port`, `username`, and `password`: The host name, port number, username, and password for this connection.
* `prefix` and `prefix_indexes`: The table prefix and whether indexes should be created for tables in this database.
* `foreign_key_constraints` and other optional parameters: Additional settings that can be used to customize the behavior of this connection.

Here is an example of a MySQL connection:
```php
'mysql' => [
    'driver' => 'mysql',
    'url' => env('DB_URL'),
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'laravel'),
    'username' => env('DB_USERNAME', 'root'),
    'password' => env('DB_PASSWORD', ''),
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
    ]) : [],
],
```

### Migration Repository Table

The next section defines the migration repository table, which is used to keep track of all the migrations that have already run for your application.

```php
'migrations' => [
    'table' => 'migrations',
    'update_date_on_publish' => true,
],
```

### Redis Databases

The final section defines the available Redis databases for your application. These databases include:

* `default`: The default Redis database.
* `cache`: A cache Redis database.

Each database is defined by the following parameters:

* `url`, `host`, `username`, and `password`: The URL, host name, username, and password for this database.
* `port` and `database`: The port number and database number for this database.

Here is an example of a default Redis database:
```php
'default' => [
    'url' => env('REDIS_URL'),
    'host' => env('REDIS_HOST', '127.0.0.1'),
    'username' => env('REDIS_USERNAME'),
    'password' => env('REDIS_PASSWORD'),
    'port' => env('REDIS_PORT', '6379'),
    'database' => env('REDIS_DB', '0'),
],
```

I hope this documentation helps you understand the role and functionality of the `database.php` file in your PHP application.