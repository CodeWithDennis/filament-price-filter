# Filament Price Filter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithdennis/filament-price-filter.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-price-filter)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/codewithdennis/filament-price-filter/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/codewithdennis/filament-price-filter/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/codewithdennis/filament-price-filter.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-price-filter)

A simple and customizable price filter for FilamentPHP, allowing users to easily refine results based on specified price ranges.

## Installation

You can install the package via composer:

```bash
composer require codewithdennis/filament-price-filter
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-price-filter-config"
```

This is the contents of the published config file:

```php
<?php

return [
    'currency' => 'USD',
    'cents' => true,
];
```

## Usage

By default, the currency is set to USD, but you can change it to any currency you want.

```php
PriceFilter::make()
    ->currency('EUR')
```

The filter will use the locale that is used in the application `config('app.locale')`, but you can also set a custom locale.

```php
PriceFilter::make()
    ->currency(currency: 'EUR', locale: 'NL'),
```

A good practice is to save your currency as cents but if you saved it as a whole number you can disable the cents.

```php
PriceFilter::make()
    ->currency(currency: 'EUR', locale: 'NL', cents: false),
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [CodeWithDennis](https://github.com/CodeWithDennis)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
