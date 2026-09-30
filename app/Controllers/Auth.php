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
    // HALAMAN LOGIN
    // =====================================================

    public function login()
    {
        return view('auth/login');
    }


    // =====================================================
    // HALAMAN LUPA PASSWORD
    // =====================================================

    public function forgotPassword()
    {
        return view('auth/password_reset', [
            'mode' => 'request'
        ]);
    }


    // =====================================================
    // PROSES LUPA PASSWORD
    // =====================================================

    public function sendPasswordReset()
    {
        $username = trim((string) $this->request->getPost('username'));
        $emailAddress = strtolower(
            trim((string) $this->request->getPost('email'))
        );

        // Validasi input
        if (
            $username === '' ||
            filter_var($emailAddress, FILTER_VALIDATE_EMAIL) === false
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Masukkan username dan alamat email yang valid.'
                );
        }

        // Cari username + email
        $user = $this->userModel
            ->where('username', $username)
            ->where('email', $emailAddress)
            ->first();

        // Data tidak cocok
        if ($user === null) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Username atau email tidak sesuai dengan data akun.'
                );
        }

        // =================================================
        // BUAT TOKEN RESET
        // =================================================

        $db = db_connect();

        $token = bin2hex(random_bytes(32));

        $tokenHash = hash('sha256', $token);

        $now = date('Y-m-d H:i:s');

        $expiresAt = date(
            'Y-m-d H:i:s',
            time() + 3600
        );

        // Hapus token lama milik user
        $db->table('password_reset_tokens')
            ->where('user_id', $user['id'])
            ->delete();

        // Simpan token baru
        $db->table('password_reset_tokens')
            ->insert([
                'user_id'   => $user['id'],
                'token_hash' => $tokenHash,
                'expires_at' => $expiresAt,
                'created_at' => $now
            ]);

        // =================================================
        // UNTUK LOCALHOST:
        // LANGSUNG ARAHKAN KE HALAMAN RESET PASSWORD
        // =================================================

        return redirect()->to(
            site_url('password/reset/' . $token)
        );
    }


    // =====================================================
    // HALAMAN RESET PASSWORD
    // =====================================================

    public function showPasswordReset(string $token)
    {
        $reset = $this->findValidPasswordReset($token);

        // Token tidak valid
        if ($reset === null) {
            return view('auth/password_reset', [
                'mode' => 'invalid'
            ]);
        }

        // Jangan kirim token melalui referrer
        $this->response->setHeader(
            'Referrer-Policy',
            'no-referrer'
        );

        return view('auth/password_reset', [
            'mode'  => 'reset',
            'token' => $token
        ]);
    }


    // =====================================================
    // PROSES UPDATE PASSWORD
    // =====================================================

    public function updatePassword()
    {
        $token = (string) $this->request->getPost('token');

        $password = (string) $this->request->getPost('password');

        $passwordConfirm = (string) $this->request->getPost(
            'password_confirm'
        );

        // Validasi password
        if (
            strlen($password) < 8 ||
            $password !== $passwordConfirm
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Password minimal 8 karakter dan kedua password harus sama.'
                );
        }

        // Cari token
        $reset = $this->findValidPasswordReset($token);

        if ($reset === null) {
            return redirect()
                ->to('/password/forgot')
                ->with(
                    'error',
                    'Tautan reset tidak valid atau sudah kedaluwarsa. Silakan minta reset password lagi.'
                );
        }

        // =================================================
        // UPDATE PASSWORD
        // =================================================

        $db = db_connect();

        $db->transStart();

        $db->table('user')
            ->where('id', $reset['user_id'])
            ->update([
                'password' => password_hash(
                    $password,
                    PASSWORD_DEFAULT
                )
            ]);

        // Hapus token setelah digunakan
        $db->table('password_reset_tokens')
            ->where('user_id', $reset['user_id'])
            ->delete();

        $db->transComplete();

        // Cek transaksi
        if (!$db->transStatus()) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Password belum berhasil diperbarui. Silakan coba lagi.'
                );
        }

        // Berhasil
        return redirect()
            ->to('/login')
            ->with(
                'success',
                'Password berhasil diperbarui. Silakan masuk dengan password baru.'
            );
    }


    // =====================================================
    // CEK TOKEN RESET
    // =====================================================

    private function findValidPasswordReset(string $token): ?array
    {
        // Token harus 64 karakter hexadecimal
        if (!preg_match('/\A[a-f0-9]{64}\z/i', $token)) {
            return null;
        }

        return db_connect()
            ->table('password_reset_tokens')
            ->where(
                'token_hash',
                hash('sha256', $token)
            )
            ->where(
                'expires_at >',
                date('Y-m-d H:i:s')
            )
            ->get()
            ->getRowArray();
    }


    // =====================================================
    // PROSES LOGIN
    // =====================================================

    public function masuk()
    {
        $username = $this->request->getPost('username');

        $password = $this->request->getPost('password');

        // Cari username
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

        // =================================================
        // SIMPAN SESSION
        // =================================================

        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'nama'       => $user['nama'],
            'username'   => $user['username'],
            'role'       => $user['role']
        ]);

        // =================================================
        // REDIRECT BERDASARKAN ROLE
        // =================================================

        if ($user['role'] === 'Admin') {
            return redirect()->to('/admin');
        }

        if ($user['role'] === 'Karyawan Dindik') {
            return redirect()->to('/pegawai');
        }

        if ($user['role'] === 'Guru Sekolah') {
            return redirect()->to('/pegawai');
        }

        // Role tidak dikenali
        session()->destroy();

        return redirect()
            ->to('/login')
            ->with(
                'error',
                'Role akun tidak dikenali.'
            );
    }


    // =====================================================
    // HALAMAN REGISTER
    // =====================================================

    public function register()
    {
        return view('auth/register');
    }


    // =====================================================
    // PROSES REGISTER
    // =====================================================

    public function simpanRegister()
    {
        $nama = $this->request->getPost('nama');

        $username = $this->request->getPost('username');

        $emailAddress = strtolower(
            trim((string) $this->request->getPost('email'))
        );

        $password = $this->request->getPost('password');

        $passwordConfirm = $this->request->getPost(
            'password_confirm'
        );

        $role = $this->request->getPost('role');


        // =================================================
        // ROLE YANG BOLEH MENDAFTAR
        // =================================================

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


        // =================================================
        // VALIDASI EMAIL
        // =================================================

        if (
            filter_var(
                $emailAddress,
                FILTER_VALIDATE_EMAIL
            ) === false
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Masukkan alamat email yang valid.'
                );
        }


        // =================================================
        // VALIDASI PASSWORD
        // =================================================

        if ($password !== $passwordConfirm) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Konfirmasi password tidak sama.'
                );
        }


        // =================================================
        // CEK USERNAME
        // =================================================

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


        // =================================================
        // CEK EMAIL
        // =================================================

        $existingEmail = $this->userModel
            ->where('email', $emailAddress)
            ->first();

        if ($existingEmail) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Alamat email sudah digunakan.'
                );
        }


        // =================================================
        // SIMPAN USER
        // =================================================

        $this->userModel->insert([
            'nama'     => $nama,
            'username' => $username,
            'email'    => $emailAddress,
            'password' => password_hash(
                $password,
                PASSWORD_DEFAULT
            ),
            'role'     => $role,
            'status'   => 'Aktif'
        ]);


        // =================================================
        // KEMBALI KE LOGIN
        // =================================================

        return redirect()
            ->to('/login')
            ->with(
                'success',
                'Pendaftaran berhasil sebagai ' .
                $role .
                '. Silakan masuk menggunakan akun kamu.'
            );
    }


    // =====================================================
    // LOGOUT
    // =====================================================

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