<?php

namespace App\Helpers\Datatables;

use App\Helpers\Datatables\Drivers\DriversMethod;

/**
 * @method static DriversMethod method(array|string $action, array|string|null $dbcolumns = null)
 * */
class Datatables
{

    static protected $drivers = [
        'method' => DriversMethod::class,
    ];

    static public function __callStatic($arguments, $parameters)
    {
        $driver = self::$drivers[$arguments];
        return new $driver(...$parameters);
    }
}
