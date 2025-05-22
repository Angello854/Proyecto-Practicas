# Documentation: Rol.php

Original file: `app/Enums\Rol.php`

# Rol Documentation
======================================================

### Table of Contents

* [Introduction](#introduction)
* [Enum Definition](#enum-definition)
* [Methods](#methods)
	+ [getLabel()](#getlabel)
	+ [getIcon()](#geticon)
	+ [getColor()](#getcolor)
	+ [options()](#options)

### Introduction
----------------

The `Rol` enum is a critical component of the application, providing a set of predefined roles that can be used to categorize users. This documentation will cover the purpose and functionality of the `Rol` enum.

### Enum Definition
------------------

The `Rol` enum is defined in the `App\Enums` namespace and implements three contracts: `HasIcon`, `HasLabel`, and `HasColor`. This allows the enum values to have associated icons, labels, and colors.

```php
enum Rol: string implements HasIcon, HasLabel, HasColor
{
    // Enum cases
}
```

### Methods
-------------

#### getLabel()
----------------

The `getLabel()` method returns a string representing the label for the given enum value. The implementation uses a match statement to determine the correct label based on the enum case.

```php
public function getLabel(): string
{
    return match ($this) {
        self::Admin => 'Administrador',
        self::Alumno => 'Alumno',
        self::TutorLaboral => 'Tutor Laboral',
        self::TutorDocente => 'Tutor Docente',
    };
}
```

#### getIcon()
-----------------

The `getIcon()` method returns a string representing the icon for the given enum value. The implementation uses a match statement to determine the correct icon based on the enum case.

```php
public function getIcon(): string
{
    return match ($this) {
        self::Admin => 'heroicon-o-shield-check',
        self::Alumno => 'heroicon-o-academic-cap',
        self::TutorLaboral, self::TutorDocente  => 'heroicon-o-user-circle',
    };
}
```

#### getColor()
-----------------

The `getColor()` method returns an array representing the color for the given enum value. The implementation uses a match statement to determine the correct color based on the enum case.

```php
public function getColor(): array
{
    return match ($this) {
        self::Admin => Color::Red,
        self::Alumno => Color::Amber,
        self::TutorLaboral => Color::Green,
        self::TutorDocente => Color::Purple,
    };
}
```

#### options()
-----------------

The `options()` method returns an array of enum cases and their corresponding labels. The implementation uses the `collect` and `mapWithKeys` methods to transform the enum cases into a desired format.

```php
public static function options(): array
{
    return collect(self::cases())
        ->mapWithKeys(fn($case) => [$case->value => $case->getLabel()])
        ->toArray();
}
```

By using the `Rol` enum, developers can easily work with predefined roles and take advantage of the associated icons, labels, and colors. This documentation should provide a solid understanding of how to use and extend this critical component of the application.