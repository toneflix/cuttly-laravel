<?php

namespace ToneflixCode\Cuttly;

use Illuminate\Support\Facades\Facade;

class CuttlyFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cuttly-laravel';
    }
}