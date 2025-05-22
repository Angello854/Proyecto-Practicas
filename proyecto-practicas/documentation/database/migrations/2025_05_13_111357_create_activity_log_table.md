# Documentation: 2025_05_13_111357_create_activity_log_table.php

Original file: `database/migrations\2025_05_13_111357_create_activity_log_table.php`

# CreateActivityLogTable Documentation

**Table of Contents**
1. [Introduction](#introduction)
2. [Create Activity Log Table Method](#create-activity-log-table-method)

## Introduction
The `CreateActivityLogTable` class is a database migration that creates an activity log table in the specified database connection. This table stores information about various activities performed within the system, allowing for tracking and auditing purposes.

## Create Activity Log Table Method

### Purpose
This method creates a new activity log table with the specified columns and indexes.

### Parameters and Return Values
* `none` (no parameters are required)
* Returns `void`

### Functionality
The method uses the `Schema::connection()` facade to connect to the database connection specified in the `config('activitylog.database_connection')` configuration. It then creates a new table with the name specified in `config('activitylog.table_name')`, using the `Blueprint` object to define the table structure.

The table columns are:

* `id`: A big integer primary key.
* `log_name`: A string column for storing the log name, nullable.
* `description`: A text column for storing a brief description of the activity.
* `subject`: A morphs column that references the subject of the activity (e.g., a user or a product).
* `causer`: A morphs column that references the causer of the activity (e.g., a user or a system process).
* `properties`: A JSON column for storing additional properties related to the activity, nullable.
* `timestamps`: Timestamp columns for recording when the activity occurred.

The method also creates an index on the `log_name` column for efficient querying and filtering.

### Code Snippet
```php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    public function up()
    {
        Schema::connection(config('activitylog.database_connection'))->create(
            config('activitylog.table_name'),
            function (Blueprint $table) {
                // ...
            }
        );
    }

    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
    }
}
```

**Note**: The `down` method is responsible for reverting the changes made by the `up` method in case of a rollback.