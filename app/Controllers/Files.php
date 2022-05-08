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
                $db->file,
                $db->publisher,
                " 
                <button id='btn-prev' onclick=\"preview($db->userid, '$db->file')\" title='Signature' class='btn btn-warning btn-sm'><i class='fas fa-signature'></i></button>
                <button id='btn-del' onclick='deleteDt($db->userid)' title='Delete' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></button>
                "
            ];
        });

        $datatables->toJson();
    }

    public function save()
    {
        if ($this->request->getPost('type') == 1) {
            $file = $this->request->getFile('file_name');
            $filename = $file->getClientName();
            $name = str_replace(' ', '_', $filename);
            $file->move('../public/file_upload', $name);
            $data = [
                'publisher' => session()->get('nama'),
                'file_name' => $name,
                'description' => $this->request->getPost('desc'),
            ];

            $this->model->simpan($data);
            $result['success'] = 1;
        } else {
            $result['success'] = 0;
        }
    }

    public function updateFile()
    {
        $id = $this->request->getPost('ids');
        // Problem Here
        $files = $this->request->getPost('file_data');
        $decoded = base64_decode($files);
        $upfile = $this->request->getPost('file_name');

        $list = $this->model->getOne($id);
        $oldf = $list['file'];

        if (file_exists('file_upload/' . $oldf)) {
            unlink('file_upload/' . $oldf);
            file_put_contents('file_upload/' . $upfile, base64_decode($decoded));
        }

        $dt = [
            'file_name' => $upfile,
        ];

        $this->model->edit($dt, $id);

        echo json_encode($dt);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $dt = $this->model->getOne($id);

        if ($id) {
            if (file_exists('file_upload/' . $dt['file'])) {
                unlink('file_upload/' . $dt['file']);
            }

            $this->model->hapus($id);
            echo '1';
        } else {
            echo '0';
        }
    }
}
