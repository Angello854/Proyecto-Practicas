# Documentation: CreateAsignatura.php

Original file: `app/Filament\Resources\AsignaturaResource\Pages\CreateAsignatura.php`

# CreateAsignatura Documentation

Table of Contents
=================

* [Introduction](#introduction)
* [handleRecordCreation Method](#handlerecordcreation-method)
	+ [Purpose](#purpose)
	+ [Parameters](#parameters)
	+ [Return Values](#return-values)
	+ [Functionality](#functionality)

Introduction
============

The `CreateAsignatura` class is responsible for creating a new asignatura record in the system. This file is part of the Filament resources and is used to handle the creation of asignaturas.

handleRecordCreation Method
==========================

### Purpose

The purpose of this method is to create a new asignatura record and its corresponding relationships with profesores and cursos.

### Parameters

* `$data`: an array containing the data for the new asignatura record, including any related profesores or cursos.

### Return Values

The method returns the created `Asignatura` model instance.

### Functionality

The method first ensures that the `$profesores` value is always an array. If it's not, it explodes the string into an array using commas as separators. It then unsets the `profesores` key from the `$data` array to avoid creating duplicate records.

Next, the method creates a new asignatura record using the provided data and assigns it to the `$asignatura` variable. Finally, it loops through each profesor ID in the `$profesores` array and creates a corresponding `AsignaturaProfesor` record linking the newly created asignatura to the respective profesor.

```php
public function handleRecordCreation(array $data): Model
{
    // Asegurar que asignaturas sea siempre un array
    $profesores = $data['profesores'] ?? [];

    if (is_string($profesores)) {
        $profesores = explode(',', $profesores);
    }

    unset($data['profesores']);

    // Crear el curso
    $asignatura = Asignatura::create($data);

    // Crear las relaciones en la tabla intermedia
    foreach ($profesores as $profesoresId) {
        if (!empty($profesoresId)) {
            AsignaturaProfesor::create([
                'asignatura_id' => $asignatura->id,
                'profesor_id' => $profesoresId,
            ]);
        }
    }

    return $asignatura;
}
```

Note that this method is responsible for creating a new asignatura record and its corresponding relationships with profesores. It's an important part of the system, as it allows developers to create and manage asignaturas in the application.