<?php


namespace App\Helpers\Datatables\Source;


use CodeIgniter\Database\BaseBuilder;

class Column
{

    static public function fromArray(array $array)
    {
        $instance = new Column();
        $instance->data = isset($array['data']) ? $array['data'] : '';
        $instance->name = isset($array['name']) ? $array['name'] : '';
        $instance->searchable = isset($array['searchable']) ? $array['searchable'] : '';
        $instance->orderable = isset($array['orderable']) ? $array['orderable'] : '';
        $instance->search = isset($array['search']) ? $array['search'] : array();
        $instance->format = isset($array['format']) ? $array['format'] : array();
        $instance->field = isset($array['field']) ? $array['field'] : array();
        $instance->raw = isset($array['raw']) ? $array['raw'] : array();
        $instance->query = isset($array['query']) ? $array['query'] : array();

        return $instance;
    }

    protected $data;

    protected $name;

    protected $value;

    protected $searchable;

    protected $orderable;

    protected $search;

    protected $format;

    protected $field;

    protected $raw;

    protected $query;

    public function data()
    {
        return $this->data;
    }

    public function isDataEmpty()
    {
        return $this->data == '';
    }

    public function isDataNotEmpty()
    {
        return $this->data != '';
    }

    public function isDataNumeric()
    {
        return is_int(intval($this->data));
    }

    public function name()
    {
        return $this->name;
    }

    public function isNameEmpty()
    {
        return $this->name == '';
    }

    public function isNameNotEmpty()
    {
        return $this->name != '';
    }

    public function isSearchable()
    {
        return $this->searchable;
    }

    public function isOrderable()
    {
        return $this->orderable;
    }

    public function search()
    {
        return SearchValue::fromArray($this->search);
    }

    public function field($field)
    {
        return is_callable($this->field) ? call_user_func($this->field, $field) : $field;
    }

    public function format($data)
    {
        return is_callable($this->format) ? call_user_func($this->format, $data) : $data;
    }

    public function isCallableFormat()
    {
        return is_callable($this->format);
    }

    public function raw($field, $data = null)
    {
        return is_callable($this->raw) ? call_user_func_array($this->raw, array($field, $data)) : $field;
    }

    public function isCallableRaw()
    {
        return is_callable($this->raw);
    }

    public function query($query, $field, $data)
    {
        return is_callable($this->query) ? call_user_func_array($this->query, array($query, $field, $data)) : $query;
    }

    public function isCallableQuery()
    {
        return is_callable($this->query);
    }
}