# Documentation: 2025_05_07_101751_create_tutores_table.php

Original file: `database/migrations\2025_05_07_101751_create_tutores_table.php`

# `2025_05_07_101751_create_tutores_table` Documentation

Table of Contents:
==================

* [Introduction](#introduction)
* [Up Method](#up-method)
* [Down Method](#down-method)

## Introduction
-------------

The `2025_05_07_101751_create_tutores_table` file is a migration script that creates the `tutores` table in the database. This table stores information about tutors, including their relationships with students, companies, and other users.

## Up Method
------------

The `up` method is responsible for creating the `tutores` table. It uses the `Schema::create` method to define the table's structure.

```php
public function up(): void
{
    Schema::create('tutores', function (Blueprint $table) {
        // Table definition goes here
    });
}
```

### Table Definition
-------------------

The table has five columns:

* `alumno_id`: A primary key that references the `id` column in the `users` table.
* `tutor_laboral_id`: A foreign key that references the `id` column in the `users` table.
* `tutor_docente_id`: A foreign key that references the `id` column in the `users` table.
* `empresa_id`: A foreign key that references the `id` column in the `empresas` table.

The table also has five foreign key constraints:

* `alumno_id` is a primary key and a foreign key that references the `id` column in the `users` table.
* The other four columns are foreign keys that reference the `id` column in the `users`, `tutores`, or `empresas` tables.

### Foreign Key Constraints
-------------------------

The following foreign key constraints are defined:

| Column | References | On Delete |
|--------|-----------|----------|
| alumno_id | users.id | cascade |
| tutor_docente_id | users.id | cascade |
| tutor_laboral_id | users.id | cascade |
| empresa_id | empresas.id | cascade |

These constraints ensure that when a record is deleted from the `users`, `tutores`, or `empresas` tables, any related records in the `tutores` table are also deleted.

## Down Method
-------------

The `down` method is responsible for reversing the migrations. In this case, it drops the `tutores` table if it exists.

```php
public function down(): void
{
    Schema::dropIfExists('tutores');
}
```

This method ensures that when the migration is rolled back, the `tutores` table is removed from the database.

That's it! This documentation should provide a comprehensive overview of the `2025_05_07_101751_create_tutores_table` file and its functionality.