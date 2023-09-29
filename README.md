# Filament tools to view all emails sent by your Laravel Application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/magarrent/filament-email-sent-log-viewer.svg?style=flat-square)](https://packagist.org/packages/magarrent/filament-email-sent-log-viewer)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/magarrent/filament-email-sent-log-viewer/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/magarrent/filament-email-sent-log-viewer/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/magarrent/filament-email-sent-log-viewer/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/magarrent/filament-email-sent-log-viewer/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/magarrent/filament-email-sent-log-viewer.svg?style=flat-square)](https://packagist.org/packages/magarrent/filament-email-sent-log-viewer)



This is a Package for Filament V3 to view all emails sent by your Laravel Application.


## Installation

You can install the package via composer:

```bash
composer require magarrent/filament-email-sent-log-viewer
```

Run the package installer
    
```bash
php artisan filament-email-sent-log-viewer:install
```

You **must** publish and run the migrations with (The installer does this for you): ⬆️⬆️⬆️

```bash
php artisan migrate
```

---


## Usage

Register the plugin class in your `AdminPanelProvider`:
Just add

```php
return $panel
    ->plugin(new FilamentEmailSentLogViewerPlugin())
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Marc - @magarrent](https://github.com/magarrent)
- Thanks to [Shvets Group](https://github.com/shvetsgroup) for some ideas and code :)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
