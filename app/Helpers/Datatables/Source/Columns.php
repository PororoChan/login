<?php


namespace App\Helpers\Datatables\Source;


class Columns
{

    /**
     * @param Column[] $columns
     * @return Columns
     * */
    static public function fromArray($columns)
    {
        return new Columns($columns);
    }

    protected $columns;

    public function __construct($columns)
    {
        $this->columns = $columns;
    }

    /**
     * @param int $index
     * @return Column
     * */
    public function get($index)
    {
        return isset($this->columns[$index]) ? $this->columns[$index] : null;
    }

    /**
     * @return Column[]
     * */
    public function all()
    {
        return $this->columns;
    }

    public function count()
    {
        return count($this->columns);
    }
}