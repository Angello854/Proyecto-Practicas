# Documentation: AsignaturaTarea.php

Original file: `app/Models\AsignaturaTarea.php`

# AsignaturaTarea Documentation

Table of Contents: 
[# Introduction](#introduction), 
[# Methods](#methods)

## Introduction

The `AsignaturaTarea` class is a model in the PHP application, responsible for handling tasks related to assignments. This documentation provides an overview of the class's purpose, methods, and properties.

## Methods

### __construct()

* Purpose: Initializes the AsignaturaTarea object.
* Parameters: None
* Return values: None
* Description: The constructor is called when an instance of this class is created. It sets up the necessary properties and relationships for the model.

```
public function __construct()
{
    // Code block with appropriate syntax highlighting
}
```

### getTable()

* Purpose: Returns the name of the database table associated with this model.
* Parameters: None
* Return values: `string` (the name of the table)
* Description: This method provides access to the underlying database table used by the model.

`$table = AsignaturaTarea::getTable(); // returns 'asignatura_tarea'`

### getFillable()

* Purpose: Returns an array of fillable attributes for this model.
* Parameters: None
* Return values: `array` (the list of fillable attributes)
* Description: This method provides access to the properties that can be mass-assigned using the `fill` or `create` methods.

`$fillableAttributes = AsignaturaTarea::getFillable(); // returns ['asignatura_id', 'tarea_id']`

### getTable()

* Purpose: Sets the name of the database table associated with this model.
* Parameters: `string` (the new table name)
* Return values: None
* Description: This method allows you to change the underlying database table used by the model.

Example usage:
```
AsignaturaTarea::setTable('new_table_name');
```

### getFillable()

* Purpose: Sets an array of fillable attributes for this model.
* Parameters: `array` (the new list of fillable attributes)
* Return values: None
* Description: This method allows you to change the properties that can be mass-assigned using the `fill` or `create` methods.

Example usage:
```
AsignaturaTarea::setFillable(['new_attribute1', 'new_attribute2']);
```