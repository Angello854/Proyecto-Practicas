# Documentation: UserResource.php

Original file: `app/Filament\Resources\UserResource.php`

# UserResource Documentation

## Table of Contents

* [Introduction](#introduction)
* [Methods](#methods)
	+ [getModel](#getmodel)
	+ [getPluralModelLabel](#getpluralmodellabel)
	+ [getEloquentQuery](#geteloquentquery)
	+ [form](#form)
	+ [table](#table)
* [Properties](#properties)
	+ [$model](#$model)
	+ [$navigationIcon](#$navigationicon)

## Introduction

The UserResource class is a part of the Filament package, which provides a framework for building web applications. This class handles user-related data and provides methods for filtering, sorting, and displaying users.

## Methods

### `getModel`

The `getModel` method returns the model associated with this resource. In this case, it returns the `User` model.

```php
protected static ?string $model = User::class;
```

### `getPluralModelLabel`

The `getPluralModelLabel` method returns the plural label for the model. This is used in Filament to display the correct number of records found.

```php
public static function getPluralModelLabel(): string
{
    return 'usuarios';
}
```

### `getEloquentQuery`

The `getEloquentQuery` method returns an Eloquent query builder instance that can be used to filter and sort users. The method checks the user's role and applies filters based on it.

```php
public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
{
    // ...
}
```

### `form`

The `form` method returns a Filament form instance that can be used to create, update, or delete users. The method defines various fields and validates the data.

```php
public static function form(Form $form): Form
{
    // ...
}
```

### `table`

The `table` method returns a Filament table instance that can be used to display user data. The method defines various columns and filters for the table.

```php
public static function table(Table $table): Table
{
    // ...
}
```

## Properties

### `$model`

The `$model` property specifies the model associated with this resource. In this case, it is the `User` model.

```php
protected static ?string $model = User::class;
```

### `$navigationIcon`

The `$navigationIcon` property specifies the icon to be used for navigation in Filament. In this case, it is set to 'heroicon-o-identification'.

```php
protected static ?string $navigationIcon = 'heroicon-o-identification';
```

Note: This documentation template is not exhaustive and should be expanded upon based on the specific requirements of your project.