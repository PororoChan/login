<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\userModel;

class Login extends BaseController
{
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
        $session = session();
        $data = [
            'title' => 'RekSpot | Dashboard',
            'nama'  => $session->get('nama'),
        ];
        return view('/dashboard/dashboard', $data);
    }

    public function adv()
    {
        $model = new SiswaModel();
        $session = session();
        $data = [
            'title' => 'RekSpot | Siswa Advanced',
            'siswa' => $model->findAll(),
            'nama'  => $session->get('nama'),
        ];

        return view('/dashboard/dtasiswa', $data);
    }

    public function siswa()
    {
        $model = new SiswaModel();
        $session = session();
        $data = [
            'title' => 'RekSpot | Data Siswa',
            'siswa' => $model->findAll(),
            'nama'  => $session->get('nama'),
        ];

        return view('/dashboard/dtsiswa', $data);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
