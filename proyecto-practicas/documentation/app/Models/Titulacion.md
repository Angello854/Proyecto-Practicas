# Documentation: Titulacion.php

Original file: `app/Models\Titulacion.php`

# Titulacion Documentation

Table of Contents
=================

* [Introduction](#introduction)
* [Properties](#properties)
* [Methods](#methods)

Introduction
-------------

The `Titulacion` class is a part of the `App\Models` namespace in our PHP codebase. It represents a titulación (a set of courses or modules) and provides methods to interact with it. This documentation aims to provide an in-depth understanding of the `Titulacion` class, its properties, and its methods.

Properties
------------

The `Titulacion` class has the following properties:

* `$table`: The name of the database table associated with this model.
	+ Type: `string`
	+ Default value: `'titulacion'`

* `$fillable`: An array of attributes that can be filled or updated using the `create()` and `update()` methods.
	+ Type: `array`
	+ Example: `['nombre']`

Methods
---------

### Cursos

The `cursos` method returns a list of courses (or modules) related to this titulación.

* Purpose: To retrieve the courses associated with a given titulación.
* Parameters:
	+ None
* Return values:
	+ An instance of `Illuminate\Database\Eloquent\Collection` containing the courses.
* Functionality: This method uses Eloquent's `belongsToMany` functionality to establish a relationship between the `titulacion` table and the `curso` table through the `curso_titulacion` pivot table. The result is an array of `Curso` objects, each representing a course related to the current titulación.

Example usage:

```php
$titulacion = Titulacion::find(1);
$courses = $titulacion->cursos;
```

In this example, we retrieve a `Titulacion` object with ID 1 and then use its `cursos` method to get an array of related courses.