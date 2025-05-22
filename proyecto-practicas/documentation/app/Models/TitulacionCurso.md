# Documentation: TitulacionCurso.php

Original file: `app/Models\TitulacionCurso.php`

# TitulacionCurso Documentation
=====================================================

Table of Contents
-----------------

* [Introduction](#introduction)
* [Properties](#properties)
* [Fillable Attributes](#fillable-attributes)

Introduction
------------

The `TitulacionCurso` class is a model in the PHP application that represents the relationship between courses and titulaciones. This documentation aims to provide an overview of the class, its properties, and its functionality.

Properties
----------

### Table Name

* `protected $table = 'curso_titulacion';`

The table name for this model is set to `'curso_titulacion'`. This specifies the database table that the model will interact with.

Fillable Attributes
-------------------

### Curso ID and Titulacion ID

* `protected $fillable = ['curso_id', 'titulacion_id'];`

The `TitulacionCurso` model allows filling of two attributes: `curso_id` and `titulacion_id`. These attributes are used to establish the relationship between courses and titulaciones.

Note
----

This documentation is intended to provide a comprehensive overview of the `TitulacionCurso` class, its properties, and its functionality. It is designed to help developers understand how the code works and why it exists.

### Conclusion

The `TitulacionCurso` model plays a crucial role in establishing relationships between courses and titulaciones. By understanding its properties and fillable attributes, developers can effectively use this model in their applications.