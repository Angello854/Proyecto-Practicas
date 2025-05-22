# Documentation: ListTareas.php

Original file: `app/Filament\Resources\TareaResource\Pages\ListTareas.php`

# ListTareas Documentation

Table of Contents: 
[#Introduction](#introduction), 
[#HeaderActions](#headeractions)

## Introduction

The `ListTareas` class is a part of the `Filament\Resources\Pages` namespace in the TareaResource application. This class extends the base `ListRecords` class provided by Filament, and it's responsible for displaying a list of tasks (tareas) to the user.

## HeaderActions

### Purpose

The `getHeaderActions` method is used to define the actions that will be available in the header section of the task list page. In this case, only one action is defined - the `CreateAction`, which allows users to create a new task.

### Parameters and Return Values

* No parameters are required for this method.
* The method returns an array of `Actions` objects, each representing an available action in the header section.

### Functionality

The `getHeaderActions` method is called when the user opens the task list page. It returns an array containing a single `CreateAction` object, which is used to create a new task. When the user clicks on the "New Task" button, they will be taken to a form where they can enter details about their new task.

```php
protected function getHeaderActions(): array
{
    return [
        Actions\CreateAction::make(),
    ];
}
```

This method is important because it determines what actions are available to users when they view the task list. In this case, the only option is to create a new task.