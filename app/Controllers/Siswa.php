<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;
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
        if ($this->request->getVar('id_siswa')) {
            $model = new SiswaModel();
            $dt = $model->where('id_siswa', $this->request->getVar('id_siswa'))->first();

            $data = array(
                'nama' => $dt['nama'],
                'kelas' => $dt['kelas'],
                'usia'  => $dt['usia'],
            );

            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }

    public function update()
    {
        $model = new SiswaModel();
        $id = $this->request->getVar('id_siswa');

        $data = [
            'nama'  => $this->request->getVar('nama'),
            'kelas' => $this->request->getVar('kelas'),
            'usia'  => $this->request->getVar('usia'),
        ];

        $model->update($id, $data);
    }

    public function delete()
    {
        $model = new SiswaModel();
        if ($this->request->getVar('id_siswa')) {
            $model->delete($this->request->getVar('id_siswa'));
        }
    }
}
