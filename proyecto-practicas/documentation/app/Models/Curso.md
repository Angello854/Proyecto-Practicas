# Documentation: Curso.php

Original file: `app/Models\Curso.php`

# Curso Documentation

Table of Contents
----------------

* [Introduction](#introduction)
* [Methods](#methods)
	+ [asignaturas()](#asignaturas)
	+ [titulaciones()](#titulaciones)

## Introduction

The `Curso` class is a model that represents a course in the system. It is used to manage and retrieve information about courses, including their relationships with asignaturas (topics) and titulaciones (degrees).

This documentation provides an overview of the `Curso` class, its methods, and how it interacts with other models.

## Methods

### asignaturas()

The `asignaturas()` method returns a collection of asignaturas that are associated with this course. It uses a belongsToMany relationship to retrieve the data from the `curso_asignatura` pivot table.

Parameters:

* None

Return values:

* A collection of `Asignatura` models that are associated with this course.

Description: This method is used to retrieve the list of asignaturas for a given course. The resulting collection can be iterated over to access the individual asignatura objects, which contain information such as the asignatura name and description.

### titulaciones()

The `titulaciones()` method returns a collection of titulaciones that are associated with this course. It uses a belongsToMany relationship to retrieve the data from the `curso_titulacion` pivot table.

Parameters:

* None

Return values:

* A collection of `Titulacion` models that are associated with this course.

Description: This method is used to retrieve the list of titulaciones for a given course. The resulting collection can be iterated over to access the individual titulacion objects, which contain information such as the titulacion name and description.

## Conclusion

The `Curso` class provides methods for retrieving the list of asignaturas and titulaciones associated with a course. This documentation provides an overview of the class's methods and how they interact with other models in the system.