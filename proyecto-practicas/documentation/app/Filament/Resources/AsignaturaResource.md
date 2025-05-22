# Documentation: AsignaturaResource.php

Original file: `app/Filament\Resources\AsignaturaResource.php`

# AsignaturaResource Documentation

Table of Contents:
-------------------

1. [Introduction](#introduction)
2. [Class Methods](#class-methods)
	* [getEloquentQuery()](#geteloquentquery)
	* [form()](#form)
	* [table()](#table)
	* [getRelations()](#getrelations)
	* [getPages()](#getpages)

Introduction:
------------

The `AsignaturaResource` class is a part of the Filament framework, responsible for handling CRUD operations (Create, Read, Update, Delete) for the `Asignatura` model. This documentation aims to provide an in-depth overview of the class's functionality and behavior.

Class Methods:
----------------

### getEloquentQuery()

Purpose: Retrieves the Eloquent query builder for the `Asignatura` model.

Parameters: None

Return Value: An instance of `\Illuminate\Database\Eloquent\Builder`

Functionality:

* This method calls the parent's implementation to retrieve the default Eloquent query.
* If the current user has the `Tutor Docente` role, it applies a filter to only include `Asignaturas` that have professors assigned to them (i.e., whereHas('profesores', function ($q) { $q->where('users.id', getUserId()); }).
* Otherwise, it returns the default query.

### form()

Purpose: Creates and configures a Filament form for creating and editing `Asignatura` records.

Parameters: A single `$form` parameter representing the form to be configured.

Return Value: The configured form instance

Functionality:

* This method defines a schema for the form using Filament's `schema()` method.
* It includes three form components:
	+ `Hidden::make('id')`: Hides the ID field.
	+ `TextInput::make('nombre')`: Creates a text input field for the `nombre` attribute. It is required and disabled for users with roles other than `Admin`.
	+ `Select::make('profesores')`: Creates a multiple-select field for the `profesores` attribute. It is multiple, disabled for users with roles other than `Admin`, and preloads options from the `User` model (where 'rol' equals `'tutor_docente'`). The default value is an array of professor IDs.
	+ `Shout::make('importante')`: Displays a shout message on create actions.

### table()

Purpose: Configures a Filament table for displaying and filtering `Asignatura` records.

Parameters: A single `$table` parameter representing the table to be configured.

Return Value: The configured table instance

Functionality:

* This method defines a schema for the table using Filament's `columns()` and `filters()` methods.
* It includes three columns:
	+ `TextColumn::make('id')`: Displays the ID column. It is visible only for users with the `Admin` role.
	+ `TextColumn::make('nombre')`: Displays the `nombre` column.
	+ `TextColumn::make('profesores')`: Displays a column showing the list of professor names (joined by commas).
* It includes actions and bulk actions:
	+ `Tables\Actions\EditAction::make()`: Allows editing records.
	+ `Tables\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])`: Enables deleting multiple records at once.

### getRelations()

Purpose: Returns an array of relation manager classes for the `Asignatura` model.

Return Value: An array of strings representing the relation managers

Functionality:

* This method returns a single relation manager class, `ProfesoresRelationManager`.

### getPages()

Purpose: Returns an associative array mapping route names to page classes for the `AsignaturaResource`.

Return Value: A nested associative array with route names as keys and page classes as values

Functionality:

* This method defines three pages:
	+ `index`: Handles the `/` route, displaying a list of Asignaturas.
	+ `create`: Handles the `/create` route, allowing creation of new Asignatura records.
	+ `edit`: Handles the `/{record}/edit` route, enabling editing of existing Asignatura records.

By understanding these methods and their configurations, developers can effectively work with the `AsignaturaResource` class to create, read, update, and delete `Asignatura` records within their application.