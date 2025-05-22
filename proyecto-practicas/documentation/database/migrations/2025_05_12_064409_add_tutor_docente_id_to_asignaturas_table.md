# Documentation: 2025_05_12_064409_add_tutor_docente_id_to_asignaturas_table.php

Original file: `database/migrations\2025_05_12_064409_add_tutor_docente_id_to_asignaturas_table.php`

# 2025_05_12_064409_add_tutor_docente_id_to_asignaturas_table Documentation
=====================================

## Table of Contents
---------------

* [Introduction](#introduction)
* [Migration Class](#migration-class)
	+ [Up Method](#up-method)
	+ [Down Method](#down-method)

## Introduction
-------------

This documentation explains the purpose and functionality of the `2025_05_12_064409_add_tutor_docente_id_to_asignaturas_table.php` file, which is a migration file used to add a new column named `tutor_docente_id` to the `asignaturas` table in the database.

## Migration Class
----------------

The `2025_05_12_064409_add_tutor_docente_id_to_asignaturas_table` class extends the `Illuminate\Database\Migrations\Migration` class, which provides methods for executing database migrations. The class contains two main methods: `up()` and `down()`.

### Up Method
-------------

The `up()` method is executed when a migration is applied to the database. In this case, it adds a new column named `tutor_docente_id` to the `asignaturas` table using the `Schema::table()` method:

```php
public function up(): void
{
    Schema::table('asignaturas', function (Blueprint $table) {
        $table->json('tutor_docente_id')->nullable()->after('id');
    });
}
```

This method creates a new column with the following characteristics:

* Column name: `tutor_docente_id`
* Data type: JSON
* Nullability: Optional (`nullable`)
* Position in the table: After the existing `id` column

### Down Method
--------------

The `down()` method is executed when a migration is reverted, i.e., rolled back. In this case, it drops the newly added `tutor_docente_id` column from the `asignaturas` table using the `Schema::table()` method:

```php
public function down(): void
{
    Schema::table('asignaturas', function (Blueprint $table) {
        $table->dropColumn('tutor_docente_id');
    });
}
```

This method removes the `tutor_docente_id` column from the `asignaturas` table.

## Conclusion
----------

In summary, this migration file adds a new JSON column named `tutor_docente_id` to the `asignaturas` table and provides a way to roll back this change by dropping the column.