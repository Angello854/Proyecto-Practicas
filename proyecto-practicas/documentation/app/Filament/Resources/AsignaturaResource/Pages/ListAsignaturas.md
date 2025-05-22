# Documentation: ListAsignaturas.php

Original file: `app/Filament\Resources\AsignaturaResource\Pages\ListAsignaturas.php`

# ListAsignaturas Documentation

**Table of Contents**

* [Introduction](#introduction)
* [Overview](#overview)
* [getHeaderActions Method](#getheaderactions-method)
	+ [Purpose](#purpose)
	+ [Parameters](#parameters)
	+ [Return Values](#return-values)
	+ [Functionality](#functionality)

**Introduction**

The `ListAsignaturas` class is a part of the AsignaturaResource Filament Page, responsible for listing asignaturas records. This documentation provides an overview of the class's functionality and its main methods.

**Overview**

The `ListAsignaturas` class extends `Filament\Resources\Pages\ListRecords`, which allows it to handle the listing of asignaturas records. It uses the AsignaturaResource to retrieve the necessary data.

**getHeaderActions Method**

The `getHeaderActions` method is responsible for returning an array of header actions that can be displayed in the Filament UI. These actions are used to provide users with options to interact with the listed asignaturas, such as creating new records.

### Purpose

The purpose of the `getHeaderActions` method is to provide a way to display custom header actions in the Filament UI, allowing users to perform specific actions on the listed asignaturas.

### Parameters

This method does not accept any parameters.

### Return Values

The `getHeaderActions` method returns an array of `Filament\Actions\ActionInterface` objects. These actions are used to provide users with options to interact with the listed asignaturas.

### Functionality

The `getHeaderActions` method returns an array containing a single `CreateAction`, which allows users to create new asignatura records.

```php
protected function getHeaderActions(): array
{
    return [
        Actions\CreateAction::make(),
    ];
}
```

This action is used to provide users with the ability to create new asignatura records, making it easier for them to manage their asignaturas data.