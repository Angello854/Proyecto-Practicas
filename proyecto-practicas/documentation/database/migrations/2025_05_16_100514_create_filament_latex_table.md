# Documentation: 2025_05_16_100514_create_filament_latex_table.php

Original file: `database/migrations\2025_05_16_100514_create_filament_latex_table.php`

# 2025_05_16_100514_create_filament_latex_table Documentation

**Table of Contents**

* [Introduction](#introduction)
* [Migration Methodology](#migration-methodology)
	+ [Up Method](#up-method)
	+ [Down Method](#down-method)

## Introduction

This documentation covers the `2025_05_16_100514_create_filament_latex_table` migration, which creates a new table in the database named `filament-latex`. This table is used to store information about LaTeX documents and their associated authors, collaborators, and attachments.

## Migration Methodology

The `2025_05_16_100514_create_filament_latex_table` migration is responsible for creating and managing the `filament-latex` table in the database. It uses the Laravel's built-in migration system to perform these operations.

### Up Method

The `up` method is called when the migration is executed, and it is responsible for creating the `filament-latex` table. The following code snippet shows the implementation of this method:
```php
public function up(): void
{
    Schema::create('filament-latex', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('content')->nullable();
        $table->dateTime('deadline');
        $table->bigInteger('author_id');
        $table->json('collaborators_id')->nullable();
        $table->json('attachment')->nullable();
        $table->json('attachment_file_names')->nullable();
        $table->timestamps();
    });
}
```
This method uses the `Schema::create` method to create a new table named `filament-latex`. The table has several columns, including an auto-incrementing primary key, a string column for the document's name, a text column for the document's content (which can be null), a datetime column for the deadline, and three JSON columns for storing collaborators' IDs, attachments, and attachment file names.

### Down Method

The `down` method is called when the migration is rolled back, and it is responsible for dropping the `filament-latex` table. The following code snippet shows the implementation of this method:
```php
public function down(): void
{
    Schema::dropIfExists('filament-latex');
}
```
This method uses the `Schema::dropIfExists` method to drop the `filament-latex` table.

That's it! With this documentation, you should have a good understanding of how the `2025_05_16_100514_create_filament_latex_table` migration works and what its purpose is.