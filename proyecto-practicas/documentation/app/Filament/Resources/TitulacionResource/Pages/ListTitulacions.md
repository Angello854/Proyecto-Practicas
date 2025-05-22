# Documentation: ListTitulacions.php

Original file: `app/Filament\Resources\TitulacionResource\Pages\ListTitulacions.php`

# ListTitulacions Documentation

**Table of Contents**
==================

* [Introduction](#introduction)
* [Class Definition](#class-definition)
	+ [getHeaderActions Method](#getheaderactions-method)

## Introduction
=============

The `ListTitulacions` class is a part of the TitulacionResource's Pages in the Filament framework. This class extends the `ListRecords` class and handles listing records of Titulaciones.

## Class Definition
==================

### ListTitulacions Class

```php
<?php

namespace App\Filament\Resources\TitulacionResource\Pages;

use App\Filament(Resources\TitulacionResource);
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTitulacions extends ListRecords
{
    protected static string $resource = TitulacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
```

### getHeaderActions Method
-------------------------

The `getHeaderActions` method returns an array of header actions. In this case, it only includes a `CreateAction`.

```php
protected function getHeaderActions(): array
{
    return [
        Actions\CreateAction::make(),
    ];
}
```

#### Parameters

* None

#### Return Values

* An array of header actions

#### Functionality

The `getHeaderActions` method is used to define the actions that will be displayed in the page's header. In this case, it only includes a "Create" action, which allows users to create new Titulaciones.

This class serves as an entry point for listing records of Titulaciones and provides basic functionality for creating new records.