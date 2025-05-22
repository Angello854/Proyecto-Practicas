# Documentation: 2025_05_12_064322_change_tutor_docente_id_to_json_in_tutores.php

Original file: `database/migrations\2025_05_12_064322_change_tutor_docente_id_to_json_in_tutores.php`

# 2025_05_12_064322_change_tutor_docente_id_to_json_in_tutores Documentation
===========================================================

Table of Contents
-----------------

* [Introduction](#introduction)
* [Up Method](#up-method)
* [Down Method](#down-method)

Introduction
------------

This file is a migration script for the `tutores` table in a Laravel application. It updates the `tutor_docente_id` column to store JSON data instead of integers. This change allows for more flexibility and extensibility in storing tutor information.

Up Method
---------

The `up` method is responsible for making the necessary changes to the database schema.

### Purpose

The purpose of this method is to update the `tutores` table by dropping any foreign key constraints on the `tutor_docente_id` column, alter the column type to store JSON data, and reset any default values.

### Parameters and Return Values

* No parameters are required.
* The method does not return any value.

### Functionality

The method performs the following steps:

1. Drops any foreign key constraints on the `tutor_docente_id` column using the `dropForeign` method.
2. Alters the `tutor_docente_id` column type to store JSON data using the `alterColumn` method and the `DB::statement` method.

```php
Schema::table('tutores', function (Blueprint $table) {
    Schema::table('tutores', function ($table) {
        $table->dropForeign(['tutor_docente_id']);
    });

    DB::statement('ALTER TABLE tutores ALTER COLUMN tutor_docente_id DROP DEFAULT;');
    DB::statement('ALTER TABLE tutores ALTER COLUMN tutor_docente_id TYPE json USING to_json(tutor_docente_id);');;
});
```

Down Method
------------

The `down` method is responsible for reverting the changes made by the `up` method.

### Purpose

The purpose of this method is to revert the changes made in the `up` method, effectively rolling back the migration.

### Parameters and Return Values

* No parameters are required.
* The method does not return any value.

### Functionality

The method performs the following step:

1. Alters the `tutor_docente_id` column type to store integer data using the `alterColumn` method and the `DB::statement` method, effectively rolling back the migration.

```php
Schema::table('tutores', function (Blueprint $table) {
    DB::statement('ALTER TABLE tutores ALTER COLUMN tutor_docente_id TYPE integer USING (tutor_docente_id::integer);');
});
```

Conclusion
----------

This file is a critical component of the `tutores` table migration process. The `up` method updates the schema to store JSON data, while the `down` method reverts this change.