<?php

namespace App\Controllers;

use App\Models\UserModel;

class AdminAccount extends BaseController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!$this->isAdmin()) {
            return redirect()->to('/login');
        }

        $users = $this->userModel
            ->select('id, nama, username, role, status')
            ->orderBy('nama')
            ->findAll();

        $requests = db_connect()
            ->table('password_reset_requests')
            ->select('password_reset_requests.id, password_reset_requests.requested_at, user.nama, user.username, user.role')
            ->join('user', 'user.id = password_reset_requests.user_id')
            ->where('password_reset_requests.status', 'pending')
            ->orderBy('password_reset_requests.requested_at', 'ASC')
            ->get()
            ->getResultArray();

        return view('admin/reset_password_account', [
            'title' => 'Reset Password Akun',
            'users' => $users,
            'requests' => $requests,
        ]);
    }

    public function updatePassword()
    {
        if (!$this->isAdmin()) {
            return redirect()->to('/login');
        }

        $userId = filter_var(
            $this->request->getPost('user_id'),
            FILTER_VALIDATE_INT
        );
        $password = (string) $this->request->getPost('password');
        $passwordConfirm = (string) $this->request->getPost('password_confirm');

        if (!$userId || strlen($password) < 8 || $password !== $passwordConfirm) {
            return redirect()->back()->withInput()->with(
                'error',
                'Pilih akun, gunakan password minimal 8 karakter, dan pastikan konfirmasi sama.'
            );
        }

        if ($this->userModel->find($userId) === null) {
            return redirect()->back()->withInput()->with(
                'error',
                'Akun yang dipilih tidak ditemukan.'
            );
        }

        $db = db_connect();
        $db->transStart();
        $this->userModel->update($userId, [
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        $db->table('password_reset_requests')
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->update([
                'status'      => 'completed',
                'resolved_by' => session()->get('user_id'),
                'resolved_at' => date('Y-m-d H:i:s'),
            ]);

        if ($db->query('SHOW TABLES LIKE ?', ['password_reset_tokens'])->getNumRows() > 0) {
            $db->table('password_reset_tokens')
                ->where('user_id', $userId)
                ->delete();
        }

        $db->transComplete();

        if (!$db->transStatus()) {
            return redirect()->back()->withInput()->with(
                'error',
                'Password belum berhasil diperbarui. Silakan coba lagi.'
            );
        }

        return redirect()->to('/admin/akun/reset-password')->with(
            'success',
            'Password akun berhasil diperbarui. Sampaikan password sementara kepada pengguna melalui saluran yang sudah diverifikasi.'
        );
    }

    private function isAdmin(): bool
    {
        return session()->get('isLoggedIn') === true
            && session()->get('role') === 'Admin';
    }
}
