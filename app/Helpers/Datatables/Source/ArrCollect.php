<?php


namespace App\Helpers\Datatables\Source;


class ArrCollect
{

    static public function collect(array $array)
    {
        return new ArrCollect($array);
    }

    protected $datas;

    public function __construct($array)
    {
        $this->datas = $array;
    }

    public function take($length)
    {
        $datas = array();
        for($i = 0; $i < $length; $i++) {
            if(!isset($this->datas[$i]))
                break;

            $datas[$i] = $this->datas[$i];
        }

        return ArrCollect::collect($datas);
    }

    public function skip($length)
    {
        $datas = array();
        for($i = $length; $i < count($this->datas) + $length; $i++) {
            if(!isset($this->datas[$i]))
                break;

            $datas[] = $this->datas[$i];
        }

        return ArrCollect::collect($datas);
    }

    public function all()
    {
        return $this->datas;
    }
}