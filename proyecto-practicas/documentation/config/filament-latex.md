# Documentation: filament-latex.php

Original file: `config/filament-latex.php`

# Filament Latex Configuration Documentation

Table of Contents:
=====================

* [Introduction](#introduction)
* [Configuration Options](#configuration-options)
* [Parser Settings](#parser-settings)
* [PDF Settings](#pdf-settings)

## Introduction
===============

The `filament-latex.php` file is a configuration file for the Filament Latex package in a PHP application. It provides options and settings for rendering LaTeX documents as PDF files.

This documentation aims to explain each configuration option, its purpose, and how it affects the behavior of the Filament Latex package.

## Configuration Options
=====================

The `filament-latex.php` file contains an array of key-value pairs that configure the Filament Latex package. Here is a breakdown of each option:

### Navigation Icon
-------------------

* Purpose: Set the navigation icon for the LaTeX editor.
* Type: String or null (default).
* Description: The navigation icon can be set to any string value, including null.

### User Model
--------------

* Purpose: Specify the user model used by Filament Latex.
* Type: Class name (e.g., `App\Models\User`).
* Description: This option specifies the class name of the user model that will be used to authenticate and authorize users.

### Resource
------------

* Purpose: Specify the resource class used by Filament Latex.
* Type: Class name (e.g., `\TheThunderTurner\FilamentLatex\Resources\FilamentLatexResource`).
* Description: This option specifies the class name of the resource that will be used to handle LaTeX document rendering.

### Storage
------------

* Purpose: Specify the storage disk used by Filament Latex.
* Type: String (e.g., `'private'`).
* Description: This option specifies the storage disk that will be used to store rendered PDF files. The default is `'private'`, which corresponds to the `private` filesystem disk.

### Storage URL
----------------

* Purpose: Specify the URL for the storage disk.
* Type: String (e.g., `/private_storage`).
* Description: This option specifies the URL that will be used to generate download links for rendered PDF files. The default is based on the storage disk name.

### Parser
---------

* Purpose: Specify the LaTeX parser used by Filament Latex.
* Type: String (e.g., `'/usr/bin/pdflatex'`).
* Description: This option specifies the command-line executable that will be used to compile LaTeX documents. The default is `pdflatex`, but you can specify other options like `xelatex` or `lualatex`.

### Compilation Timeout
----------------------

* Purpose: Set the maximum time for compilation to finish.
* Type: Integer (e.g., `60`).
* Description: This option specifies the maximum time in seconds that Filament Latex will wait for the LaTeX parser to complete its task.

### Strict Compilation
---------------------

* Purpose: Enable or disable strict compilation mode.
* Type: Boolean (e.g., `false`).
* Description: This option enables or disables strict compilation mode, which throws exceptions on compilation errors. The default is `false`, so Filament Latex will not throw exceptions.

### Avatar Columns
-------------------

* Purpose: Show or hide avatar columns in the LaTeX editor.
* Type: Boolean (e.g., `false`).
* Description: This option enables or disables the display of avatar columns, which show the names and images of authors and collaborators. The default is `false`, so avatar columns are not shown.

### Paginate
----------

* Purpose: Enable or disable PDF pagination.
* Type: Boolean (e.g., `false`).
* Description: This option enables or disables pagination for rendered PDF files. When `paginate` is `true`, Filament Latex will generate next/prev buttons to navigate through the document.

### LaTeX JS
-------------

* Purpose: Enable or disable LaTeX JavaScript rendering.
* Type: Boolean (e.g., `true`).
* Description: This option enables or disables the use of LaTeX JavaScript for rendering PDF files. When `latex-js` is `true`, Filament Latex will render PDF files using PDF.js; otherwise, it will use the browser's default PDF viewer.

## Conclusion
==========

This documentation provides a comprehensive overview of the configuration options available in the `filament-latex.php` file. By understanding each option and its purpose, developers can effectively customize the behavior of the Filament Latex package to suit their needs.