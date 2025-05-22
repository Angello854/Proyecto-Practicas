# Documentation: UserFactory.php

Original file: `database/factories\UserFactory.php`

# UserFactory Documentation
=====================================

Table of Contents
-----------------

[TOC]

Introduction
------------

The `UserFactory` is a class responsible for generating fake user data for testing purposes. This factory is part of the database factories in a Laravel application, specifically designed to create and manipulate user models.

Method: `definition()`
-------------------------------

### Purpose

The `definition()` method defines the default state for a newly created user model.

### Parameters and Return Values

* Returns: An associative array representing the default user attributes.
* No parameters are required for this method.

### Functionality

This method generates a set of default attributes for a new user, including:

* `name`: A fake name generated using the Faker library.
* `email`: A unique email address generated using the Faker library.
* `email_verified_at`: The current date and time.
* `password`: A hashed password generated using the Hash facade. This value is stored in the class-level property `$password` for future use.
* `remember_token`: A random 10-character token generated using the Str facade.

Code Block: Definition Method
```php
public function definition(): array
{
    return [
        'name' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'email_verified_at' => now(),
        'password' => static::$password ??= Hash::make('password'),
        'remember_token' => Str::random(10),
    ];
}
```

Method: `unverified()`
-------------------------------

### Purpose

The `unverified()` method modifies the default state of a user model to indicate that its email address has not been verified.

### Parameters and Return Values

* Returns: The modified factory instance.
* No parameters are required for this method.

### Functionality

This method sets the `email_verified_at` attribute to null, indicating that the user's email address is not verified. This allows for scenarios where users have unverified emails in the system.

Code Block: Unverified Method
```php
public function unverified(): static
{
    return $this->state(fn (array $attributes) => [
        'email_verified_at' => null,
    ]);
}
```

Conclusion
----------

The `UserFactory` class provides a robust way to generate fake user data for testing purposes. Its `definition()` method defines the default state of a new user, while the `unverified()` method allows for scenarios where users have unverified emails. By understanding how this factory works and why it exists, developers can effectively utilize it in their testing processes.