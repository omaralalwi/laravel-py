<?php

namespace Omaralalwi\LaravelPy;

use Illuminate\Support\Facades\Facade;

class LaravelPyFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-py';
    }
}
