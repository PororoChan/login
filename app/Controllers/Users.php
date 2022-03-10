<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\userModel;

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
}
