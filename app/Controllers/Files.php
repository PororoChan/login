<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\Datatables\Datatables;
use App\Models\Table;

class Files extends BaseController
{
    public function __construct()
    {
        $this->model = new Table();
    }

    public function index()
    {
        $data = [
            'title' => 'RekSpot | Files',
            'nama' => session()->get('nama'),
        ];
        return view('/dashboard/filesView', $data);
    }

    public function table()
    {
        $datatables = Datatables::method([Table::class, 'getData'], 'searchable')
            ->setParams(1, 'kedua')
            ->make();

        $datatables->updateRow(function ($db, $no) {
            return [
                $no,
                $db->file_name,
                $db->publisher,
                " 
                <button class='btn btn-success'><i class='fas fa-eye'></i></button>
                <button class='btn btn-warning'><i class='fas fa-pencil-alt'></i></button>
                <button class='btn btn-danger'><i class='fas fa-trash-alt'></i></button>
                "
            ];
        });

        $datatables->toJson();
    }

    public function save()
    {
        if ($this->request->getPost('type') == 1) {
            $file = $this->request->getFile('file_name');
            $name = $file->getRandomName();
            $file->move('../public/file_upload', $name);
            $data = [
                'publisher' => $this->request->getPost('publisher'),
                'file_name' => $name,
                'description' => $this->request->getPost('desc'),
            ];

            $this->model->simpan($data);
            $result['success'] = 1;

            echo json_encode($result);
        }
    }
}
