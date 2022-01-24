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

## Env
In the .env file you can add those keys:

```dotenv
URWAY_TERMINAL_ID=
URWAY_PASSWORD=
URWAY_MERCHANT_SECRET_KEY=
URWAY_CURRENCY=SAR
# in the development mode set it 'dev' in
# else in production mode set it 'live'
URWAY_STATUS=dev
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
