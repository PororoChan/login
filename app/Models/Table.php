<?php

namespace App\Models;

use CodeIgniter\Model;

class Table extends Model
{
    protected $table = 'file_upload';
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function searchable()
    {
        return [
            null,
            'publisher',
            'file_name',
            null,
        ];
    }

    public function getData($param, $text)
    {
        return $this->builder->select('userid, publisher, file_name as file, description');
    }

    public function getOne($id = '')
    {
        $build = $this->builder->select('publisher, file_name as file, description');
        if ($id != '') {
            $build->where('userid', $id);
        }

        return $build->get()->getRowArray();
    }

    public function getFileCount()
    {
        return $this->builder->countAllResults('file_name');
    }

    public function simpan($data)
    {
        return $this->builder->insert($data);
    }

    public function edit($data, $id)
    {
        return $this->builder->update($data, ['userid' => $id]);
    }

    public function hapus($id)
    {
        return $this->builder->delete(['userid' => $id]);
    }
}
