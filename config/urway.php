<?php

return [
    'terminal_id'         => env('URWAY_TERMINAL_ID'),
    'urway_password'      => env('URWAY_PASSWORD'),
    'merchant_secret_key' => env('URWAY_MERCHANT_SECRET_KEY'),
    'currency'            => env('URWAY_CURRENCY','SAR'),
    'status'              => env('URWAY_STATUS','dev'),
];
