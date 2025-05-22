# Documentation: TitulacionResource.php

Original file: `app/Filament\Resources\TitulacionResource.php`

# TitulacionResource Documentation

**Table of Contents**
------------------

* [Introduction](#introduction)
* [Methods](#methods)
	+ [getPluralModelLabel](#getpluralmodellabel)
	+ [getEloquentQuery](#geteloquentquery)
	+ [form](#form)
	+ [table](#table)
	+ [getRelations](#getrelations)
	+ [getPages](#getpages)

**Introduction**
---------------

The `TitulacionResource` class is a part of the Filament framework and serves as a resource for handling Titulaciones (academic degrees) in the system. This documentation aims to provide an overview of the class's purpose, methods, and functionality.

**Methods**
---------

### getPluralModelLabel
------------------------

* Purpose: Returns the plural label for the Titulacion model.
* Parameters: None
* Return value: A string representing the plural label.
* Description: This method returns the plural label "titulaciones" which is used to display the correct verb form when referring to multiple Titulaciones.

### getEloquentQuery
--------------------

* Purpose: Returns an eloquent query builder instance for retrieving Titulacion records.
* Parameters: None
* Return value: An `Illuminate\Database\Eloquent\Builder` instance.
* Description: This method returns a query builder instance that can be used to retrieve Titulacion records. The query is filtered based on the current user's role, showing only relevant records to the user.

### form
---------

* Purpose: Defines a form schema for creating and editing Titulacion records.
* Parameters: A `Filament\Forms\Form` instance.
* Return value: The same `Filament\Forms\Form` instance.
* Description: This method defines a form with several fields:
	+ `nombre`: A text input field for the Titulacion's name, which is required and disabled for non-admin users.
	+ `cursos`: A select field for choosing courses associated with the Titulacion, which is multiple and disabled for non-admin users. The options are populated from the `Curso` model.
* Validation: The form validates the `nombre` field as required, and provides custom validation messages.

### table
---------

* Purpose: Defines a table schema for displaying Titulacion records.
* Parameters: A `Filament\Tables\Table` instance.
* Return value: The same `Filament\Tables\Table` instance.
* Description: This method defines a table with three columns:
	+ `id`: A text column displaying the Titulacion's ID, visible only for admin users.
	+ `nombre`: A text column displaying the Titulacion's name.
	+ `cursos`: A text column displaying the associated courses' names, computed using the `getStateUsing` method.

### getRelations
----------------

* Purpose: Returns an array of relation managers for handling relationships with other models.
* Parameters: None
* Return value: An array of relation manager classes.
* Description: This method returns an array containing a single relation manager class, `CursosRelationManager`, which handles the relationship between Titulaciones and courses.

### getPages
-------------

* Purpose: Returns an array of page definitions for handling CRUD operations.
* Parameters: None
* Return value: An array of page route definitions.
* Description: This method returns an array containing three page route definitions:
	+ `index`: A list page for displaying all Titulaciones.
	+ `create`: A create page for creating new Titulaciones.
	+ `edit`: An edit page for editing existing Titulaciones.

**Conclusion**
--------------

The `TitulacionResource` class is a critical component of the Filament framework, providing a resource for handling Titulaciones and their relationships with other models. This documentation aims to provide a comprehensive understanding of the class's methods, functionality, and role in the system.