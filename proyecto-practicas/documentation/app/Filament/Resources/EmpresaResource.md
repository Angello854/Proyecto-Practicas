# Documentation: EmpresaResource.php

Original file: `app/Filament\Resources\EmpresaResource.php`

# EmpresaResource Documentation

## Table of Contents

* [Introduction](#introduction)
* [Methods](#methods)
	+ [getEloquentQuery](#geteloquentquery)
	+ [form](#form)
	+ [table](#table)
	+ [getRelations](#getrelations)
	+ [getPages](#getpages)

## Introduction

The `EmpresaResource` class is a resource in the Filament framework, specifically designed to manage and manipulate Empresa models. This documentation aims to provide an overview of the class's methods and functionality.

## Methods

### getEloquentQuery()

Purpose: This method returns an Eloquent query that can be used to retrieve Empresa records based on the user's role.

Return value: An Illuminate\Database\Eloquent\Builder object representing the query.

Code:
```php
public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
{
    $query = parent::getEloquentQuery();

    if (getUserRol() === Rol::TutorDocente) {
        // Obtener IDs de empresa de los alumnos que tutorea como tutor docente
        $empresaIds = \App\Models\Tutor::where('tutor_docente_id', getUserId())
            ->pluck('empresa_id');
        return $query->whereIn('id', $empresaIds);
    }

    if (getUserRol() === Rol::TutorLaboral) {
        // Obtener IDs de empresa de los alumnos que tutorea como tutor laboral
        $empresaIds = \App\Models\Tutor::where('tutor_laboral_id', getUserId())
            ->pluck('empresa_id');
        return $query->whereIn('id', $empresaIds);
    }

    return $query;
}
```

Description: This method uses the `getUserRol()` and `getUserId()` functions to determine the user's role. Based on the role, it retrieves the IDs of the empresas that the user is associated with as a tutor docente or tutor laboral. The query is then modified to only retrieve records with these IDs.

### form()

Purpose: This method returns a Filament Form object for creating and editing Empresa records.

Return value: A Filament\Forms\Form object representing the form.

Code:
```php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            Hidden::make('id'),

            TextInput::make('nombre')->label('Nombre')->required()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio.',
                ]),

            Select::make('tutor_laboral_id')
                ->label('Tutor Laboral')
                ->options(fn () => User::where('rol', 'tutor_laboral')->pluck('name', 'id'))
                ->searchable()
                ->dehydrated()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio.',
                ])
                ->required(),

            Shout::make('importante')
                ->content('Rellene los campos obligatorios')
                ->iconSize('xl')
                ->visible(fn (string $context) => $context === 'create')
                ->color(Color::Zinc),
        ]);
}
```

Description: This method returns a form with the following fields:
- `id`: A hidden field for the Empresa's ID.
- `nombre`: A text input field for the Empresa's name, required.
- `tutor_laboral_id`: A select field for the tutor laboral associated with the Empresa, required.

The form also includes a shout component that displays an important message when creating a new record.

### table()

Purpose: This method returns a Filament Table object for displaying and editing Empresa records.

Return value: A Filament\Tables\Table object representing the table.

Code:
```php
public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('id')->label('ID')
                ->visible(getUserRol() === Rol::Admin),

            TextColumn::make('nombre')->label('Nombre'),

            TextColumn::make('tutorLaboral.name')
                ->label('Tutor Laboral'),

            TextColumn::make('tutorLaboral.email')
                ->label('Correo'),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}
```

Description: This method returns a table with the following columns:
- `id`: A text column for the Empresa's ID, only visible to administrators.
- `nombre`: A text column for the Empresa's name.
- `tutorLaboral.name` and `tutorLaboral.email`: Text columns for the tutor laboral associated with the Empresa.

The table also includes filters, actions (edit), and bulk actions (delete).

### getRelations()

Purpose: This method returns an array of relations for the Empresa model.

Return value: An array of relation objects.

Code:
```php
public static function getRelations(): array
{
    return [
        //
    ];
}
```

Description: This method is used to define the relations between the Empresa model and other models in the system. The exact implementation depends on the specific requirements of your application.

### getPages()

Purpose: This method returns an array of pages for the Empresa resource.

Return value: An array of page objects.

Code:
```php
public static function getPages(): array
{
    return [
        'index' => Pages\ListEmpresas::route('/'),
        'create' => Pages\CreateEmpresa::route('/create'),
        'edit' => Pages\EditEmpresa::route('/{record}/edit'),
    ];
}
```

Description: This method returns an array of pages for the Empresa resource, including:
- `index`: A page for listing all empresas.
- `create`: A page for creating a new empresa.
- `edit`: A page for editing an existing empresa.

Each page has its own route and is handled by the corresponding controller action.