<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;

class Siswa extends BaseController
{
    public function addSiswa()
    {
        $rules = [
            'nama'  => 'required',
            'kelas' =>  'required',
            'usia'  =>  'required',
        ];

        if ($this->request->getPost('type') == 1) {
            if ($this->validate($rules)) {
                $model = new SiswaModel();
                $data = [
                    'nama'  =>  $this->request->getPost('nama'),
                    'kelas' =>  $this->request->getPost('kelas'),
                    'usia'  =>  $this->request->getPost('usia'),
                ];

                $model->save($data);
            }
        }
    }

    public function edit()
    {
        $model = new SiswaModel();
        $id = $this->request->getGet('id_siswa');
        $data['row'] = $model->find($id);
    }
}
