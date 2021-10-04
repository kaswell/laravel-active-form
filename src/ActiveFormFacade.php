<?php

namespace Laravel\ActiveForm;

use Illuminate\Support\Facades\Facade;

class ActiveFormFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'Form';
    }
}