# This package is to integrate with URWay payment

## Installation

You can install the package via [Composer](https://getcomposer.org).

```bash
composer require alaaelsaid/laravel-urway-payment
```
## Publishing

After install publish file config

```bash
php artisan vendor:publish --tag="urway"
```

## Usage

```php
use Alaaelsaid\LaravelUrwayPayment\Facade\Urway;

$payment_url = Urway::getPaymentUrl([
    'trackid' => 1,
    'email' => 'email@example.com',
    'amount' => 500,
    'redirect_url' => route('payment.success'), // put your redirect url here, feel free to use url() method,
    'udf3' => '', // optional if you want to get extra data in redirection,
    'udf4' => '', // optional if you want to get extra data in redirection,
    'udf5' => '', // optional if you want to get extra data in redirection,
]);

return redirect($payment_url); // this is for example !!
