<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = "kelas";
    protected $primaryKey = "id_kelas";
    protected $allowedFields = ['kelas'];
}
