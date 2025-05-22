# Documentation: 2025_05_12_092851_create_curso_titulacion_table.php

Original file: `database/migrations\2025_05_12_092851_create_curso_titulacion_table.php`

# `2025_05_12_092851_create_curso_titulacion_table` Documentation
===========================================================

Table of Contents
-----------------

* [Introduction](#introduction)
* [Migration Methods](#migration-methods)
	+ [up Method](#up-method)
	+ [down Method](#down-method)

Introduction
------------

The `2025_05_12_092851_create_curso_titulacion_table` migration file is responsible for creating the `curso_titulacion` table in the database. This table represents a many-to-many relationship between the `curso` and `titulacion` tables.

Migration Methods
-----------------

### up Method
------------

The `up` method is used to create the `curso_titulacion` table in the database. It does this by using the `Schema::create` method, which takes a callback function as an argument. This callback function is responsible for defining the structure of the table.

```
public function up(): void
{
    Schema::create('curso_titulacion', function (Blueprint $table) {
        // ...
    });
}
```

The `up` method defines three columns in the `curso_titulacion` table:

* `id`: A primary key column that auto-increments.
* `curso_id`: A foreign key column that references the `curso` table. The `onDelete('cascade')` clause specifies that if a record in the `curso` table is deleted, all related records in the `curso_titulacion` table should also be deleted.
* `titulacion_id`: A foreign key column that references the `titulacion` table. The `onDelete('cascade')` clause specifies that if a record in the `titulacion` table is deleted, all related records in the `curso_titulacion` table should also be deleted.

The `up` method also defines two timestamp columns: `created_at` and `updated_at`. These columns are used to track when each record was created and updated.

### down Method
------------

The `down` method is used to reverse the migration, i.e., drop the `curso_titulacion` table. This method uses the `Schema::dropIfExists` method to delete the table.

```
public function down(): void
{
    Schema::dropIfExists('curso_titulacion');
}
```

Conclusion
----------

The `2025_05_12_092851_create_curso_titulacion_table` migration file creates a many-to-many relationship between the `curso` and `titulacion` tables. This allows you to easily link courses with titulaciones and vice versa.