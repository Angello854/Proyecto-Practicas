# Documentation: 2025_05_06_092212_add_telefono_and_rol_to_users_table.php

Original file: `database/migrations\2025_05_06_092212_add_telefono_and_rol_to_users_table.php`

# `2025_05_06_092212_add_telefono_and_rol_to_users_table` Migration Documentation
=====================================================

## Table of Contents
* [Introduction](#introduction)
* [Migration Methodology](#migration-methodology)
	+ [up Method](#up-method)
	+ [down Method](#down-method)

## Introduction
This PHP file defines a database migration that adds two new columns to the `users` table: `telefono` and `rol`. This migration is part of the Laravel framework's Eloquent ORM.

## Migration Methodology
The migration is implemented as an instance of the `Illuminate\Database\Migrations\Migration` class, which provides methods for executing database operations.

### up Method
The `up` method is called when the migration is executed to add or modify database tables. This method executes a series of database operations using the `Schema::table` and `Blueprint` classes from Laravel's Eloquent ORM.

```php
Schema::table('users', function (Blueprint $table) {
    Schema::table('users', function (Blueprint $table) {
        $table->string('telefono')->nullable();
        $table->string('rol');
    });
});
```

This code adds two new columns to the `users` table:

*   `telefono`: a string column that can be null
*   `rol`: a string column

### down Method
The `down` method is called when the migration is reversed or rolled back. This method executes database operations to reverse the changes made in the `up` method.

```php
Schema::table('users', function (Blueprint $table) {
});
```

In this case, since we only added columns and didn't modify any existing data, there's no need to execute any specific SQL queries in the `down` method. The database table will be left unchanged when the migration is rolled back.

## Conclusion
This migration adds two new columns (`telefono` and `rol`) to the `users` table. It provides a simple example of how to use Laravel's Eloquent ORM to modify database schema.