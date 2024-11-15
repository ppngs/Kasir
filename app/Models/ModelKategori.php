<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKategori extends Model
{
    protected $table = 'tb_kategori';  // Nama tabel di database
    protected $primaryKey = 'id_kategori'; // Primary key tabel
    protected $allowedFields = ['nama_kategori'];  // Kolom yang bisa diinput atau diubah
}
