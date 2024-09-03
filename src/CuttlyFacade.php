<?php

namespace ToneflixCode\Cuttly;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \ToneflixCode\CuttlyPhp\Cuttly init()
 * @method static \ToneflixCode\CuttlyPhp\Apis\CuttlyTeam team()
 * @method static \ToneflixCode\CuttlyPhp\Apis\CuttlyRegular regular()
 */
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
