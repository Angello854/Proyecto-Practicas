# Documentation: session.php

Original file: `config/session.php`

# Session Configuration Documentation

**Table of Contents**
==================

* [Introduction](#introduction)
* [Session Driver](#session-driver)
* [Session Lifetime](#session-lifetime)
* [Session Encryption](#session-encryption)
* [Session File Location](#session-file-location)
* [Session Database Connection](#session-database-connection)
* [Session Database Table](#session-database-table)
* [Session Cache Store](#session-cache-store)
* [Session Sweeping Lottery](#session-sweeping-lottery)
* [Session Cookie Name](#session-cookie-name)
* [Session Cookie Path](#session-cookie-path)
* [Session Cookie Domain](#session-cookie-domain)
* [HTTPS Only Cookies](#https-only-cookies)
* [HTTP Access Only](#http-access-only)
* [Same-Site Cookies](#same-site-cookies)
* [Partitioned Cookies](#partitioned-cookies)

**Introduction**
===============

This file defines the configuration options for session management in a PHP application. The session manager is responsible for managing and persisting user sessions across requests.

**Session Driver**
==================

The `driver` option determines which storage mechanism to use for storing session data. Supported drivers include:

* `file`: Stores session data on disk
* `cookie`: Uses the browser's cookie store for session data
* `database`: Stores session data in a database
* `apc`, `memcached`, `redis`, `dynamodb`, and `array`: Use a cache store to store session data

The default driver is set to `database`.

**Session Lifetime**
====================

The `lifetime` option specifies the number of minutes that a user's session should remain active before it expires. The value is in minutes.

Example: `120`

**Session Encryption**
======================

The `encrypt` option determines whether all session data should be encrypted before storage. This provides an additional layer of security for sensitive information.

Example: `false`

**Session File Location**
=========================

When using the `file` driver, the `files` option specifies the location on disk where session files will be stored.

Example: `storage_path('framework/sessions')`

**Session Database Connection**
=============================

When using the `database` or `redis` drivers, the `connection` option specifies which database connection to use for storing sessions.

Example: `env('SESSION_CONNECTION')`

**Session Database Table**
==========================

When using the `database` driver, the `table` option specifies the table name where session data will be stored.

Example: `env('SESSION_TABLE', 'sessions')`

**Session Cache Store**
========================

When using a cache-driven session backend (e.g., `apc`, `memcached`, `redis`, or `dynamodb`), the `store` option specifies which cache store to use for storing session data.

Example: `env('SESSION_STORE')`

**Session Sweeping Lottery**
==========================

The `lottery` option determines the chances that the session manager will manually sweep its storage location to remove old sessions.

Example: `[2, 100]`

**Session Cookie Name**
=====================

The `cookie` option specifies the name of the session cookie created by the framework.

Example: `env('SESSION_COOKIE', Str::slug(env('APP_NAME', 'laravel'), '_').'_session')`

**Session Cookie Path**
=====================

The `path` option specifies the path for which the session cookie will be available.

Example: `env('SESSION_PATH', '/')`

**Session Cookie Domain**
=====================

The `domain` option determines the domain and subdomains for which the session cookie is available.

Example: `env('SESSION_DOMAIN')`

**HTTPS Only Cookies**
=====================

The `secure` option sets whether session cookies will only be sent back to the server if the browser has a HTTPS connection.

Example: `env('SESSION_SECURE_COOKIE', true)`

**HTTP Access Only**
=====================

The `http_only` option sets whether JavaScript should have access to the value of the cookie and whether it can be accessed through both HTTP and HTTPS protocols.

Example: `env('SESSION_HTTP_ONLY', true)`

**Same-Site Cookies**
=====================

The `same_site` option determines how cookies behave when cross-site requests take place. Supported values include:

* `lax`: Allow secure cross-site requests
* `strict`: Only allow same-origin requests
* `none`: Do not restrict cross-site requests
* `null`: Disable Same-Site cookies

Example: `env('SESSION_SAME_SITE', 'lax')`

**Partitioned Cookies**
=====================

The `partitioned` option sets whether the cookie is tied to the top-level site for a cross-site context.

Example: `env('SESSION_PARTITIONED_COOKIE', false)`

This file provides a comprehensive configuration options for session management in a PHP application. The session manager handles various aspects of session persistence and can be customized to suit specific requirements.