# Documentation: LatexHelper.php

Original file: `app/Helpers\LatexHelper.php`

# LatexHelper Documentation

## Table of Contents
[#Introduction](#introduction)
[#Latex Escape Method](#latex-escape-method)
[#Latex Format Multiline Method](#latex-format-multiline-method)

## Introduction
The `LatexHelper` file provides two utility functions for working with LaTeX syntax in PHP applications. These functions help developers avoid common issues when escaping special characters and formatting text for use in LaTeX documents.

## Latex Escape Method

### Purpose
The `latex_escape()` function takes a string as input and returns the same string, but with all special LaTeX characters escaped.

### Parameters
* `$string`: The input string to be escaped. Can be null.

### Return Value
A string with all special LaTeX characters escaped for use in LaTeX documents.

### Functionality
The `latex_escape()` function uses an array of replacements to swap out special LaTeX characters (such as backslashes, parentheses, and ampersands) with their LaTeX escapes (e.g., `\textbackslash{}`, `\{`, etc.). This ensures that the input string can be safely used in a LaTeX document without causing errors or unexpected behavior.

### Example Usage
```php
$string = 'Hello \*world\*\';
$escaped_string = latex_escape($string);
echo $escaped_string; // Output: Hello \\textbackslash{}world\\textbackslash{}\''
```

## Latex Format Multiline Method

### Purpose
The `latex_format_multiline()` function takes a string as input and returns the same string, but formatted for use in LaTeX documents. This involves escaping special characters and replacing newline characters with `\par` statements.

### Parameters
* `$text`: The input text to be formatted. Can be null.

### Return Value
A string formatted for use in LaTeX documents, with special characters escaped and newline characters replaced with `\par` statements.

### Functionality
The `latex_format_multiline()` function first escapes any special LaTeX characters using the `latex_escape()` function. Then, it replaces newline characters (`\r\n`, `\n`, or `\r`) with `\par` statements to ensure proper formatting in LaTeX documents.

### Example Usage
```php
$text = "This is a test\nwith multiple lines.\nAnd another one.";
$formatted_text = latex_format_multiline($text);
echo $formatted_text; // Output: This is a test\parwith multiple lines.\parAnd another one.
```

Note that the `latex_format_multiline()` function assumes that any newline characters in the input text should be replaced with `\par` statements. If this is not the desired behavior, you may need to modify the function or use it in conjunction with other formatting techniques.