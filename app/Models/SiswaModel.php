<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'siswa';
    protected $primaryKey       = 'id_siswa';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_siswa','nisn_siswa','nama_siswa','wali_siswa','ttl_siswa'];


}
