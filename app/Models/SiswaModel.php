<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = "dtsiswa";
    protected $primaryKey = "id_siswa";
    protected $allowedFields = ['nama', 'kelas', 'usia'];
}
