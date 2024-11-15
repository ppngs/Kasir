<?php

namespace App\Controllers;

use App\Models\ModelProduk;
use App\Models\ModelPenjualan;
use App\Models\ModelUser;

class Penjualan extends BaseController
{
    public function index()
    {
        // Generate nomor faktur
        $data['no_faktur'] = $this->generateInvoiceNumber();
        $modelProduk = new ModelProduk();
        $data['produk'] = $modelProduk->getProdukWithDetails();
        // dd($data);

        // Kirim data ke view
        return view('v_penjualan', $data);
    }





    private function generateInvoiceNumber()
    {
        $modelPenjualan = new ModelPenjualan();

        // Ambil data terakhir dari tabel penjualan
        $lastInvoice = $modelPenjualan->orderBy('id_jual', 'DESC')->first();

        // Cek apakah ada invoice terakhir
        if ($lastInvoice) {
            // Ambil nomor faktur terakhir
            $lastInvoiceNumber = $lastInvoice['no_faktur'];
            // Ekstrak nomor urut
            $number = (int) substr($lastInvoiceNumber, 2); // Misal no faktur "IN0001"
            $newNumber = $number + 1; // Tambah 1
        } else {
            $newNumber = 1; // Jika belum ada, mulai dari 1
        }

        // Format nomor faktur
        return 'IN' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    public function simpan()
    {
        $modelPenjualan = new ModelPenjualan();
        $lastFaktur = $modelPenjualan->getLastFaktur(); // Ambil nomor faktur terakhir

        // Generate nomor faktur baru
        $newFaktur = $this->generateNewFaktur($lastFaktur ? $lastFaktur['no_faktur'] : null);

        $data = [
            'no_faktur' => $newFaktur,
            'tgl_jual' => date("Y-m-d"),
            'jam' => date("H:i:s"),
            'total' => $this->request->getPost('total'),
            'bayar' => $this->request->getPost('bayar'),
            'kembalian' => $this->request->getPost('kembalian'),
            'id_kasir' => session()->get('id_user') // Misal ambil dari session
        ];

        if ($modelPenjualan->insert($data)) {
            return $this->response->setJSON(['status' => 'success'] + $data);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }

    private function generateNewFaktur($lastFaktur)
    {
        $newNumber = 1; // Default nomor faktur awal
        if ($lastFaktur) {
            // Ekstrak nomor urut dan tambah 1
            $number = (int) substr($lastFaktur, 2);
            $newNumber = $number + 1;
        }
        return 'IN' . str_pad($newNumber, 4, '0', STR_PAD_LEFT); // Format nomor faktur
    }
}
