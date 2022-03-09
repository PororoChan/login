<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Datasiswa;
use App\Models\KelasModel;

class Dtsiswa extends BaseController
{
    public function show()
    {
        $siswamdl = new Datasiswa();
        $kelasmdl = new KelasModel();
        $kelas = $this->request->getVar('id_kelas');
        $session = session();

        $data = [
            'title' => 'RekSpot | Data Siswa Advanced',
            'dtsiswa' => $siswamdl->findAll(),
            'dtkelas'   => $kelasmdl->find($kelas),
            'nama'  => $session->get('nama'),
        ];

        return view('/dashboard/dtasiswa', $data);
    }

    public function view()
    {
        $model = new Datasiswa();
        $dt = $model->where('id_data', $this->request->getVar('id_data'))->first();

        $data = array(
            'nama'  => $dt['nama'],
            'kelas' => $dt['kelas'],
            'usia'  => $dt['usia'],
            'gambar'    => $dt['gambar'],
        );

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function add()
    {
        $rules = [
            'nama'  => 'required',
            'kelas' =>  'required',
            'usia'  =>  'required',
            'gambar'    => [
                'rules' => 'uploaded[gambar]|max_size[gambar,1024]',
                'label' => 'Gambar',
            ],
        ];


        if ($this->request->getVar('type') == 1) {
            if ($this->validate($rules)) {
                $model = new Datasiswa();

                $image = $this->request->getFile('gambar');
                $name = $image->getRandomName();
                $image->move('../public/images', $name);
                $data = [
                    'nama'  =>  $this->request->getVar('nama'),
                    'kelas' =>  $this->request->getVar('kelas'),
                    'usia'  =>  $this->request->getVar('usia'),
                    'gambar' => $name,
                ];

                $model->insert($data);
            }
        }
    }

    public function edit()
    {
        if ($this->request->getVar('id_data')) {
            $model = new Datasiswa();
            $dt = $model->where('id_data', $this->request->getVar('id_data'))->first();

            $data = array(
                'nama'  => $dt['nama'],
                'kelas' => $dt['kelas'],
                'usia'  => $dt['usia'],
                'gambar' => $dt['gambar'],
            );

            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }

    public function update()
    {
        $model = new Datasiswa();
        $dt = $model->where('id_data', $this->request->getVar('id_data'))->first();
        $did = $this->request->getVar('id_data');
        $image = $dt['gambar'];

        if ($did) {
            if (file_exists('images/' . $image)) {
                unlink('images/' . $image);
            }
            $imgNew = $this->request->getFile('gambar');

            $data = [
                'nama'  => $this->request->getPost('nama'),
                'kelas' => $this->request->getPost('kelas'),
                'usia'  => $this->request->getPost('usia'),
                'gambar'    => $imgNew,
            ];

            $model->update($did, $data);

            $nama = $imgNew->getRandomName();
            $imgNew->move('../public/images', $nama);
        }
    }

    public function delete()
    {
        $model = new Datasiswa();
        $id = $this->request->getVar('id_data');
        $data = $model->find($id);
        $image = $data['gambar'];

        if ($id) {
            $model->delete($this->request->getVar('id_data'));
            if (file_exists('images/' . $image)) {
                unlink('images/' . $image);
            }
        }
    }
}
