<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\Table;
use App\Models\userModel;

class Login extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->model = new Table();
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('/login/loginPage', $data);
    }

    public function auth()
    {
        $session = session();
        $model = new userModel();

        $uname = $this->request->getPost('uname');
        $password = $this->request->getPost('password');
        $data = $model->where('username', $uname)->first();
        if ($data) {
            $pass = $data['password'];
            $verify = password_verify($password, $pass);
            if ($verify) {
                $data = [
                    'id_user'   => $data['id_user'],
                    'nama'      => $data['nama'],
                    'username'  => $data['username'],
                    'logged_in' => TRUE
                ];
                $session->set($data);
                return redirect()->to('/home');
            } else {
                $session->setFlashdata('msg', 'Password Salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'User tidak ditemukan');
            return redirect()->to('/login');
        }
    }

    public function dashboard()
    {
        $count = $this->model->getFileCount();
        $session = session();
        $data = [
            'title' => 'RekSpot | Dashboard',
            'nama'  => $session->get('nama'),
            'count' => $count,
        ];
        return view('/dashboard/dashboard', $data);
    }

    public function siswa()
    {
        if ($this->session->get('logged_in') == true) {
            $model = new SiswaModel();
            $session = session();
            $data = [
                'title' => 'RekSpot | Data Siswa',
                'siswa' => $model->findAll(),
                'nama'  => $session->get('nama'),
            ];

            return view('/dashboard/dtsiswa', $data);
        } else {
            return view('/login');
        }
    }

    public function logout()
    {
        $this->session->destroy();

        return redirect()->to('/login');
    }
}
