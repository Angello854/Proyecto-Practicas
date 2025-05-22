# Documentation: AlumnoProfesor.php

Original file: `app/Models\AlumnoProfesor.php`

# AlumnoProfesor Documentation

**Table of Contents**

* [Introduction](#introduction)
* [Purpose and Role](#purpose-and-role)
* [Attributes](#attributes)
* [Relationships](#relationships)

## Introduction

The `AlumnoProfesor` class is a model in the Laravel framework, specifically designed to handle relationships between students (alumnos) and professors. This documentation provides an overview of the class's purpose, attributes, and relationships.

## Purpose and Role

The primary role of the `AlumnoProfesor` class is to facilitate the creation and management of relationships between students and professors in the system. This involves storing and retrieving data related to these relationships, as well as providing methods for querying and manipulating this data.

## Attributes

### `table`

* Type: string
* Description: The name of the database table associated with the `AlumnoProfesor` model.
* Value: `'alumno_profesor'`

### `fillable`

* Type: array
* Description: An array of attributes that can be mass-assigned to a new instance of the `AlumnoProfesor` class.
* Values:
	+ `'alumno_id'`
	+ `'profesor_id'`

## Relationships

The `AlumnoProfesor` model has several relationships with other models in the system:

### `alumno`

* Type: BelongsTo
* Description: A relationship between an `AlumnoProfesor` instance and a student (alumno) record.
* Foreign Key: `alumno_id`

### `profesor`

* Type: BelongsTo
* Description: A relationship between an `AlumnoProfesor` instance and a professor record.
* Foreign Key: `profesor_id`

This documentation provides a comprehensive overview of the `AlumnoProfesor` class, including its purpose, attributes, and relationships. This information is essential for developers working with this model in the Laravel framework.