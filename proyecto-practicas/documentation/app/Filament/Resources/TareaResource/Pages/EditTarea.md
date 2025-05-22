# Documentation: EditTarea.php

Original file: `app/Filament\Resources\TareaResource\Pages\EditTarea.php`

# EditTarea Documentation
======================================================

Table of Contents
-----------------

* [Introduction](#introduction)
* [Class Overview](#class-overview)
* [Methods](#methods)
	+ [getHeaderActions](#getheaderactions)
	+ [mutateFormDataBeforeSave](#mutateformdatabeforesave)
	+ [mutateFormDataBeforeFill](#mutateformdatabeforefille)
* [Conclusion](#conclusion)

Introduction
------------

The `EditTarea` class is a part of the `Filament\Resources\Pages\EditRecord` family, responsible for handling the edit functionality of a `Tarea` record in the system. This documentation aims to provide an in-depth understanding of the class's purpose, methods, and functionality.

Class Overview
--------------

The `EditTarea` class is designed to handle the editing of a single `Tarea` record. It extends the `Filament\Resources\Pages\EditRecord` class and overrides some of its methods to accommodate specific requirements for the `Tarea` resource.

Methods
--------

### getHeaderActions

The `getHeaderActions` method returns an array of actions that can be displayed in the header section of the page. In this case, it returns a single action, `Actions\DeleteAction::make()`, which allows the user to delete the current `Tarea` record.

```php
protected function getHeaderActions(): array {
    return [
        Actions\DeleteAction::make(),
    ];
}
```

### mutateFormDataBeforeSave

The `mutateFormDataBeforeSave` method is called before the form data is saved. It takes an array of form data as its input and returns a modified version of that data. In this method, we handle the case where the user has selected multiple asignaturas (topics) for the current tarea (task). We first check if the `asignaturas` field exists in the form data. If it does, we explode it into an array using commas as separators.

```php
protected function mutateFormDataBeforeSave(array $data): array {
    if ($this->record) {
        $asignaturas = $data['asignaturas'] ?? [];

        if (is_string($asignaturas)) {
            $asignaturas = explode(',', $asignaturas);
        }

        if (!is_array($asignaturas)) {
            $asignaturas = [];
        }

        AsignaturaTarea::where('tarea_id', $data['id'])->delete();

        foreach ($asignaturas as $asignaturaId) {
            AsignaturaTarea::create([
                'tarea_id' => $data['id'],
                'asignatura_id' => $asignaturaId,
            ]);
        }
    }

    unset($data['asignaturas']);

    return $data;
}
```

### mutateFormDataBeforeFill

The `mutateFormDataBeforeFill` method is called before the form data is filled. It takes an array of form data as its input and returns a modified version of that data. In this method, we handle the case where the user has selected multiple asignaturas for the current tarea. We retrieve the existing asignaturas associated with the current tarea record and store them in the `asignaturas` field of the form data.

```php
protected function mutateFormDataBeforeFill(array $data): array {
    if ($this->record) {
        $asignaturasId = $this->record->asignaturas()
            ->pluck('asignaturas.id')
            ->toArray();
        $data['asignaturas'] = $asignaturasId;
    }
    return $data;
}
```

Conclusion
----------

The `EditTarea` class provides the necessary functionality for editing a single `Tarea` record in the system. It handles the case where multiple asignaturas can be selected and updates the associated records accordingly.