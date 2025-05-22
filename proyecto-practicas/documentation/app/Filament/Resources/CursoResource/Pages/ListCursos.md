# Documentation: ListCursos.php

Original file: `app/Filament\Resources\CursoResource\Pages\ListCursos.php`

# ListCursos Documentation

[TOC](#table-of-contents)

## Introduction

The `ListCursos` class is a part of the `CursoResource` package in the `Filament` framework, responsible for listing courses. This file defines a page that allows users to view and manage courses.

### Table of Contents

* [Overview](#overview)
* [Purpose and Role](#purpose-and-role)
* [Methods](#methods)
	+ [getHeaderActions()](#getheaderactions)

## Overview

The `ListCursos` class is an extension of the `ListRecords` class from the `Filament` framework. It provides a way to list courses, which are managed by the `CursoResource`.

## Purpose and Role

The primary purpose of this file is to provide a page for users to view and manage courses. This page will display a list of available courses, allowing users to filter, sort, and search for specific courses.

### Methods

#### getHeaderActions()

```php
protected function getHeaderActions(): array
{
    return [
        Actions\CreateAction::make(),
    ];
}
```

##### Purpose and Parameters

The `getHeaderActions()` method is responsible for defining the actions that should be displayed in the header of the page. This method returns an array of action instances.

* **Return value**: An array of `Actions` instances.

##### Functionality

This method returns an array containing a single `CreateAction` instance, which allows users to create new courses.

#### Other Methods (Not Documented)

This class also extends the `ListRecords` class and inherits its methods. These methods are not documented here as they are part of the base class and have their own documentation.

## Conclusion

The `ListCursos` class is responsible for providing a page for users to view and manage courses. This file defines a set of actions that can be performed on this page, including creating new courses.