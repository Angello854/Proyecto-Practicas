# Documentation: CreateTitulacion.php

Original file: `app/Filament\Resources\TitulacionResource\Pages\CreateTitulacion.php`

# CreateTitulacion Documentation

[TOC]

## Introduction

This documentation describes the `CreateTitulacion` class, a PHP file responsible for creating new `Titulacion` records in the system. This file is part of the `Filament\Resources\TitulacionResource\Pages` namespace and is used to manage titulations within the application.

### Purpose

The primary purpose of this file is to provide a mechanism for creating new `Titulacion` records, which represent academic degrees or certifications. This class handles the creation process by populating a `Titulacion` model with data provided through an external interface (e.g., a web form).

## Method Documentation

### handleRecordCreation(array $data): Model

The `handleRecordCreation` method is responsible for creating a new `Titulacion` record based on the provided data. This method takes an array of data as input, processes it, and returns the created `Titulacion` model.

#### Parameters

* `$data`: An associative array containing the data to be used when creating the `Titulacion` record. The array contains the following keys:
	+ `cursos`: A comma-separated string or an array of course IDs that are associated with the new titulation.

#### Return Value

The method returns a `Model` instance representing the newly created `Titulacion` record.

#### Functionality

1. The method first checks if the `cursos` parameter is present and, if so, attempts to parse it as an array of course IDs.
2. It then unsets the `cursos` key from the input data array.
3. Using the remaining data, the method creates a new `Titulacion` record using the `create` method provided by the `Titulacion` model.
4. The method then iterates over the list of courses and creates corresponding `TitulacionCurso` records for each course, linking them to the newly created `Titulacion` record.

### Code Snippet

```php
public function handleRecordCreation(array $data): Model
{
    // ...

    $titulacion = Titulacion::create($data);

    foreach ($cursos as $cursoId) {
        if (!empty($cursoId)) {
            TitulacionCurso::create([
                'titulacion_id' => $titulacion->id,
                'curso_id' => $cursoId,
            ]);
        }
    }

    return $titulacion;
}
```

## Conclusion

The `CreateTitulacion` class provides a mechanism for creating new `Titulacion` records in the system. This file is responsible for processing user input and populating the necessary data to create a new titulation, along with its associated courses. By understanding the functionality of this file, developers can effectively integrate it into their workflows and manage titulations within the application.