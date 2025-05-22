# Documentation: filament-logger.php

Original file: `config/filament-logger.php`

# Filament Logger Configuration Documentation

[TOC]

## Introduction

The `filament-logger.php` file is a configuration file for the Filament logger system in a PHP application. This document aims to provide comprehensive technical documentation for this file, explaining its purpose, functionality, and configuration options.

### Purpose

This file configures the behavior of the Filament logger, allowing developers to customize the logging process for their application. It defines various settings for different types of logs, such as activity, resource, access, notifications, and models.

## Configuration Options

The `filament-logger.php` file contains several configuration options that can be used to customize the behavior of the Filament logger. Here are the available options:

### datetime_format
```
'datetime_format' => 'd/m/Y H:i:s',
```
This option sets the format for the datetime stamp in log entries. The default value is `d/m/Y H:i:s`, which represents the date and time in the format "day/month/year hour:minute:second".

### date_format
```
'date_format' => 'd/m/Y',
```
This option sets the format for the date stamp in log entries. The default value is `d/m/Y`, which represents the date in the format "day/month/year".

### activity_resource
```
'activity_resource' => \Z3d0X\FilamentLogger\Resources\ActivityResource::class,
```
This option specifies the resource class used for logging activities.

### scoped_to_tenant
```
'scoped_to_tenant' => true,
```
This option determines whether log entries are scoped to a specific tenant. The default value is `true`, which means that logs will be associated with a tenant ID.

### navigation_sort
```
'navigation_sort' => null,
```
This option sets the sort order for navigation elements in the Filament logger interface. The default value is `null`, which means that navigation elements will not be sorted.

### resources
```
'resources' => [
    'enabled' => true,
    'log_name' => 'Resource',
    'logger' => \Z3d0X\FilamentLogger\Loggers\ResourceLogger::class,
    'color' => 'success',
    'exclude' => [
        //App\Filament\Resources\UserResource::class,
    ],
    'cluster' => null,
    'navigation_group' =>'Settings',
],
```
This option configures the resource logger, which is responsible for logging activities related to resources.

* `enabled`: A boolean flag that determines whether the resource logger is enabled. The default value is `true`.
* `log_name`: The name of the log entry type.
* `logger`: The logger class used for this log entry type.
* `color`: The color used to highlight log entries of this type.
* `exclude`: An array of resources that should be excluded from logging.
* `cluster`: The navigation cluster for this log entry type.
* `navigation_group` : The navigation group for this log entry type.

### access
```
'access' => [
    'enabled' => true,
    'logger' => \Z3d0X\FilamentLogger\Loggers\AccessLogger::class,
    'color' => 'danger',
    'log_name' => 'Access',
],
```
This option configures the access logger, which is responsible for logging activities related to access control.

* `enabled`: A boolean flag that determines whether the access logger is enabled. The default value is `true`.
* `logger`: The logger class used for this log entry type.
* `color`: The color used to highlight log entries of this type.
* `log_name`: The name of the log entry type.

### notifications
```
'notifications' => [
    'enabled' => true,
    'logger' => \Z3d0X\FilamentLogger\Loggers\NotificationLogger::class,
    'color' => null,
    'log_name' => 'Notification',
],
```
This option configures the notification logger, which is responsible for logging activities related to notifications.

* `enabled`: A boolean flag that determines whether the notification logger is enabled. The default value is `true`.
* `logger`: The logger class used for this log entry type.
* `color`: The color used to highlight log entries of this type.
* `log_name`: The name of the log entry type.

### models
```
'models' => [
    'enabled' => true,
    'log_name' => 'Model',
    'color' => 'warning',
    'logger' => \Z3d0X\FilamentLogger\Loggers\ModelLogger::class,
    'register' => [
        //App\Models\User::class,
    ],
],
```
This option configures the model logger, which is responsible for logging activities related to models.

* `enabled`: A boolean flag that determines whether the model logger is enabled. The default value is `true`.
* `log_name`: The name of the log entry type.
* `color`: The color used to highlight log entries of this type.
* `logger`: The logger class used for this log entry type.
* `register`: An array of models that should be registered with the model logger.

### custom
```
'custom' => [
    // [
    //     'log_name' => 'Custom',
    //     'color' => 'primary',
    // ]
],
```
This option allows developers to add custom log entry types. Each custom log entry type must include a `log_name` and an optional `color`.

## Conclusion

The `filament-logger.php` file is a critical configuration file for the Filament logger system in your PHP application. This document has provided comprehensive technical documentation for this file, explaining its purpose, functionality, and configuration options.

By following the guidelines outlined in this documentation, developers can customize the behavior of the Filament logger to suit their specific needs.