# Documentation: CursoAsignatura.php

Original file: `app/Models\CursoAsignatura.php`

# CursoAsignatura Documentation

## Table of Contents

* [Introduction](#introduction)
* [Model Description](#model-description)
* [Methods](#methods)

## Introduction

The `CursoAsignatura` class is a part of the `App\Models` namespace and represents a many-to-many relationship between courses and subjects. This model is used to store information about assignments given in specific courses.

## Model Description

The `CursoAsignatura` model extends the Laravel Eloquent model, allowing it to interact with the corresponding database table. It uses the `HasFactory` trait provided by Laravel, which enables the use of factories for creating and manipulating model instances.

### Attributes

* `$table`: The name of the database table associated with this model.
* `$fillable`: An array containing the attributes that can be modified through mass assignment.

## Methods

### Constructor (`__construct()`)

The constructor method is called when a new instance of the `CursoAsignatura` model is created. It does not have any specific functionality and simply initializes the parent class.

```php
public function __construct()
{
    parent::__construct();
}
```

### Filler Attributes (`$fillable`)

The `$fillable` property specifies which attributes can be modified through mass assignment, such as when updating a model instance using `update()` or `fill()` methods.

```php
protected $fillable = [
    'curso_id',
    'asignatura_id',
];
```

These attributes are used to store information about the relationship between courses and subjects. The `curso_id` attribute represents the foreign key referencing the `cursos` table, while the `asignatura_id` attribute references the `asignaturas` table.

### Factory Methods (`HasFactory` trait)

The `HasFactory` trait provides a set of factory methods that can be used to create and manipulate model instances. These methods include:

* `create()`: Creates a new instance of the model.
* `make()`: Creates a new instance of the model, but does not persist it in the database.
* `newQuery()`: Returns a new query builder instance for the model.

These factory methods can be used to create and manage instances of the `CursoAsignatura` model.