<?php

namespace JeffersonGoncalves\Quebec\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JeffersonGoncalves\Quebec\Quebec
 */
class Quebec extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-quebec';
    }
}
