# Documentation: EditUser.php

Original file: `app/Filament\Resources\UserResource\Pages\EditUser.php`

# EditUser Documentation

**Table of Contents**

* Introduction
* Class Overview
* mutateFormDataBeforeSave Method
* mutateFormDataBeforeFill Method
* GetHeaderActions Method

## Introduction

The `EditUser` class is a part of the UserResource pages in Filament. It handles the editing process for user records. This documentation aims to provide a comprehensive overview of the class, its methods, and their functionality.

## Class Overview

The `EditUser` class extends the `EditRecord` class from Filament. It is responsible for handling the edit form submission and updating the corresponding user record in the database.

### Properties

* `$record`: The current user record being edited.

### Methods

#### mutateFormDataBeforeSave Method

This method is called before saving the form data to the database. Its purpose is to modify the form data before it's saved, if necessary.

* `Parameters`: An array of form data (`$data`)
* `Return Value`: Modified form data array
* `Functionality`: This method checks if the user's role is 'alumno' and updates the corresponding tutor record in the database. It also handles creating or updating AlumnoProfesor records based on the provided professor IDs.

```php
if($data['rol'] === 'alumno'){
    Tutor::updateOrCreate(
        ['alumno_id' => $data['id']],
        [
            'tutor_docente_id' => $data['tutor_docente_id'],
            'tutor_laboral_id' => $data['tutor_laboral_id'],
            'empresa_id' => $data['empresa_id'],
        ]
    );
}

if ($this->record) {
    $profesores = $data['profesores'] ?? [];

    if (is_string($profesores)) {
        $profesores = explode(',', $profesores);
    }

    if (!is_array($profesores)) {
        $profesores = [];
    }

    AlumnoProfesor::where('alumno_id', $data['id'])->delete();

    foreach ($profesores as $profesorId) {
        AlumnoProfesor::create([
            'alumno_id' => $data['id'],
            'profesor_id' => $profesorId,
        ]);
    }
}

return $data;
```

#### mutateFormDataBeforeFill Method

This method is called before filling the form with data. Its purpose is to prepare the form fields for display, if necessary.

* `Parameters`: An array of form data (`$data`)
* `Return Value`: Modified form data array
* `Functionality`: This method populates the form fields with data from the current user record. It sets default values for tutor_docente_id, tutor_laboral_id, and empresa_id if they are null. If the user has associated professors, it fills the profesores field with their IDs.

```php
$data['tutor_docente_id'] = $this->record->tutor->tutor_docente_id ?? null;
$data['tutor_laboral_id'] = $this->record->tutor->tutor_laboral_id ?? null;
$data['empresa_id'] = $this->record->tutor->empresa_id ?? null;

if ($this->record) {
    $profesoresId = $this->record->profesores()
        ->pluck('users.id')
        ->toArray();
    $data['profesores'] = $profesoresId;
}

return $data;
```

#### GetHeaderActions Method

This method returns an array of header actions that can be displayed in the edit form.

* `Return Value`: An array of Actions objects
* `Functionality`: This method returns an array containing a single DeleteAction object.