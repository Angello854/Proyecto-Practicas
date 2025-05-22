# Documentation: 2025_05_07_091219_empresa_id_tutores.php

Original file: `database/migrations\2025_05_07_091219_empresa_id_tutores.php`

# `2025_05_07_091219_empresa_id_tutores` Migration Documentation

**Table of Contents**
=====================

* [Introduction](#introduction)
* [Up Method](#up-method)
* [Down Method](#down-method)

**Introduction**
==============

The `2025_05_07_091219_empresa_id_tutores` migration is a part of the database schema management system in our PHP application. Its primary purpose is to add a new column, `empresa_id`, to the `tutores` table and establish a foreign key relationship with the `empresas` table.

**Up Method**
------------

The `up` method is responsible for making changes to the database schema during the migration process.

### Purpose
----------

This method adds an unsigned big integer (UBI) column named `empresa_id` to the `tutores` table. The column is nullable and is placed after the existing `tutor_docente_id` column.

### Parameters and Return Values
-------------------------------

* No parameters are required for this method.
* The method does not return any values.

### Functionality
--------------

The `up` method uses the Schema facade to make changes to the database schema. Specifically, it adds a new UBI column named `empresa_id` to the `tutores` table and establishes a foreign key relationship with the `empresas` table.

```
Schema::table('tutores', function (Blueprint $table) {
    $table->unsignedBigInteger('empresa_id')->nullable()->after('tutor_docente_id');

    $table->foreign('empresa_id')
        ->references('id')
        ->on('empresas')
        ->onDelete('set null');
});
```

**Down Method**
-------------

The `down` method is responsible for reverting the changes made during the `up` method.

### Purpose
----------

This method does not make any explicit changes to the database schema. Instead, it simply leaves the schema as it was before the migration was applied.

### Parameters and Return Values
-------------------------------

* No parameters are required for this method.
* The method does not return any values.

### Functionality
--------------

The `down` method is intentionally left empty, as it does not need to perform any operations to revert the changes made during the `up` method. This means that when this migration is rolled back, no changes will be made to the database schema.

```
public function down(): void
{
    //
}
```

By following these steps, the `2025_05_07_091219_empresa_id_tutores` migration ensures that the relationship between the `tutores` and `empresas` tables is properly established, allowing for efficient data retrieval and manipulation.