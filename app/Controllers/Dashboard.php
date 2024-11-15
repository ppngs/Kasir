<?php

namespace App\Controllers;

use App\Models\ModelProduk;
use App\Models\ModelKategori;
use App\Models\ModelSatuan;
use App\Models\ModelUser;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $session = session();

        // Cek apakah pengguna sudah login
        if (!$session->get('logged_in')) {
            return redirect()->to('/login'); // Redirect ke halaman login jika tidak login
        }

        // Mengambil jumlah data dari database
        $modelProduk = new ModelProduk();
        $modelKategori = new ModelKategori();
        $modelSatuan = new ModelSatuan();
        $modelUser = new ModelUser();

        $data = [
            'judul' => 'Dashboard',
            'subjudul' => '',
            'menu' => 'dashboard',
            'submenu' => '',
            'page' => 'v_dashboard',
            'produkCount' => $modelProduk->countAll(),
            'kategoriCount' => $modelKategori->countAll(),
            'satuanCount' => $modelSatuan->countAll(),
            'userCount' => $modelUser->countAll(),
        ];

        return view('v_template', $data);
    }
}
