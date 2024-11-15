<?php

namespace App\Controllers;

use App\Models\ModelSatuan;

class Satuan extends BaseController
{
    public function index(): string
    {
        // Memanggil ModelSatuan
        $modelSatuan = new ModelSatuan();

        // Mengambil semua data satuan
        $satuan = $modelSatuan->findAll();

        // Menyiapkan data yang akan dikirim ke view
        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'Satuan',
            'menu' => 'masterdata',
            'submenu' => 'satuan',
            'satuan' => $satuan,  // Data satuan yang diambil dari database
            'page' => 'v_satuan'
        ];
        // Menampilkan view dan mengirimkan data
        return view('v_template', $data);
    }

    public function save(): \CodeIgniter\HTTP\RedirectResponse
    {
        $modelSatuan = new ModelSatuan();

        // Validasi input form
        if ($this->validate([
            'nama_satuan' => 'required' // Validasi wajib diisi
        ])) {
            // Insert data ke database
            $modelSatuan->insert([
                'nama_satuan' => $this->request->getPost('nama_satuan'),
            ]);
            // Redirect dengan pesan sukses
            return redirect()->to('/satuan')->with('success', 'Data berhasil ditambahkan');
        } else {
            // Redirect dengan pesan error jika validasi gagal
            return redirect()->to('/satuan')->with('error', 'Gagal menambahkan data');
        }
    }

    public function update($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $modelSatuan = new ModelSatuan();

        // Validasi input form
        if ($this->validate([
            'nama_satuan' => 'required' // Validasi wajib diisi
        ])) {
            // Update data di database
            $modelSatuan->update($id, [
                'nama_satuan' => $this->request->getPost('nama_satuan'),
            ]);
            // Redirect dengan pesan sukses
            return redirect()->to('/satuan')->with('success', 'Data berhasil diupdate');
        } else {
            // Redirect dengan pesan error jika validasi gagal
            return redirect()->to('/satuan')->with('error', 'Gagal mengupdate data');
        }
    }

    public function delete($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $modelSatuan = new ModelSatuan();
        $modelSatuan->delete($id);
        return redirect()->to('/satuan')->with('success', 'Data berhasil dihapus');
    }
}
