<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Jika pengguna belum login, redirect ke halaman login
        if (!$session->get('logged_in')) {
            return redirect()->to('/'); // Ganti dengan route login Anda
        }

        // Cek role pengguna
        $role = $session->get('role');
        $uri = service('uri')->getSegment(1); // Ambil segment pertama dari URL

        // Tentukan hak akses berdasarkan role
        $access = [
            'admin' => ['dashboard', 'penjualan', 'masterdata', 'laporan', 'setting', 'logout'],
            'owner' => ['dashboard', 'masterdata', 'laporan', 'logout'],
            'kasir' => ['dashboard', 'penjualan', 'logout'],
        ];

        // Jika role tidak ada dalam akses
        if (!array_key_exists($role, $access) || !in_array($uri, $access[$role])) {
            return redirect()->to('/'); // Redirect jika tidak memiliki akses
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
