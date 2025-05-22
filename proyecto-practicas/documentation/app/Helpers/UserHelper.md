# Documentation: UserHelper.php

Original file: `app/Helpers\UserHelper.php`

# UserHelper Documentation

## Table of Contents

* [Introduction](#introduction)
* [getUser Method](#getuser-method)
* [getUserRol Method](#getuserrol-method)
* [getUserId Method](#getuserid-method)
* [getUserName Method](#getusername-method)

## Introduction

The UserHelper file provides a set of utility functions for working with user-related data in the application. This file is designed to simplify the process of accessing and manipulating user information, making it easier for developers to build upon.

## getUser Method

### Purpose

The `getUser` method retrieves the currently authenticated user's data.

### Parameters and Return Values

* No parameters required
* Returns a `User` object representing the authenticated user

### Functionality

This method uses Laravel's built-in authentication functionality to retrieve the current user. The returned `User` object contains attributes such as `id`, `name`, and `rol`, which can be accessed using the getter methods provided by this file.

```php
/**
 * @return User
 */
function getUser(): User
{
    /** @var User $user */
    $user = auth()->user();
    return $user;
}
```

## getUserRol Method

### Purpose

The `getUserRol` method retrieves the current user's role as an enumeration value.

### Parameters and Return Values

* No parameters required
* Returns a `Rol` enumeration value representing the user's role

### Functionality

This method uses the `getAttribute` method of the retrieved user object to access the `rol` attribute. The returned `Rol` value can be used to determine the current user's role in the application.

```php
/**
 * @return Rol
 */
function getUserRol(): Rol
{
    return getUser()->getAttribute('rol');
}
```

## getUserId Method

### Purpose

The `getUserId` method retrieves the current user's unique identifier.

### Parameters and Return Values

* No parameters required
* Returns an integer value representing the user's ID

### Functionality

This method uses the `getAttribute` method of the retrieved user object to access the `id` attribute. The returned integer value represents the unique identifier for the current user.

```php
/**
 * @return int
 */
function getUserId(): int
{
    return getUser()->getAttribute('id');
}
```

## getUserName Method

### Purpose

The `getUserName` method retrieves the current user's full name.

### Parameters and Return Values

* No parameters required
* Returns a string value representing the user's full name

### Functionality

This method uses the `getAttribute` method of the retrieved user object to access the `name` attribute. The returned string value represents the full name of the current user.

```php
/**
 * @return string
 */
function getUserName(): string
{
    return getUser()->getAttribute('name');
}
```

By using these utility functions, developers can easily access and manipulate user-related data without having to worry about the underlying implementation details.