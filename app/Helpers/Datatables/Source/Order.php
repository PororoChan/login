<?php


namespace App\Helpers\Datatables\Source;


class Order
{

    static protected $instance;

    static public function fromArray(array $array)
    {
        if(is_null(self::$instance))
            self::$instance = new Order();

        self::$instance->column = isset($array['column']) ? $array['column'] : 0;
        self::$instance->dir = isset($array['dir']) ? $array['dir'] : 'asc';

        return self::$instance;
    }

    protected $column;

    protected $dir;

    public function column()
    {
        return $this->column;
    }

    public function dir()
    {
        return $this->dir;
    }
}