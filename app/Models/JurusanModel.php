<?php

namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jurusan';
    protected $primaryKey       = 'kdjurusan';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['kdjurusan','nama_jurusan','kelas','password'];
}
    