<?php

namespace App\Models;

use CodeIgniter\Model;
use Codeigniter\HTTP\RequestInterface;

class Datatable extends Model
{
    protected $table = "biodata";
    protected $column_order = ['id_data', 'nama', 'kelas', 'usia'];
    protected $column_search = ['nama', 'kelas'];
    protected $order = ['id_data' => 'ASC'];
    protected $request;
    protected $db;
    protected $dt;

    public function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }

    private function getFilter()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $_POST['search']['value']);
                } else {
                    $this->dt->orLike($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) {
                    $this->dt->groupEnd();
                }
                $i++;
            }

            if (isset($_POST['order'])) {
                $order = $_POST['order'][0];
                $this->dt->orderBy($this->column_order[$order['column']], $order['dir']);
            }
        }
    }

    public function getData()
    {
        return $this->dt->select('*')
            ->from($this->table)
            ->countAll();
    }

    public function get_dtTable()
    {
        $this->getFilter();
        if ($_POST['length'] != 1) {
            $this->dt->limit($_POST['length'], $_POST['start']);
            return $this->dt->get()->getResult();
        }
    }


    public function getDtFilter()
    {
        $this->getFilter();
        return $this->dt->countAllResults();
    }
}
