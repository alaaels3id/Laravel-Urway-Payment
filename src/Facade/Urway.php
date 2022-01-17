<?php

namespace Alaaelsaid\LaravelUrwayPayment\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static getPaymentUrl(array $data)
 *
 * @see UrwayProcess
 */
class Urway extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Urway';
    }
}
