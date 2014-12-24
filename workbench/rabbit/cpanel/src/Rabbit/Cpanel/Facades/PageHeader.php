<?php
namespace Rabbit\Cpanel\Facades;

use Illuminate\Support\Facades\Facade;

class PageHeader extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'page-header';
    }

}