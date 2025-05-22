# Documentation: app.php

Original file: `config/app.php`

# `app.php` Documentation

Table of Contents:
=====================

* [Introduction](#introduction)
* [Configuration Options](#configuration-options)
	+ [Application Name](#application-name)
	+ [Application Environment](#application-environment)
	+ [Application Debug Mode](#application-debug-mode)
	+ [Application URL](#application-url)
	+ [Application Timezone](#application-timezone)
	+ [Application Locale Configuration](#application-locale-configuration)
	+ [Encryption Key](#encryption-key)
	+ [Maintenance Mode Driver](#maintenance-mode-driver)

Introduction
============

The `app.php` file is a crucial configuration file in the Laravel framework. It contains essential settings that govern how the application behaves and interacts with its environment.

Configuration Options
=====================

### Application Name
-------------------

The `name` option specifies the name of the application, which is used when displaying notifications or UI elements that require an application name. The default value is `'Laravel'`.

### Application Environment
-------------------------

The `env` option sets the current environment of the application. This can affect how various services are configured. The default value is `'production'`.

### Application Debug Mode
-------------------------

The `debug` option enables or disables debug mode for the application. In debug mode, detailed error messages with stack traces will be displayed. If disabled, a simple generic error page will be shown.

### Application URL
------------------

The `url` option sets the base URL of the application. This is used by Artisan command-line tool to generate URLs correctly. The default value is `'http://localhost'`.

### Application Timezone
-----------------------

The `timezone` option specifies the default timezone for the application, which affects PHP's date and datetime functions.

### Application Locale Configuration
-----------------------------------

The `locale` option sets the default locale used by Laravel's translation/localization methods. This can be set to any locale for which you have translation strings.

### Encryption Key
------------------

The `cipher` and `key` options configure the encryption services in Laravel. The `previous_keys` array stores a list of previous encryption keys.

### Maintenance Mode Driver
-------------------------

The `maintenance` option determines how maintenance mode is managed. Supported drivers include `'file'` (default) and `'cache'`.

That's it for this documentation!