<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    protected $userModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Menampilkan daftar guru
    public function index()
    {
        $data['title'] = 'Manajemen Guru';
        $data['users'] = $this->userModel->where('role', 'guru')->findAll();

        return view('users/index', $data);
    }

    // Menyimpan data guru baru
    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'      => 'required',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password'  => 'required|min_length[6]',
            'nip_nuptk' => 'permit_empty|is_unique[users.nip_nuptk]',
            'photo'     => 'permit_empty|uploaded[photo]|max_size[photo,5120]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/users')->with('error', 'Gagal menambahkan guru. Periksa kembali input Anda.');
        }

        $data = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'      => 'guru',
            'nip_nuptk' => $this->request->getPost('nip_nuptk') ?: null
        ];

        // Upload Foto
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/photos/', $newName);
            $data['photo'] = $newName;
        } else {
            $data['photo'] = 'default.png'; // Jika tidak ada foto, pakai default.png
        }

        $this->userModel->insert($data);

        return redirect()->to('/users')->with('success', 'Guru berhasil ditambahkan.');
    }

    // Menampilkan data guru untuk modal edit
    public function getGuru($id)
    {
        $user = $this->userModel->find($id);
        return $this->response->setJSON($user);
    }

    // Update data guru
    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'      => 'required',
            'nip_nuptk' => 'permit_empty|is_unique[users.nip_nuptk,id,' . $id . ']',
            'photo'     => 'permit_empty|uploaded[photo]|max_size[photo,5120]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/users')->with('error', 'Gagal mengupdate data.');
        }

        $userData = [
            'name'      => $this->request->getPost('name'),
            'nip_nuptk' => $this->request->getPost('nip_nuptk') ?: null
        ];

        // Update password jika diisi
        if ($this->request->getPost('password')) {
            $userData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // Cek apakah ada upload foto baru
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/photos/', $newName);
            $userData['photo'] = $newName;
        }

        $this->userModel->update($id, $userData);

        return redirect()->to('/users')->with('success', 'Data guru berhasil diperbarui.');
    }


    // Hapus guru
    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/users')->with('success', 'Guru berhasil dihapus.');
    }
}
