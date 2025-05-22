# Documentation: filesystems.php

Original file: `config/filesystems.php`

# Filesystem Configuration Documentation

**Table of Contents**

* [Introduction](#introduction)
* [Default Filesystem Disk](#default-filesystem-disk)
* [Filesystem Disks](#filesystem-disks)
* [Symbolic Links](#symbolic-links)

## Introduction

The `filesystems.php` file is a crucial component in the PHP application's configuration. It defines the default filesystem disk and additional disks that can be used for file storage. This documentation will walk you through the purpose, functionality, and configuration options available in this file.

## Default Filesystem Disk

The `default` key specifies the default filesystem disk to use by the framework. The value is set to `'local'` by default, which means that the application will use the local filesystem as its primary storage location. You can change this value to another disk type, such as `'ftp'`, `'sftp'`, or `'s3'`, depending on your specific requirements.

```php
'default' => env('FILESYSTEM_DISK', 'local'),
```

## Filesystem Disks

The `disks` array defines multiple filesystem disks that can be used for file storage. Each disk is configured with the following options:

* `driver`: The type of filesystem driver to use (e.g., `'local'`, `'ftp'`, `'sftp'`, or `'s3'`)
* `root`: The root directory for the filesystem
* `serve`: A boolean indicating whether the filesystem should be served as a web server
* `throw`: A boolean indicating whether to throw an exception on errors
* `report`: A boolean indicating whether to report errors

The following disks are configured in this file:

```php
'disks' => [
    'local' => [
        // ...
    ],
    'public' => [
        // ...
    ],
    's3' => [
        // ...
    ],
],
```

### Local Disk

The `local` disk is the default filesystem disk and uses the local filesystem as its storage location. The root directory is set to `storage_path('app/private')`.

```php
'local' => [
    'driver' => 'local',
    'root' => storage_path('app/private'),
    'serve' => true,
    'throw' => false,
    'report' => false,
],
```

### Public Disk

The `public` disk is used for storing publicly accessible files and uses the local filesystem as its storage location. The root directory is set to `storage_path('app/public')`, and the URL is set to `env('APP_URL').'/storage'`.

```php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => env('APP_URL').'/storage',
    'visibility' => 'public',
    'throw' => false,
    'report' => false,
],
```

### S3 Disk

The `s3` disk is used for storing files in Amazon S3. The configuration options include:

* `key`: The AWS access key ID
* `secret`: The AWS secret access key
* `region`: The AWS region
* `bucket`: The name of the S3 bucket
* `url`: The URL of the S3 bucket
* `endpoint`: The endpoint URL for the S3 bucket
* `use_path_style_endpoint`: A boolean indicating whether to use the path-style endpoint

```php
's3' => [
    'driver' => 's3',
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION'),
    'bucket' => env('AWS_BUCKET'),
    'url' => env('AWS_URL'),
    'endpoint' => env('AWS_ENDPOINT'),
    'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
    'throw' => false,
    'report' => false,
],
```

## Symbolic Links

The `links` array defines symbolic links that will be created when the `storage:link` Artisan command is executed. The keys are the locations of the links, and the values are their targets.

```php
'links' => [
    public_path('storage') => storage_path('app/public'),
],
```

This file provides a flexible way to configure different filesystem disks for various use cases. By understanding the configuration options available in this file, you can optimize your application's file storage and improve its overall performance.