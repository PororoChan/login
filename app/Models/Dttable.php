<?php

namespace App\Models;

use CodeIgniter\Model;

class Dttable extends Model
{
    protected $table = 'biodata';
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }
    public function search()
    {
        return [
            null,
            'a.nama',
            null,
            null,
            null,
        ];
    }
    public function getAll($param, $text)
    {
        return $this->builder->select('a.id_data, a.nama, a.kelas, a.usia, a.gambar');
    }
}
