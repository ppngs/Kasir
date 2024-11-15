<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenjualan extends Model
{
    protected $table = 'tb_jual';
    protected $primaryKey = 'id_jual';
    protected $allowedFields = [
        'no_faktur',
        'tgl_jual',
        'jam',
        'total',
        'bayar',
        'kembalian',
        'id_kasir'
    ];

    public function getLastFaktur()
    {
        return $this->select('no_faktur')
            ->orderBy('id_jual', 'DESC')
            ->first();
    }
}
