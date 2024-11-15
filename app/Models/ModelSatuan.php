<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSatuan extends Model
{
    protected $table = 'tb_satuan';  // Nama tabel di database
    protected $primaryKey = 'id_satuan'; // Primary key tabel
    protected $allowedFields = ['nama_satuan'];  // Kolom yang bisa diinput atau diubah
}
