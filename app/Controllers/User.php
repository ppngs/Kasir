<?php

namespace App\Controllers;

use App\Models\ModelUser;

class User extends BaseController
{
    public function index(): string
    {
        // Memeriksa hak akses berdasarkan role
        $role = session()->get('role');
        if ($role === 'kasir') {
            return redirect()->to('/dashboard'); // Kasir tidak punya akses ke halaman ini
        } elseif ($role === 'owner') {
            // Owner bisa mengakses halaman user
        } elseif ($role === 'admin') {
            // Admin bisa mengakses halaman user
        } else {
            return redirect()->to('/'); // Redirect ke halaman login jika tidak punya akses
        }

        // Memanggil ModelUser
        $modelUser = new ModelUser();

        // Mengambil semua data User
        $user = $modelUser->findAll();

        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'User',
            'menu' => 'masterdata',
            'submenu' => 'user',
            'user' => $user,
            'page' => 'v_user'
        ];
        return view('v_template', $data);
    }


    public function save(): \CodeIgniter\HTTP\RedirectResponse
    {
        $modelUser = new ModelUser();

        // Validasi input form
        if ($this->validate([
            'nama_user' => 'required',
            'email' => 'required|valid_email|is_unique[tb_user.email]',
            'password' => 'required|min_length[6]',
            'role' => 'required'
        ])) {
            // Insert data ke database
            $modelUser->insert([
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'role' => $this->request->getPost('role')
            ]);

            // Redirect dengan pesan sukses
            return redirect()->to('/user')->with('success', 'Data berhasil ditambahkan');
        } else {
            // Redirect dengan pesan error jika validasi gagal
            return redirect()->to('/user')->with('error', 'Gagal menambahkan data');
        }
    }


    public function update($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $modelUser = new ModelUser();

        // Validasi input form
        if ($this->validate([
            'nama_user' => 'required',
            'email' => 'required|valid_email',
            'password' => 'permit_empty|min_length[6]', // Password bisa kosong jika tidak ingin diubah
            'role' => 'required'
        ])) {
            // Ambil data dari form
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'role' => $this->request->getPost('role')
            ];

            // Jika password diisi, tambahkan ke array $data
            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $data['password'] = $password;
            }

            // Update data di database
            $modelUser->update($id, $data);

            // Redirect dengan pesan sukses
            return redirect()->to('/user')->with('success', 'Data berhasil diupdate');
        } else {
            // Redirect dengan pesan error jika validasi gagal
            return redirect()->to('/user')->with('error', 'Gagal mengupdate data');
        }
    }


    public function delete($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $modelUser = new ModelUser();
        $modelUser->delete($id);
        return redirect()->to('/user')->with('success', 'Data berhasil dihapus');
    }
}
