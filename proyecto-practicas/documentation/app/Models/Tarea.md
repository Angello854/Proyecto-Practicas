# Documentation: Tarea.php

Original file: `app/Models\Tarea.php`

# Tarea Documentation

## Table of Contents
* [Introduction](#introduction)
* [Attributes](#attributes)
* [Methods](#methods)

### Introduction
The `Tarea` class is a part of the project's modeling layer, responsible for representing tasks and their corresponding attributes. This documentation aims to provide an in-depth overview of the class, its attributes, and methods.

### Attributes

| Attribute | Type | Description |
| --- | --- | --- |
| descripcion | string | The task description |
| fecha | datetime (casted) | The task date |
| aprendizaje | integer | The learning hours allocated for this task |
| refuerzo | integer | The reinforcement hours allocated for this task |
| horas | integer | The total hours allocated for this task |
| materiales | array | An array of materials required for the task |
| comentarios | string | Any additional comments or notes about the task |
| alumno_id | integer (foreign key) | The ID of the student assigned to this task |

### Methods

#### `usuario()`
This method returns a belongs-to relationship with the `User` model, representing the student assigned to this task.

```php
public function usuario(): BelongsTo
{
    return $this->belongsTo(User::class,'alumno_id');
}
```

#### `asignaturas()`
This method returns a belongs-to-many relationship with the `Asignatura` model, representing the subjects associated with this task.

```php
public function asignaturas(): BelongsToMany
{
    return $this->belongsToMany(Asignatura::class,'asignatura_tarea', 'tarea_id', 'asignatura_id');
}
```

### Conclusion
The `Tarea` class serves as a fundamental component of the project's modeling layer, providing a structured representation of tasks and their relationships. This documentation aims to provide a comprehensive understanding of the class, its attributes, and methods, enabling developers to effectively utilize this class in their projects.