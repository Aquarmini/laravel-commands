<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PwdSetServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\PwdSetService::class;
    }
}