<?php

namespace App\Controllers;

use App\Models\ModelProduk;
use App\Models\ModelKategori;
use App\Models\ModelSatuan;

class Produk extends BaseController
{
    public function index(): string
    {
        $modelProduk = new ModelProduk();
        $modelKategori = new ModelKategori();
        $modelSatuan = new ModelSatuan();

        // Mengambil semua data produk dengan detail kategori dan satuan
        $produk = $modelProduk->getProdukWithDetails();
        $kategori = $modelKategori->findAll();
        $satuan = $modelSatuan->findAll();

        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'Produk',
            'menu' => 'masterdata',
            'submenu' => 'produk',
            'produk' => $produk,
            'satuan' => $satuan,
            'kategori' => $kategori,
            'page' => 'v_produk'
        ];
        return view('v_template', $data);
    }



    public function save(): \CodeIgniter\HTTP\RedirectResponse
    {
        $modelProduk = new ModelProduk();

        // Validasi input form
        if ($this->validate([
            'kode_produk' => 'required|is_unique[tb_produk.kode_produk]', // Periksa keunikan kode_produk
            'nama_produk' => 'required',
            'id_kategori' => 'required',
            'id_satuan' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer'
        ])) {
            // Insert data ke database
            $modelProduk->insert($this->request->getPost());
            return redirect()->to('/produk')->with('success', 'Data berhasil ditambahkan');
        } else {
            // Mengambil dan menyusun pesan error untuk ditampilkan
            $errors = implode(", ", $this->validator->getErrors());
            return redirect()->to('/produk')->with('error', 'Gagal menambahkan data: ' . $errors);
        }
    }


    public function update($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $modelProduk = new ModelProduk();

        if ($this->validate([
            'nama_produk' => 'required',
            'id_kategori' => 'required',
            'id_satuan' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer'
        ])) {
            $modelProduk->update($id, $this->request->getPost());
            return redirect()->to('/produk')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->to('/produk')->with('error', 'Gagal mengupdate data');
        }
    }

    public function delete($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $modelProduk = new ModelProduk();
        $modelProduk->delete($id);
        return redirect()->to('/produk')->with('success', 'Data berhasil dihapus');
    }
}
