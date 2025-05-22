# Documentation: Tutor.php

Original file: `app/Models\Tutor.php`

# Tutor Documentation

Table of Contents:
==================

* [Introduction](#introduction)
* [Attributes](#attributes)
* [Relationships](#relationships)

## Introduction
===============

The `Tutor` class is a part of the application's model layer, responsible for encapsulating and managing data related to tutors in the system. This class extends the base `Illuminate\Database\Eloquent\Model` class, allowing it to interact with the database using Eloquent.

## Attributes
==============

### Incrementing
----------------

The `$incrementing` attribute is set to `false`, which means that the model does not rely on automatic incrementing of primary key values. Instead, the value of the primary key (in this case, `alumno_id`) will be manually managed by the application.

### Primary Key
--------------

The primary key for the `Tutor` model is set to `alumno_id`, which is a unique identifier for each tutor in the system.

### Fillable Fields
-------------------

The `$fillable` attribute specifies the fields that can be inserted or updated using the `fill()` method. The allowed fillable fields are:

* `alumno_id`
* `tutor_docente_id`
* `tutor_laboral_id`
* `empresa_id`

## Relationships
================

### Alumno Relationship
----------------------

The `alumno` relationship is a many-to-one relationship between the `Tutor` model and the `User` model. The relationship is defined using the `belongsTo` method, which indicates that each tutor belongs to one user.

```
public function alumno(): BelongsTo
{
    return $this->belongsTo(User::class, 'alumno_id');
}
```

### TutorDocente Relationship
-----------------------------

The `tutorDocente` relationship is a many-to-one relationship between the `Tutor` model and the `User` model. The relationship is defined using the `belongsTo` method, which indicates that each tutor belongs to one user.

```
public function tutorDocente(): BelongsTo
{
    return $this->belongsTo(User::class, 'tutor_docente_id');
}
```

### TutorLaboral Relationship
-----------------------------

The `tutorLaboral` relationship is a many-to-one relationship between the `Tutor` model and the `User` model. The relationship is defined using the `belongsTo` method, which indicates that each tutor belongs to one user.

```
public function tutorLaboral(): BelongsTo
{
    return $this->belongsTo(User::class, 'tutor_laboral_id');
}
```

### Empresa Relationship
----------------------

The `empresa` relationship is a many-to-one relationship between the `Tutor` model and the `Empresa` model. The relationship is defined using the `belongsTo` method, which indicates that each tutor belongs to one company.

```
public function empresa(): BelongsTo
{
    return $this->belongsTo(Empresa::class, 'empresa_id');
}
```