# Documentation: services.php

Original file: `config/services.php`

# services.php Documentation

Table of Contents:
==================

* [Introduction](#introduction)
* [Third Party Services](#third-party-services)
	+ [Postmark](#postmark)
	+ [SES (Amazon Simple Email Service)](#ses)
	+ [Resend](#resend)
	+ [Slack](#slack)

## Introduction
===============

The `services.php` file is a configuration file for third-party services used in the PHP application. This file provides a central location for storing credentials and settings for various services, allowing developers to easily manage and update these configurations.

## Third Party Services
=====================

This section documents the various third-party services configured in this file.

### Postmark
-----------

The `postmark` service is used for sending emails through Postmark. This configuration provides a token that can be used to authenticate with the Postmark API.

* Token: The Postmark token, retrieved from the environment variable `POSTMARK_TOKEN`.

### SES (Amazon Simple Email Service)
-----------------------------------

The `ses` service is used for sending emails through Amazon Simple Email Service. This configuration provides credentials and settings necessary to use SES.

* Key: The AWS access key ID, retrieved from the environment variable `AWS_ACCESS_KEY_ID`.
* Secret: The AWS secret access key, retrieved from the environment variable `AWS_SECRET_ACCESS_KEY`.
* Region: The default region for AWS, set to `us-east-1` unless overridden by the environment variable `AWS_DEFAULT_REGION`.

### Resend
---------

The `resend` service is used for sending notifications. This configuration provides a key that can be used to authenticate with the resend API.

* Key: The resend key, retrieved from the environment variable `RESEND_KEY`.

### Slack
---------

The `slack` service is used for integrating with Slack. This configuration provides settings necessary to use Slack's APIs.

* Notifications:
	+ Bot User OAuth Token: The Slack bot user oauth token, retrieved from the environment variable `SLACK_BOT_USER_OAUTH_TOKEN`.
	+ Channel: The default channel for Slack notifications, set to `#general` unless overridden by the environment variable `SLACK_BOT_USER_DEFAULT_CHANNEL`.

This concludes the documentation for the `services.php` file.