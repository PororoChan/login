<?php

namespace App\Models;

use CodeIgniter\Model;

class userModel extends Model
{
    protected $table = 'login';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama', 'username', 'password'];
}
