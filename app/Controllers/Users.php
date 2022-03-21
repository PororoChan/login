<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DtUser;
use App\Models\userModel;
use Config\Services;

class Users extends BaseController
{
    public function show()
    {
        $session = session();
        $user = new userModel();

        $data = [
            'title' => 'RekSpot | Data Users',
            'user'  => $user->findAll(),
            'nama'  => $session->get('nama'),
        ];

        return view('/dashboard/userPage', $data);
    }

    public function data()
    {
        $request = Services::request();
        $model = new DtUser($request);
        $list = $model->get_dtTable();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $l->nama;
            $row[] = $l->username;
            $row[] = $l->password;
            $row[] = "
                <button id='dt-edit' data-id='$l->id_user' class='btn btn-warning'><i class='fas fa-edit'></i></button>
                <button id='dt-delete' data-id='$l->id_user' class='btn btn-danger'><i class='fas fa-trash'></i></button>
            ";
            $data[] = $row;
        }

        $output = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => $model->getData(),
            'recordsFiltered' => $model->getDtFilter(),
            'data' => $data,
        );

        echo json_encode($output);
    }

    public function edit()
    {
        if ($this->request->getVar('id_user')) {
            $model = new userModel();
            $dt = $model->where('id_user', $this->request->getVar('id_user'))->first();

            $data = array(
                'nama'  => $dt['nama'],
                'username' => $dt['username'],
                'password' => $dt['password'],
            );

            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }

    public function update()
    {
        $model = new userModel();
        $id = $this->request->getVar('id_user');

        $data = [
            'nama'  => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];

        $model->update($id, $data);

        echo json_encode($data);
    }

    public function delete()
    {
        $id = $this->request->getVar('id_user');

        $model = new userModel();
        if ($id) {
            $model->delete($id);
        }

        echo json_encode($id);
    }
}
