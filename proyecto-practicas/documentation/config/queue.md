# Documentation: queue.php

Original file: `config/queue.php`

# Queue Configuration Documentation

Table of Contents:
-------------------

* [Introduction](#introduction)
* [Default Queue Connection](#default-queue-connection)
* [Queue Connections](#queue-connections)
* [Job Batching](#job-batching)
* [Failed Queue Jobs](#failed-queue-jobs)

## Introduction
------------

The `queue.php` file is responsible for configuring the default queue connection and available queue connections for your Laravel application. This documentation will cover each section of this file, explaining their purpose, parameters, return values, and functionality.

## Default Queue Connection
-------------------------

### Purpose
The `default` option defines the default queue connection to use when processing jobs.

### Parameters
* `env('QUEUE_CONNECTION', 'database')`: The default value is set to `'database'`, which means that if the `QUEUE_CONNECTION` environment variable is not defined, the database queue will be used as the default.

### Return Value
The return value is a string representing the name of the default queue connection.

## Queue Connections
-------------------

### Purpose
The `connections` option defines available queue connections and their configurations.

### Parameters
Each queue connection configuration includes the following parameters:

* `driver`: The driver to use for the queue (e.g., `'sync'`, `'database'`, etc.).
* Connection-specific options:
	+ `beanstalkd`: Host, queue, retry after, block for.
	+ `sqs`: Key, secret, prefix, queue, suffix, region.
	+ `redis`: Connection, queue, retry after, block for.

### Return Value
The return value is an array of queue connections and their configurations.

## Job Batching
--------------

### Purpose
Job batching allows you to group multiple jobs together and process them as a single unit. This can improve performance and reduce the number of database queries required to process jobs.

### Parameters
* `database`: The database connection to use for job batching.
* `table`: The table name where job batching information is stored.

### Return Value
The return value is an array with two elements: `database` and `table`.

## Failed Queue Jobs
-------------------

### Purpose
Failed queue jobs are jobs that have failed to process. This section configures the behavior of failed queue job logging, allowing you to control how and where failed jobs are stored.

### Parameters
* `driver`: The driver to use for storing failed queue jobs (e.g., `'database-uuids'`, `'dynamodb'`, etc.).
* Connection-specific options:
	+ `database`: The database connection to use for storing failed queue jobs.
	+ `table`: The table name where failed queue job information is stored.

### Return Value
The return value is an array with two elements: `driver` and the connection-specific options.

By configuring the `queue.php` file, you can control how your Laravel application handles queues, including the default queue connection, available queue connections, job batching, and failed queue jobs.