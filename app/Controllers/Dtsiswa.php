<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Datasiswa;
use App\Models\Datatable;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\KelasModel;
use Config\Services;

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

    public function detail()
    {
        if ($this->request->getVar('id_data')) {
            $model = new Datasiswa();
            $dt = $model->where('id_data', $this->request->getVar('id_data'))->first();

            $data = array(
                'id_data' => $dt['id_data'],
                'nama'  => $dt['nama'],
                'kelas' => $dt['kelas'],
                'usia'  => $dt['usia'],
                'gambar'    => $dt['gambar'],
            );

            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }

    public function view()
    {
        $request = Services::request();
        $model = new Datatable($request);
        $list = $model->get_dtTable();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $l->nama;
            $row[] = $l->kelas;
            $row[] = $l->usia;
            $row[] = "
                <button id='dt-view' data-id='$l->id_data' class='btn btn-success'><i class='fas fa-eye'></i></button>
                <button id='dt-edit' data-id='$l->id_data' class='btn btn-warning'><i class='fas fa-edit'></i></button>
                <button id='dt-delete' data-id='$l->id_data' class='btn btn-danger'><i class='fas fa-trash'></i></button>
            ";
            $data[] = $row;
        }

        $output = array(
            'draw' => intval($_POST['draw']),
            'recordsTotal' => $model->getData(),
            'recordsFiltered' => $model->getDtFilter(),
            'data' => $data,
        );

        echo json_encode($output);
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
            $nama = $imgNew->getRandomName();

            $data = [
                'nama'  => $this->request->getPost('nama'),
                'kelas' => $this->request->getPost('kelas'),
                'usia'  => $this->request->getPost('usia'),
                'gambar'    => $nama,
            ];

            $model->update($did, $data);

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

    public function expExcel()
    {
        if ($this->request->getVar('id_data')) {
            $model = new Datasiswa();
            $data = $model->findAll();

            $excel = new Spreadsheet();

            //header-kolom-excel
            $excel->setActiveSheetIndex(0)
                ->setCellValue('D4', 'Nama')
                ->setCellValue('E4', 'Kelas')
                ->setCellValue('F4', 'Usia');

            $kolom = 2;

            foreach ($data as $dt) {
                $excel->setActiveSheetIndex(0)
                    ->setCellValue('D' . $kolom, $dt['nama'])
                    ->setCellValue('E' . $kolom, $dt['kelas'])
                    ->setCellValue('F' . $kolom, $dt['usia']);
                $kolom++;
            }

            $writer = new Xlsx($excel);
            $filename = 'Data Siswa';

            //Redirect Download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
            header('Cache-Control: max-age=0');

            // $writer->save('php://output');
        }
    }
}
