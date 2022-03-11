<?php

namespace App\Models;

use CodeIgniter\Model;
use Codeigniter\HTTP\RequestInterface;

class DtUser extends Model
{
    protected $table = "login";
    protected $column_order = ['id_user', 'username', 'password'];
    protected $column_search = ['nama', 'username'];
    protected $order = ['id_user' => 'ASC'];
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

    public function getData()
    {
        return $this->dt->select('*')
            ->from($this->table)
            ->countAll();
    }

    public function get_dtTable()
    {
        if ($_POST['length'] != 1);
        $query = $this->dt->select('*')
            ->limit($_POST['length'], $_POST['start'])
            ->get();
        return $query->getResult();
    }

    private function getFilter()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']) {
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

    public function getDtFilter()
    {
        $this->getFilter();
        return $this->dt->countAllResults();
    }
}
