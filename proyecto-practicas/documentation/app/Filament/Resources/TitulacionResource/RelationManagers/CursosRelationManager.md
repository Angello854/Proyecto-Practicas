# Documentation: CursosRelationManager.php

Original file: `app/Filament\Resources\TitulacionResource\RelationManagers\CursosRelationManager.php`

# CursosRelationManager Documentation

Table of Contents
=================

* [Introduction](#introduction)
* [Class Overview](#class-overview)
* [Methods](#methods)
	+ [form Method](#form-method)
	+ [table Method](#table-method)

## Introduction
===============

The `CursosRelationManager` class is a part of the `Filament\Resources\TitulacionResource\RelationManagers` namespace and serves as a relation manager for the `TitulacionResource`. This class is responsible for managing the relationship between the `TitulacionResource` and the `Cursos` table in the database.

## Class Overview
================

The `CoursRelationManager` class extends the `Filament\Resources\RelationManagers\RelationManager` class and provides a set of methods for managing the relation between the `TitulacionResource` and the `Cursos` table.

### Static Properties
--------------------

* `$relationship`: A string property that represents the name of the relationship. In this case, it is set to `'cursos'`.
* `$title`: An optional string property that provides a title for the relation manager. It is set to `'Cursos'`.

## Methods
==========

### form Method
-------------

The `form` method generates a form for creating and editing records in the `Cursos` table.

```php
public function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('nombre')
                ->label('Nombre')
                ->required(),
        ]);
}
```

This method returns a `Form` object that contains a single input field for the `nombre` attribute. The input field is required and has a label of `'Nombre'`.

### table Method
-------------

The `table` method generates a table for displaying records in the `Cursos` table.

```php
public function table(Table $table): Table
{
    return $table
        ->recordTitleAttribute('Cursos')
        ->columns([
            TextColumn::make('nombre'),
            TextColumn::make('asignaturas')
                ->label('Asignaturas')
                ->getStateUsing(function ($record) {
                    return $record->asignaturas->pluck('nombre')->join(', ');
                }),
        ])
        ->filters([
            // No filters are defined for this table
        ])
        ->headerActions([
            // No header actions are defined for this table
        ])
        ->actions([
            // No actions are defined for this table
        ])
        ->bulkActions([
            // No bulk actions are defined for this table
        ]);
}
```

This method returns a `Table` object that displays two columns: `nombre` and `asignaturas`. The `asignaturas` column is displayed as a label of `'Asignaturas'` and uses the `getStateUsing` method to retrieve the names of the associated asignaturas records.