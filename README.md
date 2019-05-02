# Axstarzy Laravel Library

Default Laravel library for Axstarzy Dot Com that includes the most used libraries, plugins, helper classes, and migrations

## Getting Started

**Note that this package is in constant development and update. Please do voice out if you have any suggestions for improvement on this package.**

This package is meant for Laravel Framework 5.5 LTS and above.

##### The following packages will be auto installed:
- guzzlehttp/guzzle^6.3
- intervention/image^2.4
- laravelcollective/html^5.4.0
- funkjedi/composer-include-files^1.0,


##### Helper classes included:
- Action Log
- Error Log

##### Helper functions included:
- sqlLog
- custom trans
- getStatusLabel

### Prerequisites

- PHP 7.0 and above
- Laravel 5.5 and above

### Installing

1. Install the package in your project
```
composer require tommyys/laravel_template
```

2. Add your providers to the `providers` array of `config/app.php`:
```php
'providers' => [
    // ...
    Collective\Html\HtmlServiceProvider::class,
    Intervention\Image\ImageServiceProvider::class,
    // ...
],
```

3. Add class aliases to the `aliases` array of `config/app.php`:
```php
'aliases' => [
    // ...
      'Form' => Collective\Html\FormFacade::class,
      'Html' => Collective\Html\HtmlFacade::class,
      'Image' => Intervention\Image\Facades\Image::class,
    // ...
  ],
```

4. To use the included helper class, add this line into your project's `composer.json`.

```json
"extra": {
        ...
        "include_files": [
            "vendor/tommyys/laravel_template/src/Helper.php"
        ]
    },
```

5. Run `composer dumpautoload` 

6. Run `php artisan migrate` to migrate the required tables

### Using the library

To use the included classes, include the namespace on top of your controller/command.

```php
...
use Axstarzy\LaravelTemplate\ActionLog;
use Axstarzy\LaravelTemplate\ErrorLog;
...
```

Below are the classes that are available:
- ActionLog
- ErrorLog

Then you may use it normally like a helper class in your controller/commands.

```php
class TestController extends Controller
{
  public function foo(){
    sqlLog(ActionLog::where('user_id', 1));
  }
}
```

#### Helper

This package includes an updated `trans` function, you must have added `vendor/tommyys/laravel_template/src/Helper.php` to `composer.json` to have it working.

Example:
```php
<span class="m-menu__link-text">
  {{trans('string.Stock')}}
</span>
```

Output:
```php
<span class="m-menu__link-text">
  Stock
</span>
```
