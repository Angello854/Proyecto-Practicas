# Documentation: Asignatura.php

Original file: `app/Models\Asignatura.php`

# Asignatura Model Documentation
==================================

Table of Contents
-----------------

[Asignatura Overview](#asignatura-overview)
[Attributes](#attributes)
[Tareas Relationship](#tareas-relationship)
[Profesores Relationship](#profesores-relationship)
[Cursos Relationship](#cursos-relationship)

Asignatura Overview
-------------------

The `Asignatura` model represents a subject or course in the system. This documentation provides an overview of the model's attributes, relationships, and functionality.

Attributes
------------

| Attribute | Type | Description |
| --- | --- | --- |
| nombre | string | The name of the asignatura |

Tareas Relationship
--------------------

The `tareas` method returns a belongsToMany relationship with the `Tarea` model. This represents the many-to-many relationship between asignaturas and tasks.

```
public function tareas()
{
    return $this->belongsToMany(Tarea::class, 'asignatura_tarea', 'asignatura_id', 'tarea_id');
}
```

In this relationship:

* The `Tarea` model is related to the `Asignatura` model through a pivot table named `asignatura_tarea`.
* The `asignatura_id` column in the pivot table represents the foreign key referencing the `Asignatura` model.
* The `tarea_id` column in the pivot table represents the foreign key referencing the `Tarea` model.

Profesores Relationship
---------------------

The `profesores` method returns a belongsToMany relationship with the `User` model. This represents the many-to-many relationship between asignaturas and users, filtered by the `rol` attribute to only include tutor docente roles.

```
public function profesores()
{
    return $this->belongsToMany(User::class, 'asignatura_profesor', 'asignatura_id', 'profesor_id')
        ->where('rol', 'tutor_docente');
}
```

In this relationship:

* The `User` model is related to the `Asignatura` model through a pivot table named `asignatura_profesor`.
* The `asignatura_id` column in the pivot table represents the foreign key referencing the `Asignatura` model.
* The `profesor_id` column in the pivot table represents the foreign key referencing the `User` model.
* The relationship is filtered to only include users with the `tutor_docente` role.

Cursos Relationship
-------------------

The `cursos` method returns a belongsToMany relationship with the `Curso` model. This represents the many-to-many relationship between asignaturas and courses.

```
public function cursos()
{
    return $this->belongsToMany(Curso::class, 'curso_asignatura', 'asignatura_id', 'curso_id');
}
```

In this relationship:

* The `Curso` model is related to the `Asignatura` model through a pivot table named `curso_asignatura`.
* The `asignatura_id` column in the pivot table represents the foreign key referencing the `Asignatura` model.
* The `curso_id` column in the pivot table represents the foreign key referencing the `Curso` model.

By understanding the attributes, relationships, and functionality of the `Asignatura` model, developers can effectively utilize this model to manage asignaturas and their associated data.