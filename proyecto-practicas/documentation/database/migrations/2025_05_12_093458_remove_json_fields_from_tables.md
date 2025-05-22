# Documentation: 2025_05_12_093458_remove_json_fields_from_tables.php

Original file: `database/migrations\2025_05_12_093458_remove_json_fields_from_tables.php`

# `2025_05_12_093458_remove_json_fields_from_tables` Migration Documentation

**Table of Contents**
-----------------

* [Introduction](#introduction)
* [Up Method](#up-method)
* [Down Method](#down-method)

## Introduction
--------------

The `2025_05_12_093458_remove_json_fields_from_tables` migration is a part of the database schema management system. Its primary responsibility is to remove specific JSON fields from various tables in the database.

This migration uses Laravel's built-in migration and schema manipulation tools, providing a convenient way to modify the database structure without having to write raw SQL queries.

## Up Method
------------

The `up` method is called when the migration is executed. Its purpose is to make changes to the existing database schema.

### Removing JSON Fields
-------------------------

In this specific migration, we are removing the following JSON fields:

* `tutor_docente_id` from `tutores`
* `curso_id` from `titulacion`
* `asignatura_id` from `cursos`
* `tutor_docente_id` from `asignaturas`
* `asignatura` from `tareas`

The code for this method is as follows:
```php
Schema::table('tables', function (Blueprint $table) {
    Schema::table('tutores', function (Blueprint $table) {
        $table->dropColumn('tutor_docente_id');
    });

    Schema::table('titulacion', function (Blueprint $table) {
        $table->dropColumn('curso_id');
    });

    Schema::table('cursos', function (Blueprint $table) {
        $table->dropColumn('asignatura_id');
    });

    Schema::table('asignaturas', function (Blueprint $table) {
        $table->dropColumn('tutor_docente_id');
    });

    Schema::table('tareas', function (Blueprint $table) {
        $table->dropColumn('asignatura');
    });
});
```

## Down Method
------------

The `down` method is called when the migration is rolled back. Its purpose is to reverse any changes made by the `up` method.

### Reversing Changes
---------------------

In this specific migration, we are not making any changes in the `down` method because it's a one-way operation (i.e., removing JSON fields). Therefore, there's no need to reverse these changes.

The code for this method is as follows:
```php
Schema::table('tables', function (Blueprint $table) {
    // No changes are being made here.
});
```

By following the steps outlined in this documentation, developers can gain a comprehensive understanding of how to use and maintain this migration.