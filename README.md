# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/toneflix-code/cuttly-laravel.svg?style=flat-square)](https://packagist.org/packages/toneflix-code/cuttly-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/toneflix-code/cuttly-laravel.svg?style=flat-square)](https://packagist.org/packages/toneflix-code/cuttly-laravel)

[![Laravel8|9](https://img.shields.io/badge/Laravel-8|9-orange.svg)](http://laravel.com)
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/toneflix-code/cuttly-laravel)

Cutt.ly is a Link Management Platform with all features you need in one place. Shorten, brand, manage and track your links the easy way, this library aims to work around thier API implementation by providing a wrapper arround it.

Please refere to [Cutt.ly API Documentation](https://cutt.ly/cuttly-api) for detailed api use description.

## Requirements

- [PHP >= 7.41](http://php.net/)
- [Laravel 8|9](https://github.com/laravel/framework)
- [Guzzle, PHP HTTP client >= 7.0](https://github.com/guzzle/guzzle)

## Installation

You can install the package via composer:

```bash
composer require toneflix-code/cuttly-laravel
```

#### Service Provider & Facade (Optional on Laravel 5.5+)

Register provider and facade on your `config/app.php` file.

```php
'providers' => [
    ...,
    ToneflixCode\Cuttly\CuttlyServiceProvider::class,
]

'aliases' => [
    ...,
    'Cuttly' => ToneflixCode\Cuttly\CuttlyFacade::class,
]
```

#### Configuration (Optional)

```bash
php artisan vendor:publish --provider="ToneflixCode\Cuttly\CuttlyServiceProvider"
```

## API Keys

To start using this library you are required to configure your API keys in your .env file with these variables

```
CUTTLY_KEY=your-cutt.ly API key
```

## Usage

### Shorten Url

```php
use ToneflixCode\Cuttly\Cuttly;

// Default
$response = (new Cuttly)->shorten('https://github.com/toneflix/cuttly-laravel');

// With Name
$response = (new Cuttly)->shorten('https://github.com/toneflix/cuttly-laravel', 'cuttly-laravel');

// No Title | Public
$response = (new Cuttly)->shorten('https://github.com/toneflix/cuttly-laravel', 'cuttly-laravel', true, true);
```

#### Parameters

```php
function shorten(
    ?string $url = null,
    ?string $name = null,
    $noTitle = false,
    $public = false
)
```

#### Response

```json
{
  "status": "7",
  "date": "2022-05-22",
  "shortLink": "https://cutt.ly/aHKP2Bu",
  "title": "cuttly-laravel"
}
```

### Delete a shortened link.

```php
use ToneflixCode\Cuttly\Cuttly;

// Path
$response = (new Cuttly)->delete('rHKG1eb');

// Link
$response = (new Cuttly)->delete('https://cutt.ly/rHKG1eb');
```

### Change the name of a link

```php
use ToneflixCode\Cuttly\Cuttly;

// Path
$response = (new Cuttly)->changeName('rHKG1eb', 'anewname');

// Link
$response = (new Cuttly)->changeName('https://cutt.ly/rHKG1eb', 'anewname');
```

### Add a tag to a link

```php
use ToneflixCode\Cuttly\Cuttly;

// Path
$response = (new Cuttly)->addTag('rHKG1eb', 'atag');

// Link
$response = (new Cuttly)->addTag('https://cutt.ly/rHKG1eb', 'atag');
```

### Change the source url of the shortened link.

```php
use ToneflixCode\Cuttly\Cuttly;

// Path
$response = (new Cuttly)->changeUrl('rHKG1eb', 'https://github.com/toneflix-code/cuttly-laravel');

// Link
$response = (new Cuttly)->changeUrl('https://cutt.ly/rHKG1eb', 'https://github.com/toneflix-code/cuttly-laravel');
```

### Change the title of the shortened link.

```php
use ToneflixCode\Cuttly\Cuttly;

// Path
$response = (new Cuttly)->changeTitle('rHKG1eb', 'A new title');

// Link
$response = (new Cuttly)->changeTitle('https://cutt.ly/rHKG1eb', 'A new title');
```

### Set a unique stat count for a short link

```php
use ToneflixCode\Cuttly\Cuttly;

// Path
$response = (new Cuttly)->changeTitle('rHKG1eb', 15);

// Link
$response = (new Cuttly)->changeTitle('https://cutt.ly/rHKG1eb', 15);
```

#### Response

```json
{
  "status": "1"
}
```

### Error Handling

Every request that returns an error code or response from the Cutt.ly API will throw a `ToneflixCode\Cuttly\Exceptions\CuttlyException` exception this is done to enable the developer to elegantly handle errors in whichever way or manner they deem most appropriate or fit.

```php
use ToneflixCode\Cuttly\Cuttly;
use ToneflixCode\Cuttly\Exceptions\CuttlyException;

try {
    $response = (new Cuttly)->shorten('https://github.com/toneflix/cuttly-laravel');
    dd($response);
} catch (CuttlyException $th) {
    dd($th->getMessage());
}
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email code@toneflix.com.ng instead of using the issue tracker.

## Credits

- [Toneflix Code](https://github.com/toneflix)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
