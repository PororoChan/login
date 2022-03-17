<?php


namespace App\Helpers\Datatables\Source;

use CodeIgniter\Database\ResultInterface;

class Response
{

    protected $draw;

    /* @var ResultInterface */
    protected $total;

    /* @var ResultInterface */
    protected $filtered;

    protected $jsonData = array();

    protected $request;

    public function __construct($total, $filtered)
    {
        $this->total = $total;
        $this->filtered = $filtered;
        $this->request = new Request();

        $this->_set();
    }

    private function _set()
    {
        $this->jsonData = array();

        $datas = ArrCollect::collect($this->filtered->getResultObject())
            ->skip($this->request->start())
            ->take($this->request->length());

        foreach($datas->all() as $db)
        {
            $data = array();
            foreach($this->request->columns() as $column)
            {
                if($column->isDataNotEmpty() && !$column->isDataNumeric())
                    $data[$column->data()] = $db->{$column->data()};
                else $data[] = null;
            }
            $this->jsonData[] = $data;
        }
    }

    public function updateRow(callable $callable)
    {
        $datas = ArrCollect::collect($this->filtered->getResultObject())
            ->skip($this->request->start())
            ->take($this->request->length());

        $this->jsonData = array();
        foreach($datas->all() as $i => $data)
            $this->jsonData[] = call_user_func_array($callable, array($data, $i + $this->request->start() + 1));

        return $this;
    }

    public function addColumn($name, $callable = null)
    {
        foreach($this->jsonData as $data)
        {
            if(is_callable($name)) {
                $data[] = call_user_func($name, $data);
            }

            else {
                $data[$name] = call_user_func($callable, $data);
            }
        }
    }

    public function number()
    {
        return $this->request->start();
    }

    public function toJson()
    {
        echo json_encode(array_merge([
            'draw' => $this->request->draw(),
            'recordsFiltered' => count($this->filtered->getResultArray()),
            'recordsTotal' => count($this->total->getResultArray()),
            'data' => $this->jsonData
        ]));
    }
}