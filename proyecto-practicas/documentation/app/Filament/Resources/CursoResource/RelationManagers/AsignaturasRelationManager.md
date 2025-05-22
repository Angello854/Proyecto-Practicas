# Documentation: AsignaturasRelationManager.php

Original file: `app/Filament\Resources\CursoResource\RelationManagers\AsignaturasRelationManager.php`

# AsignaturasRelationManager Documentation

Table of Contents:

* [Introduction](#introduction)
* [Relationships](#relationships)
* [Form](#form)
* [Table](#table)

## Introduction

The `AsignaturasRelationManager` class is a part of the CursoResource in the Filament framework. It is responsible for managing the relationship between the CursoResource and the Asignatura model.

## Relationships

The `AsignaturasRelationManager` has a one-to-many relationship with the `Asignatura` model, as defined by the `protected static string $relationship = 'asignaturas';`. This means that each curso can have multiple asignaturas, but an asignatura can only belong to one curso.

## Form

The form method of the `AsignaturasRelationManager` class returns a Filament\Form instance. The schema for this form is currently empty:

```php
public function form(Form $form): Form
{
    return $form
        ->schema([
        ]);
}
```

This means that no fields will be displayed in the form.

## Table

The table method of the `AsignaturasRelationManager` class returns a Filament\Table instance. The columns for this table include:

* A text column for the nombre field of the Asignatura model
* A text column for the profesores field of the Asignatura model, which displays the names of the professors associated with each asignatura

The record title attribute is set to 'Asignaturas', and the header actions and bulk actions are currently empty:

```php
public function table(Table $table): Table
{
    return $table
        ->recordTitleAttribute('Asignaturas')
        ->columns([
            TextColumn::make('nombre'),
            TextColumn::make('profesores')
                ->label('Profesores')
                ->getStateUsing(function ($record) {
                    return $record->profesores->pluck('name')->join(', ');
                }),
        ])
        ->filters([
        ])
        ->headerActions([
        ])
        ->actions([
        ])
        ->bulkActions([
        ]);
}
```

This table will display a list of asignaturas, with the nombre and profesores columns. The profesores column will display a comma-separated list of the names of the professors associated with each asignatura.