<?php

namespace App\Helpers\Datatables\Drivers;

use App\Helpers\Datatables\Source\Response;
use CodeIgniter\Database\BaseBuilder;

class DriversMethod extends Drivers
{
    protected $callable;

    protected $params = array();

    /* @var BaseBuilder */
    protected $query;

    /* @var BaseBuilder */
    protected $querySearch;

    /* @var array */
    protected $datas = array();

    /* @var Response */
    protected $response;

    protected $number = 1;

    public function __construct($callable, $dbcolumns = null)
    {
        parent::__construct();

        if(!is_array($callable))
            $this->callable = array(new $callable, 'datatables');

        else if(is_array($callable) && !isset($callable[1]))
            $this->callable = array(new $callable[0], 'datatables');

        else if(is_array($callable) && isset($callable[1]))
            $this->callable = array(new $callable[0], $callable[1]);

        $class = new $this->callable[0];

        if(is_array($dbcolumns))
            $this->request->setDatabaseColumns($dbcolumns);

        else if(property_exists($class, $dbcolumns))
            $this->request->setDatabaseColumns($class->{$dbcolumns});

        else if(method_exists($class, $dbcolumns))
            $this->request->setDatabaseColumns(call_user_func(array($class, $dbcolumns)));
    }

    public function setParams($params)
    {
        $this->params = is_array($params) ? $params : func_get_args();

        return $this;
    }

    public function make()
    {
        $this->query = call_user_func_array($this->callable, $this->params)->get();
        $this->querySearch = $this->filter(call_user_func_array($this->callable, $this->params))
            ->get();

        return new Response($this->query, $this->querySearch);
    }
}