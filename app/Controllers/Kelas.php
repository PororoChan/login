<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;

class Kelas extends BaseController
{
    public function index()
    {
        $session = session();
        $kelas = new KelasModel();
        $data = [
            'title' => 'RekSpot | Data Kelas',
            'kelas' => $kelas->findAll(),
            'nama'  => $session->get('nama'),
        ];
        return view('/dashboard/kelas', $data);
    }

    public function add()
    {
        $rules = [
            'kelas' =>  'required',
        ];

        if ($this->request->getPost('type') == 1) {
            if ($this->validate($rules)) {
                $model = new KelasModel();
                $data = [
                    'kelas' =>  $this->request->getPost('kelas'),
                ];

                $model->save($data);
            }
        }
    }

    public function edit()
    {
        if ($this->request->getVar('id_kelas')) {
            $model = new KelasModel();
            $dt = $model->where('id_kelas', $this->request->getVar('id_kelas'))->first();

            $data = array(
                'kelas' => $dt['kelas'],
            );

            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }

    public function update()
    {
        $kelas = new KelasModel();
        $id = $this->request->getVar('id_kelas');

        $data = [
            'kelas' => $this->request->getVar('editfield'),
        ];

        $kelas->update($id, $data);
    }

    public function delete()
    {
        $kelas = new KelasModel();
        if ($this->request->getVar('id_kelas')) {
            $kelas->delete($this->request->getVar('id_kelas'));
        }
    }
}
