# Documentation: UserObserver.php

Original file: `app/Observers\UserObserver.php`

# UserObserver Documentation
=====================================================

Table of Contents
-----------------

### Introduction

The `UserObserver` class is a part of the Laravel application's observer system, which allows you to perform actions on models after certain events occur. In this case, the `UserObserver` is responsible for creating, updating, and deleting records in the `Tutor` model based on the user's role.

### Methods

#### created(User $user)

The `created` method is called when a new user is created. It checks if the user's role is an Alumno (Student) and creates a corresponding Tutor record using the provided request data (`tutor_docente_id`, `tutor_laboral_id`, and `empresa_id`). This ensures that the necessary tutor information is stored for each student.

```php
public function created(User $user): void
{
    if (getUserRol() === Rol::Alumno) {
        Tutor::create([
            'alumno_id' => $user->id,
            'tutor_docente_id' => request('tutor_docente_id'),
            'tutor_laboral_id' => request('tutor_laboral_id'),
            'empresa_id' => request('empresa_id'),
        ]);
    }
}
```

#### updated(User $user)

The `updated` method is called when a user's information is updated. It checks if the user's role is an Alumno (Student) and creates a new Tutor record or updates the existing one using the provided request data (`tutor_docente_id`, `tutor_laboral_id`, and `empresa_id`). This ensures that any changes to the student's tutor information are reflected in the database.

```php
public function updated(User $user): void
{
    if (getUserRol() === Rol::Alumno) {
        Tutor::create([
            'alumno_id' => $user->id,
            'tutor_docente_id' => request('tutor_docente_id'),
            'tutor_laboral_id' => request('tutor_laboral_id'),
            'empresa_id' => request('empresa_id'),
        ]);
    }
}
```

#### deleted(User $user)

The `deleted` method is called when a user's record is deleted. This method currently does not perform any actions, as the deletion of a user's record should not affect the tutor information.

```php
public function deleted(User $user): void
{
    // No action performed
}
```

#### restored(User $user)

The `restored` method is called when a soft-deleted user's record is restored. This method currently does not perform any actions, as restoring a user's record should not affect the tutor information.

```php
public function restored(User $user): void
{
    // No action performed
}
```

#### forceDeleted(User $user)

The `forceDeleted` method is called when a hard-deleted user's record is deleted. This method currently does not perform any actions, as deleting a user's record should not affect the tutor information.

```php
public function forceDeleted(User $user): void
{
    // No action performed
}
```

### Conclusion

The `UserObserver` class plays a crucial role in maintaining the relationship between users and tutors in the system. By creating, updating, or deleting Tutor records based on user events, this observer ensures that the necessary information is stored and updated accordingly.