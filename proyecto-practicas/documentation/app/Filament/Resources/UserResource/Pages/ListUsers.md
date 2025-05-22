# Documentation: ListUsers.php

Original file: `app/Filament\Resources\UserResource\Pages\ListUsers.php`

# ListUsers Documentation

## Table of Contents
[# Introduction](#introduction)
[# Methods](#methods)
[# Header Actions](#header-actions)

## Introduction

The `ListUsers` class is part of the `UserResource` pages in the Filament framework, responsible for managing user records. This file provides a list view of users and includes actions to create new users.

## Methods

### getHeaderActions()

#### Purpose

This method returns an array of header actions that can be used in the page.

#### Parameters

* None

#### Return Values

* An array of `Actions` objects

#### Functionality

The `getHeaderActions()` method returns an array containing a single `CreateAction` object. This action allows users to create new user records from the list view.

```php
return [
    Actions\CreateAction::make(),
];
```

## Header Actions

### CreateAction

#### Purpose

The `CreateAction` allows users to create new user records from the list view.

#### Parameters

* None

#### Return Values

* None

#### Functionality

When the user clicks on the "Create" button, they will be taken to a new page where they can enter the necessary information for the new user record. The form data will then be validated and persisted in the database.

### Notes

* This class extends `ListRecords` which is part of Filament's built-in functionality for listing records.
* The `getHeaderActions()` method is used to return an array of header actions that can be used in the page.
* The `CreateAction` allows users to create new user records from the list view.