<?php

namespace App\Models;

use CodeIgniter\Model;

class Datasiswa extends Model
{
    protected $table = "biodata";
    protected $primaryKey = "id_data";
    protected $allowedFields = ['nama', 'kelas', 'usia', 'gambar'];
}
