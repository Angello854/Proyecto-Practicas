# Documentation: EditAsignatura.php

Original file: `app/Filament\Resources\AsignaturaResource\Pages\EditAsignatura.php`

# EditAsignatura Documentation

Table of Contents:
[TOC]

## Introduction

The `EditAsignatura` class is a part of the `Filament\Resources\Pages` namespace, responsible for editing existing asignatura records in the system. This documentation aims to provide an in-depth understanding of the code's functionality and its role within the application.

## Overview

The `EditAsignatura` class extends the `EditRecord` class from Filament, which provides a foundation for building CRUD (Create, Read, Update, Delete) operations. The purpose of this class is to allow users to edit existing asignatura records.

### Methods and Functions

#### `getHeaderActions()`

Purpose: Returns an array of header actions available when editing an asignatura record.

* Parameters: None
* Return Value: An array of Actions objects

Description: This method returns an array containing the `DeleteAction` object, allowing users to delete the asignatura record.