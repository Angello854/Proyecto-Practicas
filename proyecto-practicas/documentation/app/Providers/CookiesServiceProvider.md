# Documentation: CookiesServiceProvider.php

Original file: `app/Providers\CookiesServiceProvider.php`

# CookiesServiceProvider Documentation

## Table of Contents
[#Introduction](#introduction)
[#register Method](#register-method)
[#boot Method](#boot-method)
[#registerCookies Method](#registercookies-method)

## Introduction
The `CookiesServiceProvider` is a part of the Whitecube Laravel Cookie Consent package. Its primary role is to register and manage cookies used in the application. This service provider provides a central location for handling cookie-related tasks, such as registering analytics cookies or custom cookies.

## #Introduction

## #register Method

### Purpose
The `register` method is responsible for setting up the necessary dependencies and configurations for the `CookiesServiceProvider`.

### Parameters and Return Values
- None: The method does not accept any parameters and returns void.

### Functionality
This method calls the parent's `register` method to inherit any necessary setup. In this case, it does not perform any specific actions, but instead relies on the parent class for initialization.

```php
public function register(): void
{
    parent::register();
}
```

## #boot Method

### Purpose
The `boot` method is responsible for performing any necessary setup or configuration after the application has booted. In this case, it registers two render hooks with FilamentView to display cookie-related information.

### Parameters and Return Values
- None: The method does not accept any parameters and returns void.

### Functionality
This method checks if the `FilamentView` class exists and, if so, registers two render hooks:
1.  A hook for the body's end section, which renders a view called `whitecube-cookie-wrapper`.
2.  A hook for panels' body end section (specifically for the admin panel), which also renders the same view.

```php
public function boot(): void
{
    parent::boot();

    if (class_exists(FilamentView::class)) {
        FilamentView::registerRenderHook(
            'body.end',
            fn (): string => view('components.whitecube-cookie-wrapper')->render()
        );

        FilamentView::registerRenderHook(
            'panels::body.end',
            fn (): string => view('components.whitecube-cookie-wrapper')->render()
        );
    }
}
```

## #registerCookies Method

### Purpose
The `registerCookies` method is responsible for defining the cookies used in the application. It sets up different categories of cookies, such as essential, analytics, and custom cookies.

### Parameters and Return Values
- None: The method does not accept any parameters and returns void.

### Functionality
This method defines three types of cookies:
1.  Essentials: Registers Laravel's base cookies (session, csrf) under the "required" category.
2.  Analytics: Registers all analytics cookies at once using a shorthand method, including Google Analytics.
3.  Custom: Registers custom cookies under the pre-existing "optional" category.

```php
protected function registerCookies(): void
{
    Cookies::essentials()
        ->session()
        ->csrf();

    Cookies::analytics()
        ->google(
            id: config('cookieconsent.google_analytics.id'),
            anonymizeIp: config('cookieconsent.google_analytics.anonymize_ip')
        );

    Cookies::optional()
        ->name('darkmode_enabled')
        ->description('This cookie helps us remember your preferences regarding the interface\'s brightness.')
        ->duration(120)
        ->accepted(fn(Consent $consent, $darkmode = null) => $consent->cookie(value: $darkmode ? $darkmode->getDefaultValue() : false));
}
```

This documentation provides a comprehensive overview of the `CookiesServiceProvider` and its various methods. It covers the purpose, parameters, and functionality of each method to help developers understand how this service provider works and why it exists in the system.