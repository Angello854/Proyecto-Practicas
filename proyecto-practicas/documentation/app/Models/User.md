# Documentation: User.php

Original file: `app/Models\User.php`

# User Documentation

Table of Contents:
==================

* [Introduction](#introduction)
* [Attributes](#attributes)
* [Relationships](#relationships)

Introduction
------------

The `User` class represents a user in the system. It extends the `Authenticatable` class and implements the `HasAvatar` interface. This class is responsible for handling user-related operations, such as authentication, authorization, and data retrieval.

Attributes
----------

### Fillable Attributes

* `name`: The user's name.
* `email`: The user's email address.
* `password`: The user's password (hashed).
* `avatar_url`: The URL of the user's avatar image.
* `telefono`: The user's phone number.
* `rol`: The user's role, represented by an instance of the `Rol` enum.

### Hidden Attributes

* `password`: The user's password (hashed).
* `remember_token`: A token used for remembering the user's login status.

### Guarded Attributes

The following attributes are not mass-assignable:
* `tutor_docente_id`
* `tutor_laboral_id`
* `empresa_id`

Relationships
-------------

### HasOne Relationships

* `sesion`: The user's session, represented by an instance of the `BreezySession` model.
* `tutor`: The user's tutor, represented by an instance of the `Tutor` model.

### HasMany Relationships

* `tareas`: The tasks assigned to the user, represented by instances of the `Tarea` model.

### Belongs To Many Relationships

* `asignaturas`: The subjects taught by the user, represented by instances of the `Asignatura` model.
* `profesores`: The users who are being tutored by the user, represented by instances of the `User` model and filtered to only include tutors.
* `alumnos`: The users who are being tutored by another user, represented by instances of the `User` model and filtered to only include students.

Casts
------

The following attributes will be cast as specified:
* `email_verified_at`: A datetime string.
* `password`: A hashed string.
* `rol`: An instance of the `Rol` enum.

Methods
-------

### getFilamentAvatarUrl

Returns the URL of the user's avatar image, or null if no avatar is set.

### sesion

Returns the user's session, represented by an instance of the `BreezySession` model.

### tutor

Returns the user's tutor, represented by an instance of the `Tutor` model.

### tareas

Returns the tasks assigned to the user, represented by instances of the `Tarea` model.

### asignaturas

Returns the subjects taught by the user, represented by instances of the `Asignatura` model.

### profesores

Returns the users who are being tutored by the user, represented by instances of the `User` model and filtered to only include tutors.

### alumnos

Returns the users who are being tutored by another user, represented by instances of the `User` model and filtered to only include students.