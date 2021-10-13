<?php

namespace Ibtdi\HiSms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Mapper Facade
 */
class Mapper extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'mapper';
    }
}
