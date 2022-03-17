<?php


namespace App\Helpers\Datatables\Source;


class SearchValue
{
    /**
     * @param array $data
     * @return SearchValue
     * */
    static public function fromArray(array $data)
    {
        $instance = new SearchValue();
        $instance->value = isset($data['value']) ? $data['value'] : '';
        $instance->regex = isset($data['regex']) ? $data['regex'] : false;

        return $instance;
    }

    protected $value;

    protected $regex;

    public function value()
    {
        return trim(strtolower($this->value));
    }

    public function isNotEmpty()
    {
        return $this->value != '';
    }
}
