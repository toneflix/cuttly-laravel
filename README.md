# Cutt.ly Laravel

[![Run Tests L11](https://github.com/toneflix/cuttly-laravel/actions/workflows/run-tests-l11.yml/badge.svg)](https://github.com/toneflix/cuttly-laravel/actions/workflows/run-tests-l11.yml)
[![Latest Stable Version](https://img.shields.io/packagist/v/toneflix-code/cuttly-laravel.svg)](https://packagist.org/packages/toneflix-code/cuttly-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/toneflix-code/cuttly-laravel.svg)](https://packagist.org/packages/toneflix-code/cuttly-laravel)
[![License](https://img.shields.io/packagist/l/toneflix-code/cuttly-laravel.svg)](https://packagist.org/packages/toneflix-code/cuttly-laravel)
[![PHP Version Require](https://img.shields.io/packagist/dependency-v/toneflix-code/cuttly-laravel/php)](https://packagist.org/packages/toneflix-code/cuttly-laravel)
[![codecov](https://codecov.io/gh/toneflix/cuttly-laravel/graph/badge.svg?token=2O7aFulQ9P)](https://codecov.io/gh/toneflix/cuttly-laravel)

Cutt.ly is a Link Management Platform with all features you need in one place. Shorten your links, track clicks, and boost your brand with our all-in-one URL Shortener. Create custom short links, generate QR codes, build link-in-bio pages, and gather feedback with surveys. Start optimizing your URLs today and see the impact!y, [Cuttly PHP](https://github.com/toneflix/cuttly-php) aims to work around the Cutt.ly API by providing a simple PHP wrapper arround it, on the other hand, this package has been curated to make installation and getting started a little easier for Laravel Artisans.

Please refere to [Cutt.ly API Documentation](https://cutt.ly/cuttly-api) for detailed api use description as this package tries to mirror the API in the best possible way.

## Requirements

- [PHP >= 8.1](http://php.net/)
- Laravel [^9.0](https://laravel.com/docs/9.x)|[^10.0](https://laravel.com/docs/10.x)|[^11.0](https://laravel.com/docs/11.x)

## Installation

You can install the package via composer:

```bash
composer require toneflix-code/cuttly-laravel
```

## Upgrading

If you're coming from verson 1.x, you may not be able to upgrade to 2.x as version is a complete rewrite of the package, with almost full support of entire cutt.ly API, version 1.x has been moved to the v1.x.x branch and will continue to recieve security patches and features till the end of 2025.

## Package Discovery

Laravel automatically discovers and publishes service providers but optionally after you have installed Laravel Fileable, open your Laravel config file if you use Laravel below 11, `config/app.php` and add the following lines.

In the $providers array add the service providers for this package.

```php
ToneflixCode\Cuttly\CuttlyServiceProvider::class
```

If you use Laravel >= 11, open your `bootstrap/providers.php` and the above line to the array.

```php
return [
    ToneflixCode\Cuttly\CuttlyServiceProvider::class,
];
```

## Initialization

To start using this library you are required to add your API keys to the .env file with these variables:

```bash
CUTTLY_API_KEY=your-cutt.ly-API-key
CUTTLY_TEAM_API_KEY=your-cutt.ly-API-key #[Optional] For users with team subscriptions.
```

If you wish to interact directly with the base class, you might want to take a look at [https://github.com/toneflix/cuttly-php](https://github.com/toneflix/cuttly-php)

#### Initialization Errors

Where an API key has not not been provided, the library will throw a `ToneflixCode\CuttlyPhp\Exceptions\InvalidApiKeyException` exception on any other associated action call.

## Regular API Usage

### Shorten Url

To shorten a URL simply call the `shorten(string)` method chained to the `regular()` method of the `Cuttly` instance passing the link you intend to shorten as the only parameter.

```php
use ToneflixCode\Cuttly\Facades\Cuttly;

$link = 'https://toneflix.com.ng/learning';
$data = Cuttly::regular()->shorten($link);
```

The `shorten()` method returns an instance of `ToneflixCode\CuttlyPhp\Builders\ShortenResponse` which contains all properties of the request response [returned by the API](https://cutt.ly/api-documentation/regular-api).

### Chainable parameters

We have taken our time to ensure that while using this library, you have access to every available feature provided by cuttly in the first place, here is a list of parameters you can chain as methods to further customize your request.

- `name(string)`: Your desired short link - alias - if not already taken
- `noTitle()`: Faster API response time - This parameter disables getting the page title from the source page meta tag which results in faster API response time
  Available for Team Enterprise plan
- `public()`: Settings public click stats for shortened link via AP
- `userDomain()`: Use the domain from the user account that is approved and has the `status: active`.

#### Example Usage

```php
use ToneflixCode\Cuttly\Facades\Cuttly;

$link = 'https://toneflix.com.ng/learning';
$data = Cuttly::regular()->name('toneflix101')->shorten($link);
```

Do note that `shorten()` should only be called at the end of the chain.

### Edit Short Link

The library also allows you to edit the short links you have created. To edit a link simply call the `edit(string)` method chained to the `regular()` method of the `Cuttly` instance passing the short link you intend to edit as the only parameter.

```php
use ToneflixCode\Cuttly\Facades\Cuttly;

$link = 'https://cutt.ly/toneflix101';
$data = Cuttly::regular()->edit($link);
```

Of course, the example above really does nothing and will throw a `ToneflixCode\CuttlyPhp\Exceptions\FailedRequestException`. To actually edit a link, you can chain any of the below methods to your call and voila.

- `name(string)`: New alias / name, if not already taken.
- `userDomain()`: Use the domain from the user account that is approved and has the `status: active`.
- `tag(string)`: The TAG you want to add for shortened link.
- `source(string)`: Change the source url of shortened link.
- `unique(0|1|15-1440)`: Sets a unique stat count for a short link.
- `title()`: It will change the title of url of shortened link.

#### Example Usage

```php
use ToneflixCode\Cuttly\Facades\Cuttly;

$link = 'https://cutt.ly/toneflix101';
$data = Cuttly::regular()->name('toneflix404')->userDomain()->unique(1)->edit($link);
```

The `edit()` method returns an instance of `ToneflixCode\CuttlyPhp\Builders\BaseResponse` which contains all properties of the request response [returned by the API](https://cutt.ly/api-documentation/regular-api).

### Link analytics

In order to access URL statistics call the `stats(string)` method chained to the `regular()` method of the `Cuttly` instance passing the short link you intend to get analytics of as the only parameter.

```php
use ToneflixCode\Cuttly\Facades\Cuttly;

$link = 'https://cutt.ly/toneflix404';
$data = Cuttly::regular()->stats($link);
```

The `stats()` method returns an instance of `ToneflixCode\CuttlyPhp\Builders\StatsResponse` which contains all properties of the request response [returned by the API](https://cutt.ly/api-documentation/regular-api).

### Delete Short Link

To delete a short link call the `delete(string)` method chained to the `regular()` method of the `Cuttly` instance passing the short link you intend to get delete as the only parameter.

```php
use ToneflixCode\Cuttly\Facades\Cuttly;

$link = 'https://cutt.ly/toneflix404';
$data = Cuttly::regular()->delete($link);
```

The `delete()` method returns an instance of `ToneflixCode\CuttlyPhp\Builders\BaseResponse` which contains all properties of the request response [returned by the API](https://cutt.ly/api-documentation/regular-api).

## Team API Usage

The team API implements the same methods and chainable methods available to the Regular API with a few exceptions that we will point out next.

TO use the Team API, instead of calling the `regular()` method on the `Cuttly` instance, we're going to call the `team()` method, you can now chain all the method we have highlighted above to use the Team API.

### Shorten Link

```php
use ToneflixCode\Cuttly\Facades\Cuttly;

$link = 'https://toneflix.com.ng/learning';
$data = Cuttly::team()->name('toneflix301')->shorten($link);
```

### Edit Short Link

```php
use ToneflixCode\Cuttly\Facades\Cuttly;

$link = 'https://cutt.ly/toneflix301';
$data = Cuttly::team()->edit($link);
```

### Link analytics

```php
use ToneflixCode\Cuttly\Facades\Cuttly;

$link = 'https://cutt.ly/toneflix301';
$data = Cuttly::team()->stats($link);
```

### Delete Short Link

```php
use ToneflixCode\Cuttly\Facades\Cuttly;

$link = 'https://cutt.ly/toneflix404';
$data = Cuttly::team()->delete($link);
```

## Exceptions

### `ToneflixCode\CuttlyPhp\Exceptions\InvalidApiKeyException`

The `ToneflixCode\CuttlyPhp\Exceptions\InvalidApiKeyException` exception is thrown whenever an API key has not been provided or an invalid API key has been provided.

### `ToneflixCode\CuttlyPhp\Exceptions\FailedRequestException`

The `ToneflixCode\CuttlyPhp\Exceptions\FailedRequestException` exception is thrown whenever the Cuttly API returns an error.

### Exception Handling

When you hit an exception, you can handle it in whatever way is best for your use case.

```php
use ToneflixCode\Cuttly\Facades\Cuttly;
use ToneflixCode\CuttlyPhp\Exceptions\FailedRequestException;

try {
  $link = 'https://toneflix.com.ng/learning';
  $data = Cuttly::regular()->name('toneflix404')->shorten($link);
} catch (FailedRequestException $th) {
  echo $th->getMessage();
}
```

```php
use ToneflixCode\Cuttly\Facades\Cuttly;
use ToneflixCode\CuttlyPhp\Exceptions\InvalidApiKeyException;
use ToneflixCode\CuttlyPhp\Exceptions\FailedRequestException;

try {
  $link = 'https://toneflix.com.ng/learning';
  $data = Cuttly::regular()->name('toneflix404')->shorten($link);
} catch (FailedRequestException|InvalidApiKeyException $th) {
  echo $th->getMessage();
}
```

For detailed descriptino about what is obtainable from the API, please read the [Cutt.ly Documentations](https://cutt.ly/api-documentation/regular-api).

## Testing

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
