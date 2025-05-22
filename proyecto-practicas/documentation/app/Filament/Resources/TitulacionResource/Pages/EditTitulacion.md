# Documentation: EditTitulacion.php

Original file: `app/Filament\Resources\TitulacionResource\Pages\EditTitulacion.php`

# EditTitulacion Documentation

Table of Contents: [TOC](#toc)

Introduction
============

The `EditTitulacion` class is a part of the Filament Resources framework, specifically designed to handle edit operations for Titulación records. This file provides a detailed explanation of the purpose and functionality of this class.

Class Overview
--------------

```php
class EditTitulacion extends EditRecord
```

This class extends the `EditRecord` class from the Filament Resources package, which provides basic editing functionality. The `EditTitulacion` class overrides some methods to customize its behavior for Titulación records.

Methods
-------

### getHeaderActions

```php
protected function getHeaderActions(): array
{
    return [
        Actions\DeleteAction::make(),
    ];
}
```

This method returns an array of header actions that can be displayed in the edit form. In this case, it includes a Delete Action button.

### mutateFormDataBeforeSave

```php
protected function mutateFormDataBeforeSave(array $data): array
{
    // ...
}
```

This method is called before saving the edited data to the database. It makes some modifications to the data:

* If `cursos` is a string, it explodes the string into an array of course IDs.
* If `cursos` is not an array, it sets it to an empty array.
* It deletes any existing Titulación-Curso relationships for the current record.
* It creates new relationships between the current record and each course ID in the `$cursos` array.

Finally, it unsets the `cursos` key from the data before returning it.

### mutateFormDataBeforeFill

```php
protected function mutateFormDataBeforeFill(array $data): array
{
    // ...
}
```

This method is called before filling the edit form with the current record's data. It makes some modifications to the data:

* If `cursos` is not null, it sets it to an array of course IDs fetched from the database using the current record's relationships.
* It returns the modified data.

Conclusion
==========

The `EditTitulacion` class provides customized editing functionality for Titulación records in the Filament Resources framework. Its methods handle header actions, pre-save and pre-fill data manipulation, and relationship management between Titulación records and course IDs.

By understanding this class's purpose and behavior, developers can better integrate it into their application and create a seamless user experience.

[TOC](#toc)