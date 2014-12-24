<?php
namespace Rabbit\Cpanel\Facades;

use Illuminate\Support\Facades\Facade;

class CpanelAuth extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'cpanel-auth';
    }

}