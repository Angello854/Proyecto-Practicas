# Documentation: 2025_05_06_073055_change_foreign_key_tareas.php

Original file: `database/migrations\2025_05_06_073055_change_foreign_key_tareas.php`

# `2025_05_06_073055_change_foreign_key_tareas` Documentation

**Table of Contents**
-------------------

* [Introduction](#introduction)
* [Method: `up()`](#up-method)
	+ [Purpose](#purpose-of-up-method)
	+ [Parameters and Return Values](#parameters-and-return-values-of-up-method)
	+ [Functionality](#functionality-of-up-method)
* [Method: `down()`](#down-method)

**Introduction**
---------------

The `2025_05_06_073055_change_foreign_key_tareas` file is a migration script for the Laravel framework. This script changes the foreign key in the `tareas` table to reference the `alumnos` table instead of dropping the column entirely.

**Method: `up()`**
-----------------

### Purpose
The `up()` method runs the migration and makes the necessary changes to the database schema.

### Parameters and Return Values
No parameters are required for this method. It returns `void`, indicating that it does not return any value.

### Functionality
This method drops the existing foreign key constraint on the `alumno_id` column, drops the column itself, and then adds a new foreign key constraint referencing the `alumnos` table. The new foreign key is nullable and has a cascade delete set up to ensure that when an associated record in the `alumnos` table is deleted, all related records in the `tareas` table are also deleted.

```php
Schema::table('tareas', function (Blueprint $table) {
    $table->dropForeign(['alumno_id']);
    $table->dropColumn(['alumno_id']);
    $table->foreignId('alumno_id')->nullable()->constrained('alumnos')->onDelete('cascade');
});
```

**Method: `down()`**
------------------

### Purpose
The `down()` method reverts the changes made in the `up()` method.

### Parameters and Return Values
No parameters are required for this method. It returns `void`, indicating that it does not return any value.

### Functionality
This method is currently empty, meaning it does not perform any actions to revert the changes made by the `up()` method. To properly reverse the migration, this method should be implemented to restore the original state of the database schema before running the `up()` method for the first time.

**Conclusion**
-------------

The `2025_05_06_073055_change_foreign_key_tareas` script is a crucial part of maintaining data integrity in your application. By understanding its purpose and functionality, developers can use this migration to make targeted changes to their database schema as needed.