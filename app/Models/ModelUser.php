<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table = 'tb_user'; // Sesuaikan nama tabel Anda
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama_user', 'email', 'password', 'role'];

    public function getUserByUsername($username)
    {
        return $this->where('nama_user', $username)->first();
    }
}
