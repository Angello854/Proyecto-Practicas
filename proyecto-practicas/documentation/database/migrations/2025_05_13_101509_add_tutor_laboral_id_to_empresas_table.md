# Documentation: 2025_05_13_101509_add_tutor_laboral_id_to_empresas_table.php

Original file: `database/migrations\2025_05_13_101509_add_tutor_laboral_id_to_empresas_table.php`

# 2025_05_13_101509_add_tutor_laboral_id_to_empresas_table Documentation

**Table of Contents**
-----------------

* [Introduction](#introduction)
* [up Method](#up-method)
* [down Method](#down-method)

## Introduction
--------------

The `add_tutor_laboral_id_to_empresas_table` migration file is designed to add a foreign key column named `tutor_laboral_id` to the `empresas` table in the database. This modification enables the establishment of relationships between empresa records and corresponding user records.

### Purpose
---------

The purpose of this file is to create a new column in the `empresas` table that references the `id` column in the `users` table, allowing for efficient data retrieval and manipulation.

## up Method
------------

### Purpose
---------

The `up` method executes when the migration is applied. Its primary function is to add the `tutor_laboral_id` foreign key column to the `empresas` table and establish a reference with the `users` table.

### Parameters and Return Values
--------------------------------

* No parameters are passed.
* The method does not return any value.

### Functionality
--------------

The `up` method uses the Schema facade to modify the `empresas` table. Specifically, it:
```php
Schema::table('empresas', function (Blueprint $table) {
    $table->unsignedBigInteger('tutor_laboral_id')->nullable()->after('id');
    $table->foreign('tutor_laboral_id')->references('id')->on('users')->onDelete('set null');
});
```
1. Adds an `unsignedBigInteger` column named `tutor_laboral_id` to the `empresas` table, making it nullable and positioning it after the existing `id` column.
2. Establishes a foreign key reference between the `tutor_laboral_id` column and the `id` column in the `users` table.

## down Method
------------

### Purpose
---------

The `down` method executes when the migration is rolled back. Its primary function is to reverse the changes made by the `up` method, effectively dropping the `tutor_laboral_id` foreign key column from the `empresas` table.

### Parameters and Return Values
--------------------------------

* No parameters are passed.
* The method does not return any value.

### Functionality
--------------

The `down` method uses the Schema facade to modify the `empresas` table. Specifically, it:
```php
Schema::table('empresas', function (Blueprint $table) {
    $table->dropForeign(['tutor_laboral_id']);
    $table->dropColumn('tutor_laboral_id');
});
```
1. Drops the foreign key constraint established in the `up` method.
2. Deletes the `tutor_laboral_id` column from the `empresas` table.

By understanding this documentation, developers should be able to effectively utilize and maintain the codebase, ensuring that the relationships between empresa records and corresponding user records are properly established and managed.