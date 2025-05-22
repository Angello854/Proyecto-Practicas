# Documentation: cookieconsent.php

Original file: `config/cookieconsent.php`

# CookieConsent Configuration Documentation

## Table of Contents

[Introduction](#introduction)
[Configuration Options](#configuration-options)
	* [URL Configuration](#url-configuration)
	* [Consent Cookie Configuration](#consent-cookie-configuration)
	* [Legal Page Configuration](#legal-page-configuration)
	* [Google Analytics Configuration](#google-analytics-configuration)

## Introduction

The `cookieconsent.php` file is a configuration file for the cookie consent package in your PHP application. This file provides a centralized location to manage various settings related to cookie consent, legal pages, and Google Analytics integration.

## Configuration Options

### URL Configuration

The `url` section defines the API route URLs for the package. Both `domain` and `middleware` are nullable and represent the same concepts as Laravel's routing parameters.

```php
'url' => [
    'domain' => null,
    'middleware' => [],
    'prefix' => 'cookie-consent',
],
```

### Consent Cookie Configuration

The `cookie` section configures the consent cookie used to track user preferences. The `duration` parameter represents the cookie's lifetime in minutes, and the `domain` parameter determines the cookie's activity domain.

```php
'cookie' => [
    'name' => Str::slug(env('APP_NAME', 'laravel'), '_').'_cookie_consent',
    'duration' => (60 * 24 * 365),
    'domain' => null,
],
```

### Legal Page Configuration

The `policy` section allows you to specify the route name of a dedicated page explaining the extended cookies usage policy.

```php
'policy' => null,
```

### Google Analytics Configuration

The `google_analytics` section enables integration with Google Analytics. The `id` parameter is required and represents your Google Analytics ID. The `anonymize_ip` parameter is optional and determines whether the user's IP address should be anonymized before being sent to Google Analytics.

```php
'google_analytics' => [
    'id' => env('GOOGLE_ANALYTICS_ID', ""),
    'anonymize_ip' => env('GOOGLE_ANALYTICS_ANONYMIZE_IP', true)
],
```

With this configuration file, you can manage various aspects of cookie consent and integration with Google Analytics in your PHP application.