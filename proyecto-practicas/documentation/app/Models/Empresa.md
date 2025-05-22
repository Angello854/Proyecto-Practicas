# Documentation: Empresa.php

Original file: `app/Models\Empresa.php`

# Empresa Documentation

Table of Contents:
[Back to TOC](#table-of-contents)

* [Introduction](#introduction)
* [Methods](#methods)
	+ [tutores()](#tutores-method)
	+ [tutorLaboral()](#tutor-laboral-method)
* [Attributes](#attributes)
* [Relationships](#relationships)

## Introduction

The `Empresa` class is a model in the application that represents an enterprise. It is responsible for managing data related to companies, such as their name and tutor laboral information.

This documentation aims to provide an overview of the `Empresa` class's functionality, methods, attributes, and relationships.

## Methods

### tutores() Method

The `tutores()` method returns a collection of `Tutor` objects that are associated with the current `Empresa` instance. This is achieved through a many-to-many relationship between `Empresa` and `Tutor`.

```php
public function tutores(): HasMany
{
    return $this->hasMany(Tutor::class);
}
```

* Parameters: None
* Return value: A collection of `Tutor` objects

This method allows you to retrieve the list of tutors associated with an enterprise, making it possible to perform operations such as filtering or sorting.

### tutorLaboral() Method

The `tutorLaboral()` method returns a `User` object that is associated with the current `Empresa` instance through a belongs-to relationship.

```php
public function tutorLaboral(): BelongsTo
{
    return $this->belongsTo(User::class, 'tutor_laboral_id');
}
```

* Parameters: None
* Return value: A `User` object

This method allows you to retrieve the user associated with an enterprise as its tutor laboral.

## Attributes

The `Empresa` class has two attributes that can be filled:

* `nombre`: The name of the enterprise.
* `tutor_laboral_id`: The ID of the user associated with the enterprise as its tutor laboral.

## Relationships

The `Empresa` class has two relationships:

### Many-to-Many Relationship: tutores()

This relationship is established between the `Empresa` model and the `Tutor` model. It allows you to retrieve the list of tutors associated with an enterprise, making it possible to perform operations such as filtering or sorting.

### Belongs-To Relationship: tutorLaboral()

This relationship is established between the `Empresa` model and the `User` model. It allows you to retrieve the user associated with an enterprise as its tutor laboral.

By understanding the functionality of these relationships, developers can effectively integrate the `Empresa` class into their applications, leveraging its capabilities for managing enterprise data.