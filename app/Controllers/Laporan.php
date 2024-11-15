<?php

namespace App\Controllers;

class Laporan extends BaseController
{
    public function LaporanHarian(): string
    {
        $data = [
            'judul' => 'Laporan',
            'subjudul' => 'Laporan Harian',
            'menu' => 'laporan',
            'submenu' => 'laporan harian',
            'page' => 'v_laporanharian'
        ];
        return view('v_template', $data);
    }

    public function LaporanBulanan(): string
    {
        $data = [
            'judul' => 'Laporan',
            'subjudul' => 'Laporan Bulanan',
            'menu' => 'laporan',
            'submenu' => 'laporan bulanan',
            'page' => 'v_laporanbulanan'
        ];
        return view('v_template', $data);
    }

    public function LaporanTahunan(): string
    {
        $data = [
            'judul' => 'Laporan',
            'subjudul' => 'Laporan Tahunan',
            'menu' => 'laporan',
            'submenu' => 'laporan tahunan',
            'page' => 'v_laporantahunan'
        ];
        return view('v_template', $data);
    }
}
