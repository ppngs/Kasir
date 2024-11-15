<?php

namespace App\Controllers;
use App\Models\ModelKategori;

class Kategori extends BaseController
{
    public function index(): string
    {
         // Memanggil ModelSatuan
         $modelKategori = new ModelKategori();

         // Mengambil semua data satuan
         $kategori = $modelKategori->findAll();

        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'Kategori',
            'menu' => 'masterdata',
            'submenu' => 'kategori',
            'kategori' => $kategori,  // Data Kategori yang diambil dari database
            'page'=> 'v_kategori'
        ];
        return view('v_template', $data);
    }

    public function save(): \CodeIgniter\HTTP\RedirectResponse
    {
        $modelKategori = new ModelKategori();
        
        // Validasi input form
        if ($this->validate([
            'nama_kategori' => 'required' // Validasi wajib diisi
        ])) {
            // Insert data ke database
            $modelKategori->insert([
                'nama_kategori' => $this->request->getPost('nama_kategori'),
            ]);
            // Redirect dengan pesan sukses
            return redirect()->to('/kategori')->with('success', 'Data berhasil ditambahkan');
        } else {
            // Redirect dengan pesan error jika validasi gagal
            return redirect()->to('/kategori')->with('error', 'Gagal menambahkan data');
        }
    }

    public function update($id): \CodeIgniter\HTTP\RedirectResponse
{
    $modelKategori = new ModelKategori();

    // Validasi input form
    if ($this->validate([
        'nama_kategori' => 'required' // Validasi wajib diisi
    ])) {
        // Update data di database
        $modelKategori->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ]);
        // Redirect dengan pesan sukses
        return redirect()->to('/kategori')->with('success', 'Data berhasil diupdate');
    } else {
        // Redirect dengan pesan error jika validasi gagal
        return redirect()->to('/kategori')->with('error', 'Gagal mengupdate data');
    }
}

public function delete($id): \CodeIgniter\HTTP\RedirectResponse
{
    $modelKategori = new ModelKategori();
    $modelKategori->delete($id);
    return redirect()->to('/kategori')->with('success', 'Data berhasil dihapus');
}


    
}

