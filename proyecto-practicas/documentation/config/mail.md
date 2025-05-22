# Documentation: mail.php

Original file: `config/mail.php`

# Mail Configuration Documentation

Table of Contents
================

* [Introduction](#introduction)
* [Mailers](#mailers)
	+ [SMTP Mailer](#smtp-mailer)
	+ [SES Mailer](#ses-mailer)
	+ [Postmark Mailer](#postmark-mailer)
	+ [Resend Mailer](#resend-mailer)
	+ [Sendmail Mailer](#sendmail-mailer)
	+ [Log Mailer](#log-mailer)
	+ [Array Mailer](#array-mailer)
	+ [Failover Mailer](#failover-mailer)
	+ [Roundrobin Mailer](#roundrobin-mailer)
* [Global "From" Address](#global-from-address)

Introduction
------------

This file configures the mail functionality for a PHP application. It defines various mailers and their settings, as well as the global "from" address used by the application.

Mailers
--------

The `mailers` array in this file contains configurations for different mail transport drivers that can be used to send emails. Each mailer has its own set of parameters that control how it sends emails.

### SMTP Mailer

The `smtp` mailer is configured with the following settings:

* `transport`: `smtp`
* `scheme`: The scheme (e.g., `https`) used for sending emails
* `url`: The URL used for sending emails
* `host`: The host name of the email server (default: `127.0.0.1`)
* `port`: The port number used by the email server (default: 2525)
* `username` and `password`: Credentials used to authenticate with the email server

### SES Mailer

The `ses` mailer is configured with the following settings:

* `transport`: `ses`

### Postmark Mailer

The `postmark` mailer is configured with the following settings:

* `transport`: `postmark`
* `message_stream_id`: The ID of the message stream used by Postmark (optional)
* `client`: Settings for the client that sends emails, including a timeout (default: 5 seconds)

### Resend Mailer

The `resend` mailer is configured with the following settings:

* `transport`: `resend`

### Sendmail Mailer

The `sendmail` mailer is configured with the following settings:

* `transport`: `sendmail`
* `path`: The path to the sendmail executable (default: `/usr/sbin/sendmail -bs -i`)

### Log Mailer

The `log` mailer is configured with the following settings:

* `transport`: `log`
* `channel`: The name of the logging channel used by Laravel (default: `mail.log`)

### Array Mailer

The `array` mailer is configured with the following settings:

* `transport`: `array`

### Failover Mailer

The `failover` mailer is configured with the following settings:

* `transport`: `failover`
* `mailers`: A list of mailers to use in case of a failure
* `retry_after`: The number of seconds to wait before retrying (default: 60)

### Roundrobin Mailer

The `roundrobin` mailer is configured with the following settings:

* `transport`: `roundrobin`
* `mailers`: A list of mailers to use in a round-robin fashion
* `retry_after`: The number of seconds to wait before retrying (default: 60)

Global "From" Address
--------------------

The global "from" address is used as the sender's email address for all emails sent by the application. It can be configured with the following settings:

* `address`: The email address used as the sender's email address
* `name`: The name associated with the sender's email address

This file provides a comprehensive configuration for mail functionality in Laravel, allowing developers to customize and fine-tune their email sending setup.