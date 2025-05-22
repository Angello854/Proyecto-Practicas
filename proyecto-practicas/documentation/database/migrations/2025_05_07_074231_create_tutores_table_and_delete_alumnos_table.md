# Documentation: 2025_05_07_074231_create_tutores_table_and_delete_alumnos_table.php

Original file: `database/migrations\2025_05_07_074231_create_tutores_table_and_delete_alumnos_table.php`

# 2025_05_07_074231_create_tutores_table_and_delete_alumnos_table Documentation

## Table of Contents
[#Introduction](#introduction)
[#Migrations Method](#migrations-method)

### Introduction

The `2025_05_07_074231_create_tutores_table_and_delete_alumnos_table` migration is responsible for creating the `tutores` table and dropping the `alumnos` table. This file is part of the database migrations system, which allows for the modification and evolution of the database schema.

### Migrations Method

The `up()` method is executed when running a migration to create or modify the database schema. In this case, it performs two main tasks:

* Drops the foreign key on the `alumnos` table
* Creates the `tutores` table with its respective columns and relationships

Here's a detailed explanation of each step:

```
Schema::table('tareas', function (Blueprint $table) {
    $table->dropForeign(['alumno_id']);
});
```

* Drops the foreign key constraint on the `alumnos` table, which was previously used to link the `alumno_id` column with the `id` column in another table.

```
Schema::dropIfExists('alumnos');
```

* Drops the `alumnos` table from the database schema.

```
Schema::create('tutores', function (Blueprint $table) {
    // ...
});
```

* Creates a new table called `tutores`.
* The `alumno_id` column is set as the primary key and references the `id` column in the `users` table.
* The `tutor_laboral_id` and `tutor_docente_id` columns are both unsignedBigInteger columns, which can store a foreign key reference to another table. These fields are nullable.

The foreign key constraints are established with the following code:

```
$table->foreign('alumno_id')->references('id')->on('users')->onDelete('cascade');
$table->foreign('tutor_laboral_id')->references('id')->on('users')->onDelete('set null');
$table->foreign('tutor_docente_id')->references('id')->on('users')->onDelete('set null');
```

* The `alumno_id` column is a foreign key that references the `id` column in the `users` table. When this record is deleted, the entire row will be removed (cascade).
* The `tutor_laboral_id` and `tutor_docente_id` columns are also foreign keys that reference the `id` column in the `users` table. When these records are deleted, the corresponding values in these fields will be set to null.

The `down()` method is executed when rolling back a migration. In this case, it simply drops the `tutores` table:

```
public function down(): void
{
    Schema::dropIfExists('tutores');
}
```

This file provides a clear and accurate documentation of the database migrations process for creating the `tutores` table and dropping the `alumnos` table.