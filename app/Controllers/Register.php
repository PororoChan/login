<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\userModel;

class Register extends BaseController
{
    public function register()
    {
        $data = [];
        return view('login/registerPage', $data);
    }

    public function save()
    {
        $session = session();
        $rules = [
            'nama' => 'required|min_length[3]|max_length[25]',
            'username' => 'required|min_length[3]|max_length[25]',
            'password' => 'required|min_length[6]|max_length[200]',
        ];

        if ($this->validate($rules)) {
            $model = new userModel();
            $data = [
                'nama'  => $this->request->getPost('nama'),
                'username'  => $this->request->getPost('username'),
                'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            $model->save($data);

            echo '1';
        } else {
            $session->setFlashdata('msg', 'Data yang dimasukkan salah');
            echo '0';
        }
    }
}
