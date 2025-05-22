# Documentation: UserPolicy.php

Original file: `app/Policies\UserPolicy.php`

# UserPolicy Documentation

Table of Contents
================

* [Introduction](#introduction)
* [Method Reference](#method-reference)
	+ [viewAny](#viewany)
	+ [view](#view)
	+ [create](#create)
	+ [update](#update)
	+ [delete](#delete)
	+ [restore](#restore)
	+ [forceDelete](#forcedelete)

Introduction
============

The `UserPolicy` class is responsible for managing user-related actions in the application. It determines whether a user can perform specific operations on models, such as viewing, creating, updating, or deleting.

Method Reference
================

### viewAny

Purpose: Determine whether the user can view any models.

Parameters:

* `$user`: The authenticated user.
* No additional parameters are required.

Return Value: A boolean indicating whether the user can view any models.

Functionality:
The `viewAny` method checks if the user's role is not an Alumno (Student). If it is, the method returns false; otherwise, it returns true. This ensures that students cannot view any models.

### view

Purpose: Determine whether the user can view a specific model.

Parameters:

* `$user`: The authenticated user.
* `$model`: The User model being viewed.
* No additional parameters are required.

Return Value: A boolean indicating whether the user can view the model.

Functionality:
The `view` method is similar to `viewAny`, but it also checks if the user's role is not an Alumno. If it is, the method returns false; otherwise, it returns true.

### create

Purpose: Determine whether the user can create a new model.

Parameters:

* `$user`: The authenticated user.
* No additional parameters are required.

Return Value: A boolean indicating whether the user can create a new model.

Functionality:
The `create` method checks if the user's role is an Admin. If it is, the method returns true; otherwise, it returns false. This ensures that only administrators can create new models.

### update

Purpose: Determine whether the user can update an existing model.

Parameters:

* `$user`: The authenticated user.
* `$model`: The User model being updated.
* No additional parameters are required.

Return Value: A boolean indicating whether the user can update the model.

Functionality:
The `update` method is similar to the `create` method, but it also checks if the user's role is an Admin. If it is, the method returns true; otherwise, it returns false.

### delete

Purpose: Determine whether the user can delete a model.

Parameters:

* `$user`: The authenticated user.
* `$model`: The User model being deleted.
* No additional parameters are required.

Return Value: A boolean indicating whether the user can delete the model.

Functionality:
The `delete` method is similar to the `update` method, but it also checks if the user's role is an Admin. If it is, the method returns true; otherwise, it returns false.

### restore

Purpose: Determine whether the user can restore a deleted model.

Parameters:

* `$user`: The authenticated user.
* `$model`: The User model being restored.
* No additional parameters are required.

Return Value: A boolean indicating whether the user can restore the model.

Functionality:
The `restore` method always returns false, indicating that users cannot restore deleted models.

### forceDelete

Purpose: Determine whether the user can permanently delete a model.

Parameters:

* `$user`: The authenticated user.
* `$model`: The User model being permanently deleted.
* No additional parameters are required.

Return Value: A boolean indicating whether the user can permanently delete the model.

Functionality:
The `forceDelete` method always returns false, indicating that users cannot permanently delete models.