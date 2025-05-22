# Documentation: 2025_05_14_073513_change_horas_column_type_in_tareas_table.php

Original file: `database/migrations\2025_05_14_073513_change_horas_column_type_in_tareas_table.php`

# `ChangeHorasColumnTypeInTareasTable` Documentation

## Table of Contents
[#introduction](#introduction)
[#Up Migration Method](#up-migration-method)
[#Down Migration Method](#down-migration-method)

## Introduction
The `2025_05_14_073513_change_horas_column_type_in_tareas_table.php` file is a part of the migration process in an Laravel-based application. This script changes the data type of the `horas` column in the `tareas` table from integer to float.

## Up Migration Method
### Purpose
The `up` method runs during the database migration process and makes the necessary changes to the `tareas` table.

### Parameters
None

### Return Values
None

### Functionality
This method uses the `Schema` facade to modify the `horas` column in the `tareas` table. It changes the column type from integer to float, allowing for a higher degree of precision when storing time-related data.

```php
public function up(): void
{
    Schema::table('tareas', function (Blueprint $table) {
        $table->float('horas', 4)->change();
    });
}
```

## Down Migration Method
### Purpose
The `down` method runs during the database migration process and reverses any changes made by the `up` method.

### Parameters
None

### Return Values
None

### Functionality
This method uses the `Schema` facade to modify the `horas` column in the `tareas` table. It changes the column type from float back to integer, effectively reversing the changes made by the `up` method.

```php
public function down(): void
{
    Schema::table('tareas', function (Blueprint $table) {
        $table->integer('horas')->change();
    });
}
```

By modifying the data type of the `horas` column, this migration ensures that time-related data is accurately stored and retrieved in the application.