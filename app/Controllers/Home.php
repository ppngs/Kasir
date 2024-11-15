<?php

namespace App\Controllers;

use App\Models\ModelUser;
use CodeIgniter\Controller;

class Home extends Controller
{
    public function index(): string
    {
        $data = [
            'page' => 'login'
        ];
        return view('v_login', $data); // Menampilkan halaman login

        // Memeriksa apakah pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/'); // Redirect ke halaman login jika tidak login
        }

        // Jika sudah login, redirect ke dashboard
        return redirect()->to('/dashboard');
    }

    public function login()
    {
        $session = session();
        $model = new ModelUser();

        // Ambil data dari form
        $username = $this->request->getVar('nama_user');
        $password = $this->request->getVar('password');

        // Cari pengguna berdasarkan username
        $user = $model->getUserByUsername($username);

        if ($user) {
            // Verifikasi password
            if ($password === $user['password']) {
                // Jika password benar, simpan data user ke session
                $sessionData = [
                    'id_user' => $user['id_user'],
                    'nama_user' => $user['nama_user'],
                    'role' => $user['role'],
                    'logged_in' => true
                ];
                $session->set($sessionData);

                return redirect()->to('/dashboard'); // Ganti ke halaman setelah login berhasil
            } else {
                $session->setFlashdata('error', 'Password salah.');
                return redirect()->back();
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan.');
            return redirect()->back();
        }
    }

    public function logout()
    {
        // Menghapus session user
        session()->destroy();
        return redirect()->to('/');
    }
}
