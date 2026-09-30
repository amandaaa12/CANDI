<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }


    // =====================================================
    // LOGIN
    // =====================================================

    public function login()
    {
        return view('auth/login');
    }


    // =====================================================
    // PROSES LOGIN
    // =====================================================

    public function masuk()
    {
        $username = trim(
            (string) $this->request->getPost('username')
        );

        $password = (string) $this->request->getPost('password');


        // Cari username
        $user = $this->userModel
            ->where('username', $username)
            ->first();


        if (!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Akun belum terdaftar. Silakan daftar terlebih dahulu.'
                );
        }


        // Cek password
        if (!password_verify(
            $password,
            $user['password']
        )) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Username atau password salah.'
                );
        }


        // Cek status akun
        if ($user['status'] !== 'Aktif') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Akun kamu sedang tidak aktif.'
                );
        }


        // Session login
        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'nama'       => $user['nama'],
            'username'   => $user['username'],
            'role'       => $user['role']
        ]);


        // Redirect sesuai role
        if ($user['role'] === 'Admin') {
            return redirect()->to('/admin');
        }


        if ($user['role'] === 'Karyawan Dindik') {
            return redirect()->to('/pegawai');
        }


        if ($user['role'] === 'Guru Sekolah') {
            return redirect()->to('/pegawai');
        }


        // Jika role tidak dikenali
        session()->destroy();

        return redirect()
            ->to('/login')
            ->with(
                'error',
                'Role akun tidak dikenali.'
            );
    }


    // =====================================================
    // LUPA PASSWORD
    // =====================================================

    public function forgotPassword()
    {
        return view('auth/password_reset', [
            'mode' => 'request'
        ]);
    }


    // =====================================================
    // CEK USERNAME UNTUK RESET PASSWORD
    // =====================================================

    public function sendPasswordReset()
    {
        $username = trim(
            (string) $this->request->getPost('username')
        );


        // Username kosong
        if ($username === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Silakan masukkan username.'
                );
        }


        // Cari user berdasarkan username
        $user = $this->userModel
            ->where('username', $username)
            ->first();


        // Username tidak ditemukan
        if (!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Username tidak ditemukan.'
                );
        }


        // Cek status
        if ($user['status'] !== 'Aktif') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Akun kamu sedang tidak aktif.'
                );
        }


        // Simpan ID user sementara
        session()->set([
            'reset_user_id' => $user['id']
        ]);


        // Masuk ke halaman password baru
        return redirect()->to(
            base_url('password/reset')
        );
    }


    // =====================================================
    // HALAMAN PASSWORD BARU
    // =====================================================

    public function showPasswordReset()
    {
        $userId = session()->get('reset_user_id');


        // Belum memasukkan username
        if (!$userId) {
            return redirect()
                ->to(base_url('password/forgot'))
                ->with(
                    'error',
                    'Silakan masukkan username terlebih dahulu.'
                );
        }


        // Cari user
        $user = $this->userModel->find($userId);


        // User tidak ditemukan
        if (!$user) {

            session()->remove('reset_user_id');

            return redirect()
                ->to(base_url('password/forgot'))
                ->with(
                    'error',
                    'Data akun tidak ditemukan.'
                );
        }


        return view('auth/password_reset', [
            'mode'     => 'reset',
            'username' => $user['username']
        ]);
    }


    // =====================================================
    // SIMPAN PASSWORD BARU
    // =====================================================

    public function updatePassword()
    {
        $userId = session()->get('reset_user_id');


        // Tidak ada sesi reset
        if (!$userId) {
            return redirect()
                ->to(base_url('password/forgot'))
                ->with(
                    'error',
                    'Sesi reset password sudah berakhir. Silakan ulangi.'
                );
        }


        $password = (string) $this->request->getPost(
            'password'
        );

        $passwordConfirm = (string) $this->request->getPost(
            'password_confirm'
        );


        // Password kosong
        if ($password === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Password baru wajib diisi.'
                );
        }


        // Minimal 8 karakter
        if (strlen($password) < 8) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Password minimal 8 karakter.'
                );
        }


        // Konfirmasi password
        if ($password !== $passwordConfirm) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Konfirmasi password tidak sama.'
                );
        }


        // Update password
        $berhasil = $this->userModel->update(
            $userId,
            [
                'password' => password_hash(
                    $password,
                    PASSWORD_DEFAULT
                )
            ]
        );


        if (!$berhasil) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Password gagal diperbarui.'
                );
        }


        // Hapus sesi reset
        session()->remove('reset_user_id');


        // Kembali ke login
        return redirect()
            ->to(base_url('login'))
            ->with(
                'success',
                'Password berhasil diubah. Silakan login dengan password baru.'
            );
    }


    // =====================================================
    // REGISTER
    // =====================================================

    public function register()
    {
        return view('auth/register');
    }


    // =====================================================
    // SIMPAN REGISTER
    // =====================================================

    public function simpanRegister()
    {
        $nama = trim(
            (string) $this->request->getPost('nama')
        );

        $username = trim(
            (string) $this->request->getPost('username')
        );

        $password = (string) $this->request->getPost(
            'password'
        );

        $passwordConfirm = (string) $this->request->getPost(
            'password_confirm'
        );

        $role = $this->request->getPost('role');


        // Role yang diperbolehkan
        $allowedRoles = [
            'Karyawan Dindik',
            'Guru Sekolah'
        ];


        if (!in_array(
            $role,
            $allowedRoles,
            true
        )) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Role yang dipilih tidak valid.'
                );
        }


        // Password harus sama
        if ($password !== $passwordConfirm) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Konfirmasi password tidak sama.'
                );
        }


        // Minimal password
        if (strlen($password) < 8) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Password minimal 8 karakter.'
                );
        }


        // Cek username
        $cekUsername = $this->userModel
            ->where('username', $username)
            ->first();


        if ($cekUsername) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Username sudah digunakan.'
                );
        }


        // Simpan user
        $this->userModel->insert([
            'nama'     => $nama,
            'username' => $username,
            'password' => password_hash(
                $password,
                PASSWORD_DEFAULT
            ),
            'role'     => $role,
            'status'   => 'Aktif'
        ]);


        return redirect()
            ->to(base_url('login'))
            ->with(
                'success',
                'Pendaftaran berhasil. Silakan login menggunakan akun kamu.'
            );
    }


    // =====================================================
    // LOGOUT
    // =====================================================

    public function logout()
    {
        session()->destroy();

        return redirect()
            ->to(base_url('login'))
            ->with(
                'success',
                'Kamu berhasil keluar dari sistem.'
            );
    }
}