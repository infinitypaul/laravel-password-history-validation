# Laravel Password History Validation

[![Latest Version on Packagist](https://img.shields.io/packagist/v/infinitypaul/laravel-password-history-validation.svg?style=flat-square)](https://packagist.org/packages/infinitypaul/laravel-password-history-validation)
[![Build Status](https://img.shields.io/travis/infinitypaul/laravel-password-history-validation/master.svg?style=flat-square)](https://travis-ci.org/infinitypaul/laravel-password-history-validation)
[![Quality Score](https://img.shields.io/scrutinizer/g/infinitypaul/laravel-password-history-validation.svg?style=flat-square)](https://scrutinizer-ci.com/g/infinitypaul/laravel-password-history-validation)
[![Total Downloads](https://img.shields.io/packagist/dt/infinitypaul/laravel-password-history-validation.svg?style=flat-square)](https://packagist.org/packages/infinitypaul/laravel-password-history-validation)

Prevent users from reusing recently used passwords.

## Installation

You can install the package via composer:

```bash
composer require infinitypaul/laravel-password-history-validation
```

## Configuration

To get started, you'll need to publish the config file, and  migrate the database:

```bash
php artisan vendor:publish --tag=password-history
```
Modify the config file according to your project, then migrate the database

```bash
php artisan migrate
```

## Usage
This package will observe the created and updated event of the models (check the config file for settings) and records the password hashes automatically.

In Your Form Request or Inline Validation, All You Need To Do Is Instantiate The `NotFromPasswordHistory` class passing the current user as an argument
``` php
<?php
use Infinitypaul\LaravelPasswordHistoryValidation\Models\PasswordHistoryRepo;

$this->validate($request, [
            'password' => [
                'required',
                new NotFromPasswordHistory($request->user())
            ]
        ]);
```

### Cleaning Up Old Record - (Optional)

Because We Are Storing The Hashed Password In Your Database, Your Database Can Get Long When You Have Lots Of Users 

Add PasswordHistoryTrait To Your User Model
``` php
<?php
use Infinitypaul\LaravelPasswordHistoryValidation\Traits\PasswordHistoryTrait;

class User extends Authenticatable
{
    use Notifiable, PasswordHistoryTrait;

}
```
Then You Can Run The Following Artisan Command

``` bash
php artisan password-history:clear
```
### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email infinitypaul@live.com instead of using the issue tracker.


## How can I thank you?

Why not star the github repo? I'd love the attention! Why not share the link for this repository on Twitter or HackerNews? Spread the word!

Don't forget to [follow me on twitter](https://twitter.com/infinitypaul)!

Thanks!
Edward Paul.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
