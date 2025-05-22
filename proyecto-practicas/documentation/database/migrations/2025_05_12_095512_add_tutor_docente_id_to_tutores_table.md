# Documentation: 2025_05_12_095512_add_tutor_docente_id_to_tutores_table.php

Original file: `database/migrations\2025_05_12_095512_add_tutor_docente_id_to_tutores_table.php`

# 2025_05_12_095512_add_tutor_docente_id_to_tutores_table.php Documentation

**Table of Contents**
==================

* [Introduction](#introduction)
* [Up Method](#up-method)
* [Down Method](#down-method)

**Introduction**
===============

The `2025_05_12_095512_add_tutor_docente_id_to_tutores_table.php` file is a database migration script used to add the `tutor_docente_id` column to the `tutores` table. This migration is part of the system's database schema evolution.

**Up Method**
==========

The `up` method runs when the migration is executed, and it creates a new table called `asignatura_profesor`. The table has four columns:

* `id`: An auto-incrementing primary key.
* `asignatura_id`: A foreign key referencing the `id` column of the `asignaturas` table. This establishes a many-to-one relationship between asignaturas and profesores.
* `profesor_id`: A foreign key referencing the `id` column of the `users` table, which represents the tutors. This establishes a many-to-one relationship between usuarios and asignatura_profesor.
* `timestamps`: Two columns to store the creation and update timestamps for the records in this table.

Here is the code for the up method:
```
Schema::create('asignatura_profesor', function (Blueprint $table) {
    $table->id();
    $table->foreignId('asignatura_id')->constrained()->onDelete('cascade');
    $table->foreignId('profesor_id')->constrained('users')->onDelete('cascade');
    $table->timestamps();
});
```
**Down Method**
==========

The `down` method is used to revert the changes made by the up method. In this case, it drops the `alumno_tutor_docente` table, which was created in a previous migration.

Here is the code for the down method:
```
Schema::dropIfExists('alumno_tutor_docente');
```
Note that the down method does not include any specific actions to revert the changes made by the up method. This means that when this migration is rolled back, it will effectively undo all of its changes.