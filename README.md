
# This is my package filament-email-log

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ramnzys/filament-email-log.svg?style=flat-square)](https://packagist.org/packages/ramnzys/filament-email-log)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ramnzys/filament-email-log/run-tests?label=tests)](https://github.com/ramnzys/filament-email-log/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ramnzys/filament-email-log/Check%20&%20fix%20styling?label=code%20style)](https://github.com/ramnzys/filament-email-log/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ramnzys/filament-email-log.svg?style=flat-square)](https://packagist.org/packages/ramnzys/filament-email-log)

This package provides a Filament resource to view all Laravel outgoing emails. It also provides a Model for the database stored emails.

## Installation

You can install the package via composer:

```bash
composer require ramnzys/filament-email-log
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-email-log-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-email-log-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-email-log-views"
```

## Usage

This package will automatically register the `EmailResource`. You will be able to see it when you visit your Filament admin panel.

### Customizing the group

You can customize the navigation group for the `EmailResource` by publishing the configuration file and updating the `resource.group` and `resource.sort` values.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Contributions are welcome. Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Credits

- [Ramón E. Zayas](https://github.com/ramnzys)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
