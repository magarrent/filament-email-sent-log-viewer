# Filament tools to view all emails sent by your Laravel Application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/magarrent/filament-email-sent-log-viewer.svg?style=flat-square)](https://packagist.org/packages/magarrent/filament-email-sent-log-viewer)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/magarrent/filament-email-sent-log-viewer/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/magarrent/filament-email-sent-log-viewer/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/magarrent/filament-email-sent-log-viewer/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/magarrent/filament-email-sent-log-viewer/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/magarrent/filament-email-sent-log-viewer.svg?style=flat-square)](https://packagist.org/packages/magarrent/filament-email-sent-log-viewer)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require magarrent/filament-email-sent-log-viewer
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-email-sent-log-viewer-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-email-sent-log-viewer-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-email-sent-log-viewer-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filamentEmailSentLogViewer = new Magarrent\FilamentEmailSentLogViewer();
echo $filamentEmailSentLogViewer->echoPhrase('Hello, Magarrent!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Marc - @magarrent](https://github.com/magarrent)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
