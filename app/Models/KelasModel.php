<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kelas';
    protected $primaryKey       = 'idkelas';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['idkelas','nama_kelas','no_kelas'];

}
