<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Files\File;

class Setting extends BaseController
{
    private $settingsFile = WRITEPATH . 'settings.json'; // File untuk menyimpan pengaturan

    public function index(): string
    {
        $data = [
            'judul' => 'Setting',
            'subjudul' => '',
            'menu' => 'setting',
            'submenu' => '',
            'page' => 'v_setting',
            'setting' => $this->getSettings() // Mengambil pengaturan dari file
        ];
        return view('v_template', $data);
    }

    public function update()
    {
        $fotoToko = $this->request->getFile('foto_toko');
        $currentSettings = $this->getSettings(); // Ambil pengaturan saat ini

        // Tentukan nama foto yang akan disimpan
        $fotoTokoName = $currentSettings['foto_toko']; // Gunakan foto yang sudah ada secara default

        // Validasi dan simpan foto baru jika ada
        if ($fotoToko && $fotoToko->isValid()) {
            // Pindahkan file ke folder public/uploads
            $fotoTokoName = $fotoToko->getName(); // Simpan nama foto baru
            $fotoToko->move('uploads', $fotoTokoName);
        }

        // Ambil data lain dari form
        $data = [
            'nama_toko' => $this->request->getPost('nama_toko'),
            'nama_pemilik' => $this->request->getPost('nama_pemilik'),
            'alamat' => $this->request->getPost('alamat'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'motto' => $this->request->getPost('motto'),
            'foto_toko' => $fotoTokoName, // Gunakan nama foto yang sesuai
        ];

        // Simpan data ke file JSON
        $this->saveSettings($data);

        session()->setFlashdata('success', 'Pengaturan berhasil disimpan.');
        return redirect()->to('/setting');
    }

    private function getSettings()
    {
        if (file_exists($this->settingsFile)) {
            return json_decode(file_get_contents($this->settingsFile), true);
        }

        // Default settings jika file tidak ada
        return [
            'foto_toko' => null,
            'nama_toko' => 'Toko Intechcom',
            'nama_pemilik' => 'Agus',
            'alamat' => 'Jalan Raya No. 123, Jakarta',
            'nomor_telepon' => '08123456789',
            'motto' => 'Pelayanan Terbaik untuk Anda',
        ];
    }

    private function saveSettings($data)
    {
        file_put_contents($this->settingsFile, json_encode($data));
    }
}
