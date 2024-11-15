<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProduk extends Model
{
    protected $table = 'tb_produk';
    protected $primaryKey = 'id_produk';
    protected $allowedFields = [
        'kode_produk',
        'nama_produk',
        'id_kategori',
        'id_satuan',
        'harga_beli',
        'harga_jual',
        'stok'
    ];

    public function getProdukWithDetails()
    {
        return $this->select('tb_produk.*, tb_kategori.nama_kategori, tb_satuan.nama_satuan')
            ->join('tb_kategori', 'tb_kategori.id_kategori = tb_produk.id_kategori')
            ->join('tb_satuan', 'tb_satuan.id_satuan = tb_produk.id_satuan')
            ->findAll();
    }
}
