<?php

namespace Ibtdi\HiSms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * HISms Facade
 */
class HISms extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'hisms.sender';
    }
}
