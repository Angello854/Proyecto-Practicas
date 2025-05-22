# Documentation: logging.php

Original file: `config/logging.php`

# Logging Configuration Documentation
======================================================

**Table of Contents**
-------------------

* [Introduction](#introduction)
* [Logging Configuration Options](#logging-configuration-options)
* [Log Channels](#log-channels)
* [Log Formatters](#log-formatters)

## Introduction
---------------

This documentation provides an overview of the logging configuration options available in the `config/logging.php` file. This file is responsible for defining the default log channel, deprecation log channel, and individual log channels for different types of logs.

## Logging Configuration Options
-------------------------------

### Default Log Channel
------------------------

The `default` option defines the default log channel that is used to write messages to logs. The value provided should match one of the channels configured below.

### Deprecations Log Channel
---------------------------

The `deprecations` option controls the log channel that should be used to log warnings regarding deprecated PHP and library features.

### Log Channels
---------------

The `channels` array defines individual log channels for different types of logs. Each log channel can have its own configuration options, such as the driver, path, level, and replacement placeholders.

### Log Formatters
-----------------

Log formatters are used to format log messages before they are written to the log file. The available formatters are:

* `stack`: formats log messages using a stack of handlers
* `daily`: formats log messages with the date in the filename
* `slack`: formats log messages for Slack notifications
* `papertrail`: formats log messages for Papertrail logging
* `stderr`: formats log messages to be written to the standard error stream

### Log Levels
--------------

Log levels define the severity of log messages. The available log levels are:

* `debug`
* `info`
* `notice`
* `warning`
* `error`
* `critical`

## Log Channels
---------------

The following sections describe each log channel in detail.

### Stack Channel
-----------------

The `stack` channel is a stack of handlers that can be used to write logs to multiple channels at once. The `channels` option specifies the list of channels to use for this handler.

### Single Channel
------------------

The `single` channel writes logs to a single file at the specified path. The `level` option specifies the log level for this channel.

### Daily Channel
-----------------

The `daily` channel writes logs to daily files with the date in the filename. The `days` option specifies the number of days that log files should be kept before they are deleted.

### Slack Channel
----------------

The `slack` channel sends log messages as notifications to a Slack channel. The `url` option specifies the URL for the Slack webhook, and the `username` and `emoji` options specify the username and emoji to use in the notification.

### Papertrail Channel
----------------------

The `papertrail` channel sends log messages to Papertrail logging. The `host` and `port` options specify the host and port for the Papertrail server.

### Stderr Channel
------------------

The `stderr` channel writes logs to the standard error stream. The `stream` option specifies the name of the stream to write to, and the `formatter` option specifies the log formatter to use.

### Syslog Channel
-----------------

The `syslog` channel sends log messages to the syslog server. The `facility` option specifies the facility for the syslog message, and the `level` option specifies the log level.

### Null Channel
----------------

The `null` channel discards all log messages without writing them to a file or sending them over the network.

### Emergency Channel
--------------------

The `emergency` channel writes logs to an emergency log file at the specified path.