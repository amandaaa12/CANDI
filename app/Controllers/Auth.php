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


    // ==============================
    // HALAMAN LOGIN
    // ==============================

    public function login()
    {
        return view('auth/login');
    }


    // ==============================
    // PROSES LOGIN
    // ==============================

    public function masuk()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cari username di database
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
                    'Akun belum terdaftar. Silakan daftar terlebih dahulu.'
                );
        }


        // Cek password
        if (!password_verify($password, $user['password'])) {

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


        // ==============================
        // SIMPAN DATA LOGIN KE SESSION
        // ==============================

        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'nama'       => $user['nama'],
            'username'   => $user['username'],
            'role'       => $user['role']
        ]);


        // ==============================
        // REDIRECT SESUAI ROLE
        // ==============================

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


    // ==============================
    // HALAMAN REGISTER
    // ==============================

    public function register()
    {
        return view('auth/register');
    }


    // ==============================
    // PROSES REGISTER
    // ==============================

    public function simpanRegister()
    {
        $nama = $this->request->getPost('nama');

        $username = $this->request->getPost('username');

        $password = $this->request->getPost('password');

        $passwordConfirm =
            $this->request->getPost('password_confirm');

        $role = $this->request->getPost('role');


        // ==============================
        // ROLE YANG BOLEH MENDAFTAR
        // ==============================

        $allowedRoles = [
            'Karyawan Dindik',
            'Guru Sekolah'
        ];


        // Cek role
        if (!in_array($role, $allowedRoles, true)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Role yang dipilih tidak valid.'
                );
        }


        // ==============================
        // CEK PASSWORD
        // ==============================

        if ($password !== $passwordConfirm) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Konfirmasi password tidak sama.'
                );
        }


        // ==============================
        // CEK USERNAME
        // ==============================

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


        // ==============================
        // SIMPAN PENGGUNA
        // ==============================

        $this->userModel->insert([

            'nama' => $nama,

            'username' => $username,

            'password' => password_hash(
                $password,
                PASSWORD_DEFAULT
            ),

            'role' => $role,

            'status' => 'Aktif'

        ]);


        // ==============================
        // KEMBALI KE LOGIN
        // ==============================

        return redirect()
            ->to('/login')
            ->with(
                'success',
                'Pendaftaran berhasil sebagai ' .
                $role .
                '. Silakan masuk menggunakan akun kamu.'
            );
    }


    // ==============================
    // LOGOUT
    // ==============================

    public function logout()
    {
        session()->destroy();

        return redirect()
            ->to('/login')
            ->with(
                'success',
                'Kamu berhasil keluar dari sistem.'
            );
    }
}