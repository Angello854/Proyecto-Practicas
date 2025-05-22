# Documentation: 2025_05_08_120114_cambiar_claves_foraneas_otrave.php

Original file: `database/migrations\2025_05_08_120114_cambiar_claves_foraneas_otrave.php`

# `2025_05_08_120114_cambiar_claves_foraneas_otrave` Documentation
======================================================

Table of Contents
-----------------

* [Introduction](#introduction)
* [Method: `up()`](#method-up)
	+ [Purpose and Parameters](#purpose-and-parameters)
	+ [Functionality](#functionality)

Introduction
------------

This migration file, named `2025_05_08_120114_cambiar_claves_foraneas_otrave`, is part of the database migration process in a PHP application using Laravel. Its primary purpose is to modify the relationships between tables by changing foreign key constraints.

Method: `up()`
-------------

### Purpose and Parameters

The `up()` method is responsible for executing the necessary database changes when running this migration file. It takes no explicit parameters, as it relies on the underlying database schema to perform its tasks.

### Functionality

This method modifies the `tutores` table by:

1.  Ensuring that specific columns (`tutor_docente_id`, `tutor_laboral_id`, and `empresa_id`) allow null values.
2.  Dropping existing foreign key constraints for these columns (`tutor_docente_id`, `tutor_laboral_id`, and `empresa_id`).
3.  Re-adding the same foreign key constraints, but this time with `onDelete('set null')`. This means that when the referenced records are deleted, the corresponding values in the `tutores` table will be set to null.

```php
Schema::table('tutores', function (Blueprint $table) {
    // ...
    $table->dropForeign(['tutor_docente_id']);
    $table->dropForeign(['tutor_laboral_id']);
    $table->dropForeign(['empresa_id']);

    // Re-add the foreign key constraints with 'set null'
    $table->foreign('tutor_docente_id')->references('id')->on('users')->onDelete('set null');
    $table->foreign('tutor_laboral_id')->references('id')->on('users')->onDelete('set null');
    $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('set null');
});
```

That's it! This documentation should provide a clear understanding of the purpose and functionality of this migration file.