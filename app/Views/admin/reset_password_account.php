<?php
/** @var list<array{id: int|string, nama: string, username: string, role: string, status: string}> $users */
/** @var list<array{id: int|string, nama: string, username: string, role: string, requested_at: string}> $requests */
?>
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-4">
    <h2 class="h4 fw-bold mb-1">Reset Password Akun</h2>
    <p class="text-secondary mb-0">Verifikasi identitas pengguna sebelum menetapkan password sementara.</p>
</div>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger" role="alert"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success" role="status"><?= esc(session()->getFlashdata('success')) ?></div>
<?php endif; ?>

<section class="mb-4">
    <h3 class="h5 fw-bold">Permintaan menunggu</h3>
    <?php if (empty($requests)) : ?>
        <p class="text-secondary">Tidak ada permintaan reset yang menunggu.</p>
    <?php else : ?>
        <div class="table-responsive bg-white border rounded-2">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Diminta</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request) : ?>
                        <tr>
                            <td><?= esc($request['nama']) ?></td>
                            <td><?= esc($request['username']) ?></td>
                            <td><?= esc($request['role']) ?></td>
                            <td><?= esc($request['requested_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>

<div class="bg-white border rounded-2 p-4" style="max-width: 720px;">
    <form action="<?= site_url('admin/akun/reset-password') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="user_id" class="form-label fw-semibold">Akun pengguna</label>
            <select id="user_id" name="user_id" class="form-select" required>
                <option value="">Pilih akun</option>
                <?php foreach (($users ?? []) as $user) : ?>
                    <option value="<?= esc($user['id']) ?>" <?= old('user_id') == $user['id'] ? 'selected' : '' ?>>
                        <?= esc($user['nama']) ?> (<?= esc($user['username']) ?>) - <?= esc($user['role']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password sementara</label>
            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" minlength="8" required>
        </div>

        <div class="mb-4">
            <label for="password_confirm" class="form-label fw-semibold">Konfirmasi password</label>
            <input id="password_confirm" name="password_confirm" type="password" class="form-control" autocomplete="new-password" minlength="8" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-key me-1"></i>
            Simpan password sementara
        </button>
    </form>
</div>

<?= $this->endSection() ?>
