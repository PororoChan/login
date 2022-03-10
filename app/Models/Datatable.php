<?php

namespace App\Models;

use CodeIgniter\Model;
use Codeigniter\HTTP\RequestInterface;

class Datatable extends Model
{
    protected $table = "biodata";
    protected $column_order = ['id_data', 'nama', 'kelas', 'usia'];
    protected $column_search = ['nama'];
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

    public function get_dtTable()
    {
        if ($_POST['length'] != 1);
        $db = db_connect();
        $builder = $db->table($this->table);
        $query = $builder->select('*')
            ->limit($_POST['length'], $_POST['start'])
            ->get();
        return $query->getResult();
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
        }
    }

    public function getDtFilter()
    {
        $this->getFilter();
        return $this->dt->countAllResults();
    }
}
