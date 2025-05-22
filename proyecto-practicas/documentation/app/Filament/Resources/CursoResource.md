# Documentation: CursoResource.php

Original file: `app/Filament\Resources\CursoResource.php`

# CursoResource Documentation

Table of Contents
=================

* [Introduction](#introduction)
* [Methods](#methods)
	+ [getEloquentQuery()](#geteloquentquery)
	+ [form()](#form)
	+ [table()](#table)
	+ [getRelations()](#getrelations)
	+ [getPages()](#getpages)

Introduction
============

The `CursoResource` class is a part of the Filament package in PHP, which provides a set of tools for building custom administrative interfaces. This documentation aims to explain the purpose and functionality of this file.

Methods
=======

### getEloquentQuery()

The `getEloquentQuery()` method returns an Eloquent query object that represents the Curso model's data. This method is used by Filament to retrieve data from the database.

```php
public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
{
    $query = parent::getEloquentQuery();

    if (getUserRol() === Rol::TutorDocente) {
        return $query->whereHas('asignaturas.profesores', function ($q) {
            $q->where('users.id', getUserId());
        });
    }

    return $query;
}
```

This method checks the current user's role and modifies the query accordingly. If the user is a tutor or docente, it filters the results to only include courses that have asignaturas with professors who are the same as the current user.

### form()

The `form()` method returns a Filament Form object that represents the Curso model's data. This method is used by Filament to render forms for creating and editing Curso records.

```php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            // ...
        ]);
}
```

This method defines the schema for the form, which includes fields for the Curso model's attributes. The fields are defined as Hidden, TextInput, Select, and Shout components.

### table()

The `table()` method returns a Filament Table object that represents the Curso model's data. This method is used by Filament to render tables for displaying and editing Curso records.

```php
public static function table(Table $table): Table
{
    return $table
        ->columns([
            // ...
        ])
        ->filters([
            // ...
        ])
        ->actions([
            // ...
        ])
        ->bulkActions([
            // ...
        ]);
}
```

This method defines the columns, filters, actions, and bulk actions for the table.

### getRelations()

The `getRelations()` method returns an array of relation manager classes that are associated with the Curso model. This method is used by Filament to load related data from the database.

```php
public static function getRelations(): array
{
    return [
        AsignaturasRelationManager::class,
    ];
}
```

This method returns an array containing the AsignaturasRelationManager class, which represents the relation between Curso and Asignatura models.

### getPages()

The `getPages()` method returns an array of page routes that are associated with the Curso model. This method is used by Filament to generate navigation for the application.

```php
public static function getPages(): array
{
    return [
        'index' => Pages\ListCursos::route('/'),
        'create' => Pages\CreateCurso::route('/create'),
        'edit' => Pages\EditCurso::route('/{record}/edit'),
    ];
}
```

This method returns an array containing the page routes for listing, creating, and editing Curso records.

Conclusion
==========

The `CursoResource` class provides a set of methods and properties that are used by Filament to manage Curso model data. It includes filtering, validation, and relation management functionality. This documentation aims to provide a comprehensive understanding of how this file works and why it exists in the system.