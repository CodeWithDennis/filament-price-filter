# Filament Price Filter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codewithdennis/filament-price-filter.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-price-filter)
[![Code Styling](https://github.com/CodeWithDennis/filament-price-filter/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/CodeWithDennis/filament-price-filter/actions/workflows/fix-php-code-style-issues.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/codewithdennis/filament-price-filter.svg?style=flat-square)](https://packagist.org/packages/codewithdennis/filament-price-filter)

![thumbnail](https://raw.githubusercontent.com/CodeWithDennis/filament-price-filter/main/thumbnail.png)

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

If you want to customize the translations, you can publish the translations file.

```bash
php artisan vendor:publish --tag="filament-price-filter-translations"
```


## Usage
> [!NOTE]  
> Global settings can be overridden by passing the desired values to the `PriceFilter::make('price')` method.

By default, the currency is set to USD globally, but you can change it per filter to any currency you want.

```php
PriceFilter::make('price')
    ->currency(currency: 'EUR')
```

The filter will use the locale that is used in the application `config('app.locale')`, but you can also set a custom locale.

```php
PriceFilter::make('price')
    ->currency(locale: 'NL'),
```

A good practice is to save your currency as cents but if you saved it as a whole number you can disable the cents.

```php
PriceFilter::make('price')
    ->currency(cents: false),
```

If you want to grab the min, max values from the database you can use the `min` and `max` methods. Here is an example of how you can use it with caching.

> [!NOTE]  
> Flexible cache is a caching helper method that is introduced in Laravel 11.23.0, you can also use the default cache function.

```php
->min(fn () => Cache::flexible('min_price', [30, 60], function () {
    return Order::min('price') / 100; // Divide by 100 if you saved it as cents
}))
````

```php
->max(fn () => Cache::flexible('max_price', [30, 60], function () {
    return Order::max('price') / 100; // Divide by 100 if you saved it as cents
}))
```

By default, the label will be the name of the filter, for example `PriceFilter::make('total_price')` will have a label of `Total price to` and `Total price from`. You can change the label to whatever you want.

```php
PriceFilter::make('price')
    ->label('Shipping price')
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
