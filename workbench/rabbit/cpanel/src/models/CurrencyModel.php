<?php
namespace Rabbit\Cpanel;

class CurrencyModel extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cp_currency';
    protected $primaryKey = 'id';

}
