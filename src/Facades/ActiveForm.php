<?php

namespace Laravel\ActiveForm\Facades;

use Illuminate\Support\Facades\Facade;

class ActiveForm extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return \Laravel\ActiveForm\ActiveForm::class;
    }
}