# Documentation: 2025_05_05_094457_add_foreign_keys_to_alumnos_and_tareas.php

Original file: `database/migrations\2025_05_05_094457_add_foreign_keys_to_alumnos_and_tareas.php`

# `2025_05_05_094457_add_foreign_keys_to_alumnos_and_tareas` Documentation

**Table of Contents**
-------------------

* [Introduction](#introduction)
* [Up Method](#up-method)
	+ [Adding Foreign Keys to `alumnos` Table](#adding-foreign-keys-to-alumnos-table)
	+ [Adding Foreign Key to `tareas` Table](#adding-foreign-key-to-tareas-table)
* [Down Method](#down-method)
	+ [Dropping Foreign Keys from `alumnos` Table](#dropping-foreign-keys-from-alumnos-table)
	+ [Dropping Foreign Key from `tareas` Table](#dropping-foreign-key-from-tareas-table)

**Introduction**
----------------

The `2025_05_05_094457_add_foreign_keys_to_alumnos_and_tareas` migration script is responsible for adding foreign keys to the `alumnos` and `tareas` tables in a Laravel-based application. This script is part of the database schema's evolution process, allowing developers to create a consistent data structure across different environments.

**Up Method**
-------------

The `up` method is called when the migration is executed, and it contains the logic for adding foreign keys to the `alumnos` and `tareas` tables. Here's a detailed explanation of what each section does:

### Adding Foreign Keys to `alumnos` Table
-----------------------------------------

This part of the script adds three foreign key constraints to the `alumnos` table:

```php
Schema::table('alumnos', function (Blueprint $table) {
    // ...
});
```

*   `$table->foreignId('tutor_docente_id')->nullable()->constrained('tutores_docentes')->onDelete('cascade');`: This line adds a foreign key constraint to the `alumnos` table's `tutor_docente_id` column, referencing the `id` column of the `tutores_docentes` table. The `->nullable()` parameter allows the foreign key to be null, and the `->constrained('tutores_docentes')` method specifies the referenced table.
*   `$table->foreignId('tutor_laboral_id')->nullable()->constrained('tutores_laborales')->onDelete('cascade');`: This line adds another foreign key constraint to the `alumnos` table's `tutor_laboral_id` column, referencing the `id` column of the `tutores_laborales` table.
*   `$table->foreignId('empresa_id')->nullable()->constrained('empresas')->onDelete('cascade');`: This line adds a third foreign key constraint to the `alumnos` table's `empresa_id` column, referencing the `id` column of the `empresas` table.

### Adding Foreign Key to `tareas` Table
------------------------------------------

This part of the script adds one foreign key constraint to the `tareas` table:

```php
Schema::table('tareas', function (Blueprint $table) {
    // ...
});
```

*   `$table->foreignId('alumno_id')->constrained('alumnos')->onDelete('cascade');`: This line adds a foreign key constraint to the `tareas` table's `alumno_id` column, referencing the `id` column of the `alumnos` table.

**Down Method**
----------------

The `down` method is called when the migration is rolled back, and it contains the logic for dropping the foreign keys that were added in the `up` method. Here's a detailed explanation of what each section does:

### Dropping Foreign Keys from `alumnos` Table
---------------------------------------------

This part of the script drops the three foreign key constraints that were added to the `alumnos` table in the `up` method:

```php
Schema::table('alumnos', function (Blueprint $table) {
    // ...
});
```

*   `$table->dropForeign(['tutor_docente_id']);`: This line drops the foreign key constraint on the `tutor_docente_id` column.
*   `$table->dropForeign(['tutor_laboral_id']);`: This line drops the foreign key constraint on the `tutor_laboral_id` column.
*   `$table->dropForeign(['empresa_id']);`: This line drops the foreign key constraint on the `empresa_id` column.

### Dropping Foreign Key from `tareas` Table
---------------------------------------------

This part of the script drops the one foreign key constraint that was added to the `tareas` table in the `up` method:

```php
Schema::table('tareas', function (Blueprint $table) {
    // ...
});
```

*   `$table->dropForeign(['alumno_id']);`: This line drops the foreign key constraint on the `alumno_id` column.

By following this documentation, developers should have a clear understanding of how to use the `2025_05_05_094457_add_foreign_keys_to_alumnos_and_tareas` migration script and its role in maintaining the database schema.