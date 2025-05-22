# Documentation: TareaResource.php

Original file: `app/Filament\Resources\TareaResource.php`

**TareaResource Documentation**

### Table of Contents

1. [Introduction](#introduction)
2. [Methods](#methods)
	* [getEloquentQuery()](#geteloquentquery)
	* [form()](#form)
	* [table()](#table)
3. [Properties](#properties)

### Introduction

The `TareaResource` class is a part of the Filament package, which provides an API for managing tasks (tareas) in the system. This documentation focuses on explaining how this class works and what functionality it provides.

### Methods

#### getEloquentQuery()

Purpose: Retrieve an Eloquent query object that can be used to filter and retrieve tarea records.

Parameters: None

Return Value: An instance of `Illuminate\Database\Eloquent\Builder`

Functionality: The method returns an Eloquent query object that is filtered based on the user's role. The filtering logic is as follows:

* If the user is an Alumno, only tasks assigned to them are returned.
* If the user is a TutorDocente or TutorLaboral, tasks related to their tutored students or laboral activities are returned.

#### form()

Purpose: Generate a Filament Form object for creating and editing tarea records.

Parameters:

* `$form`: An instance of `Filament\Forms\Form`

Return Value: The modified `$form` object

Functionality: The method returns a Filament Form object that includes the following fields:
	+ `id`: A hidden field with the tarea's ID
	+ `descripcion`: A text input for the tarea's description
	+ `aprendizaje`: A text input for the tarea's learning objective
	+ `refuerzo`: A text input for the tarea's reinforcement material
	+ `fecha`: A date picker for the tarea's due date
	+ `horas`: A select field with predefined options for the tarea's duration
	+ `materiales`: A select field with predefined options for the tarea's materials
	+ `comentarios`: A Tiptap Editor field for the tarea's comments

#### table()

Purpose: Generate a Filament Table object for displaying tarea records.

Parameters:

* `$table`: An instance of `Filament\Tables\Table`

Return Value: The modified `$table` object

Functionality: The method returns a Filament Table object that includes the following columns:
	+ `id`: A text column with the tarea's ID
	+ `descripcion`: A text column with the tarea's description
	+ `fecha`: A date-time column with the tarea's due date
	+ `asignaturas`: A text column with a comma-separated list of assigned courses
	+ `aprendizaje`: A text column with the tarea's learning objective
	+ `refuerzo`: A text column with the tarea's reinforcement material
	+ `horas`: A text column with the tarea's duration
	+ `materiales`: A text column with the tarea's materials
	+ `comentarios`: A text column with the tarea's comments
	+ `usuario.name`: A text column with the aluno's name (only visible if the user is not an Alumno)

### Properties

* `model`: The modelo class used to retrieve and manipulate tarea records (`Tarea::class`)
* `navigationIcon`: An icon displayed in the navigation menu for this resource (heroicon-o-table-cells)