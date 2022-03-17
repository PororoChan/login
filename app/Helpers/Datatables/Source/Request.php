<?php


namespace App\Helpers\Datatables\Source;


use Config\Services;

class Request
{

    protected $request;

    /* @var Column[] */
    protected $dbcolumns = array();

    public function __construct()
    {
        $this->request = Services::request();
    }

    public function draw()
    {
        return $this->request->getVar('draw');
    }

    public function start()
    {
        return $this->request->getVar('start');
    }

    public function length()
    {
        return $this->request->getVar('length');
    }

    /**
     * @return SearchValue
     * */
    public function search()
    {
        return SearchValue::fromArray($this->request->getVar('search'));
    }

    /**
     * @return Column[]
     * */
    public function columns()
    {
        $columns = array();
        foreach($this->request->getVar('columns') as $column)
        {
            $columns[] = Column::fromArray($column);
        }

        return $columns;
    }

    /**
     * @retur Order[]
     * */
    public function orders()
    {
        $orders = array();
        foreach($this->request->getVar('order') as $order)
        {
            $orders[] = Order::fromArray($order);
        }

        return $orders;
    }

    public function setDatabaseColumns(array $columns)
    {
        $dbcolumns = array();
        foreach($columns as $key => $column)
        {
            if(!is_null($column))
            {
                if(is_callable($column))
                    $dbcolumns[] = Column::fromArray(['name' => $key, 'raw' => $column]);

                else if(is_array($column))
                    $dbcolumns[] = Column::fromArray([
                        'name' => $key,
                        'field' => isset($column['field']) ? $column['field'] : null,
                        'raw' => isset($column['raw']) ? $column['raw'] : null,
                        'format' => isset($column['format']) ? $column['format'] : null,
                        'query' => isset($column['query']) ? $column['query'] : null,
                    ]);

                else
                    $dbcolumns[] = Column::fromArray(['name' => $column]);
            }

            else $dbcolumns[] = new Column();
        }

        $this->dbcolumns = $dbcolumns;
    }

    /**
     * @return Columns
     * */
    public function getDatabaseColumns()
    {
        return Columns::fromArray($this->dbcolumns);
    }
}