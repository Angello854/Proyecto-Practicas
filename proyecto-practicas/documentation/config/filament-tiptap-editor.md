# Documentation: filament-tiptap-editor.php

Original file: `config/filament-tiptap-editor.php`

# Filament Tiptap Editor Configuration Documentation

Table of Contents
=================

* [Introduction](#introduction)
* [Configuration Options](#configuration-options)
	+ [Direction and Max Content Width](#direction-and-max-content-width)
	+ [Disable Stylesheet and Disable Link as Button](#disable-stylesheet-and-disable-link-as-button)
	+ [Profiles](#profiles)
	+ [Actions](#actions)
	+ [Output Format](#output-format)
	+ [Media Uploader](#media-uploader)
* [Menus](#menus)
* [Extensions](#extensions)
* [Preset Colors](#preset-colors)
* [Protocols](#protocols)

Introduction
============

The `filament-tiptap-editor.php` file contains the configuration options for the Filament Tiptap Editor. This editor is used to create and edit content in a variety of formats, including HTML, Markdown, and more.

Configuration Options
=====================

### Direction and Max Content Width

The `direction` option determines the direction of the text input, with `ltr` being the default value for left-to-right languages. The `max_content_width` option sets the maximum width of the content area in pixels.

```php
'direction' => 'ltr',
'max_content_width' => '5xl',
```

### Disable Stylesheet and Disable Link as Button

The `disable_stylesheet` option disables the stylesheet for the editor, while the `disable_link_as_button` option disables the link-as-button feature.

```php
'disable_stylesheet' => false,
'disable_link_as_button' => false,
```

### Profiles

The `profiles` option defines the available profiles for the toolbar. Each profile is a list of tools that can be added to the toolbar.

```php
'profiles' => [
    'default' => [
        // ...
    ],
    'simple' => ['heading', 'hr', 'bullet-list', 'ordered-list', 'checked-list', '|', 'bold', 'italic', 'lead', 'small', '|', 'link'],
    'minimal' => ['bold', 'italic', 'link', 'bullet-list', 'ordered-list'],
    'none' => [],
],
```

### Actions

The `media_action`, `edit_media_action`, `link_action`, and `grid_builder_action` options define the actions that can be performed in the editor.

```php
'media_action' => FilamentTiptapEditor\Actions\MediaAction::class,
'edit_media_action' => FilamentTiptapEditor\Actions\EditMediaAction::class,
'link_action' => FilamentTiptapEditor\Actions\LinkAction::class,
'grid_builder_action' => FilamentTiptapEditor\Actions\GridBuilderAction::class,
```

### Output Format

The `output` option determines the output format of the editor, with `FilamentTiptapEditor\Enums\TiptapOutput::Html` being the default value.

```php
'output' => FilamentTiptapEditor\Enums\TiptapOutput::Html,
```

### Media Uploader

The media uploader options define the file types and other settings for uploading files in the editor.

```php
'accepted_file_types' => ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml', 'application/latex'],
'disk' => 'public',
'directory' => 'images',
'veVisibility' => 'public',
'preserve_file_names' => false,
'max_file_size' => 2042,
'min_file_size' => 0,
'image_resize_mode' => null,
'image_crop_aspect_ratio' => null,
'image_resize_target_width' => null,
'image_resize_target_height' => null,
'use_relative_paths' => true,
```

### Menus

The `disable_floating_menus`, `disable_bubble_menus`, and `disable_toolbar_menus` options disable or enable the menus in the editor.

```php
'disable_floating_menus' => false,
'disable_bubble_menus' => false,
'disable_toolbar_menus' => false,

'bubble_menu_tools' => ['bold', 'italic', 'strike', 'underline', 'superscript', 'subscript', 'lead', 'small', 'link'],
'floating_menu_tools' => ['media', 'grid-builder', 'details', 'table', 'oembed', 'code-block', 'blocks'],
```

### Extensions

The `extensions_script` and `extensions_styles` options define the script and styles for extensions, while the `extensions` option defines the available extensions.

```php
'extensions_script' => null,
'extensions_styles' => null,
'extensions' => [],
```

### Preset Colors

The `preset_colors` option defines the preset colors for the color picker in the editor.

```php
'preset_colors' => [],
```

### Protocols

The `link_protocols` option defines the protocols that can be used for links in the editor.

```php
'link_protocols' => [],
```

This documentation provides an overview of the configuration options available for the Filament Tiptap Editor. By understanding these options, developers can customize the editor to meet their specific needs and create a more efficient workflow.