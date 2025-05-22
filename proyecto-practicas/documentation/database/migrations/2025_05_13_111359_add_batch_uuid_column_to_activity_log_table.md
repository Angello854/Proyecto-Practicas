# Documentation: 2025_05_13_111359_add_batch_uuid_column_to_activity_log_table.php

Original file: `database/migrations\2025_05_13_111359_add_batch_uuid_column_to_activity_log_table.php`

# AddBatchUuidColumnToActivityLogTable Documentation
=====================================================

[TOC](#table-of-contents)

## Introduction
--------------

The `AddBatchUuidColumnToActivityLogTable` migration class is responsible for adding a new column named `batch_uuid` to the `activity_log` table in the database. This change is part of a larger effort to enhance the logging mechanism and provide additional context for auditing purposes.

### Table of Contents
-------------------

* [Overview](#overview)
* [Up Method](#up-method)
* [Down Method](#down-method)

## Overview
----------

This migration class extends the `Migration` class provided by Laravel's Eloquent ORM. Its primary purpose is to modify the `activity_log` table by adding a new column named `batch_uuid`.

### Up Method
-------------

The `up()` method is called when the migration is executed and marks the beginning of the migration process.

```php
public function up()
{
    Schema::connection(config('activitylog.database_connection'))->table(config('activitylog.table_name'), function (Blueprint $table) {
        $table->uuid('batch_uuid')->nullable()->after('properties');
    });
}
```

* Parameters:
	+ `Schema`: The Laravel schema facade used to interact with the database.
	+ `config('activitylog.database_connection')`: The name of the database connection configured in the application's `config/activitylog.php` file.
	+ `config('activitylog.table_name')`: The name of the table being modified.
* Return values: None
* Functionality:
	+ Adds a new column named `batch_uuid` to the `activity_log` table with a data type of UUID and allows it to be nullable. The column is placed after the existing `properties` column.

### Down Method
--------------

The `down()` method is called when the migration needs to be reverted, i.e., rolled back to its previous state.

```php
public function down()
{
    Schema::connection(config('activitylog.database_connection'))->table(config('activitylog.table_name'), function (Blueprint $table) {
        $table->dropColumn('batch_uuid');
    });
}
```

* Parameters:
	+ `Schema`: The Laravel schema facade used to interact with the database.
	+ `config('activitylog.database_connection')`: The name of the database connection configured in the application's `config/activitylog.php` file.
	+ `config('activitylog.table_name')`: The name of the table being modified.
* Return values: None
* Functionality:
	+ Drops the existing `batch_uuid` column from the `activity_log` table.

By following this migration, the `activity_log` table will be updated with a new column to store batch UUIDs. This change enables more advanced logging and auditing capabilities in the application.