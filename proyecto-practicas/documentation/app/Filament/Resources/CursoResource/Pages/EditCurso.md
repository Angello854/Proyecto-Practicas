# Documentation: EditCurso.php

Original file: `app/Filament\Resources\CursoResource\Pages\EditCurso.php`

# EditCurso Documentation

Table of Contents:
=====================

* [Introduction](#introduction)
* [Methods](#methods)
	+ [getHeaderActions()](#getheaderactions)
	+ [mutateFormDataBeforeSave()](#mutateformdatabeforesave)
	+ [mutateFormDataBeforeFill()](#mutateformdatabeforefill)

Introduction
============

The `EditCurso` class is responsible for handling the editing of a course record in the `CursoResource`. This documentation aims to provide a comprehensive overview of the code, its functionality, and its role within the system.

Methods
--------

### getHeaderActions()

Purpose: The `getHeaderActions()` method returns an array of actions that should be displayed in the header section of the page.

Parameters:

* None

Return Value: An array of `Actions` objects

Description: This method returns a list of available actions, including the delete action. The delete action is used to remove the course record.

### mutateFormDataBeforeSave()

Purpose: The `mutateFormDataBeforeSave()` method modifies the form data before it's saved to the database. It ensures that any existing relationships between the course and its assignments are updated correctly.

Parameters:

* `$data`: An array of form data

Return Value: Modified form data

Description: This method checks if there is an existing record being edited. If so, it updates the assignments by deleting any previous relationships and creating new ones based on the submitted data.

### mutateFormDataBeforeFill()

Purpose: The `mutateFormDataBeforeFill()` method modifies the form data before it's filled with initial values. It loads any existing assignment IDs for the course.

Parameters:

* `$data`: An array of form data

Return Value: Modified form data

Description: This method checks if there is an existing record being edited. If so, it loads the current assignments for the course and sets them as the initial values for the form.

Conclusion
----------

The `EditCurso` class plays a crucial role in managing course records in the system. Its methods ensure that any changes to the data are handled correctly, and that relationships between courses and their assignments are maintained.