# Documentation: 2025_05_06_120711_delete_column_from_user.php

Original file: `database/migrations\2025_05_06_120711_delete_column_from_user.php`

# 2025_05_06_120711_delete_column_from_user Documentation

Table of Contents
=================

* [Introduction](#introduction)
* [Up Method](#up-method)
	+ [Purpose](#purpose)
	+ [Parameters and Return Values](#parameters-and-return-values)
	+ [Functionality](#functionality)
* [Down Method](#down-method)

Introduction
============

The `2025_05_06_120711_delete_column_from_user` migration script is used to delete two columns (`tutor_docente_id` and `tutor_laboral_id`) from the `alumnos` table, and then create foreign keys to the `users` table. This migration is part of a series of database schema changes aimed at improving data consistency and integrity.

Up Method
==========

### Purpose

The purpose of this method is to execute the necessary SQL commands to modify the `alumnos` table by dropping the two columns mentioned above, and then creating foreign keys to the `users` table. This will allow for more robust data relationships between the `alumnos` table and the `users` table.

### Parameters and Return Values

* No parameters are required.
* The method does not return any values.

### Functionality

The code block below shows the implementation of the `up` method:
```
Schema::table('alumnos', function (Blueprint $table) {
    $table->dropColumn(['tutor_docente_id']);
    $table->dropColumn(['tutor_laboral_id']);
    $table->foreignId('tutor_docente_id')->nullable()->constrained('users')->onDelete('cascade');
    $table->foreignId('tutor_laboral_id')->nullable()->constrained('users')->onDelete('cascade');
});
```
This code block uses the `Schema` facade to execute SQL commands on the `alumnos` table. It first drops the two columns (`tutor_docente_id` and `tutor_laboral_id`) using the `dropColumn` method. Then, it creates foreign keys to the `users` table for both columns.

Down Method
==========

### Purpose

The purpose of this method is to reverse the changes made by the `up` method. In this case, it does not drop any columns or create any foreign keys, as there are no corresponding changes to be reversed.

### Parameters and Return Values

* No parameters are required.
* The method does not return any values.

### Functionality

The code block below shows the implementation of the `down` method:
```
Schema::table('alumnos', function (Blueprint $table) {
    // No operations are performed in this method
});
```
This code block uses the `Schema` facade to execute SQL commands on the `alumnos` table, but no actual changes are made. This is because there are no corresponding changes to be reversed.

By following these steps, the `2025_05_06_120711_delete_column_from_user` migration script ensures that the `alumnos` table is modified correctly to improve data consistency and integrity.