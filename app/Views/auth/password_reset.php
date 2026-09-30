<?php
/**
 * @var string $mode
 * @var string|null $token
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - CANDI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; display: grid; place-items: center; background: #eef2f7; padding: 24px; }
        .reset-panel { width: min(100%, 460px); background: #fff; border-radius: 12px; padding: 32px; box-shadow: 0 16px 48px rgba(15, 23, 42, .12); }
    </style>
</head>
<body>
    <main class="reset-panel">
        <a href="<?= site_url('/') ?>" class="text-decoration-none fw-bold">CANDI</a>

        <?php if ($mode === 'request') : ?>
            <h1 class="h4 mt-4">Lupa password?</h1>
            <p class="text-secondary">Masukkan username dan email yang terdaftar. Kami akan mengirim tautan reset jika datanya cocok.</p>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success" role="status"><?= esc(session()->getFlashdata('success')) ?></div>
            <?php endif; ?>

            <form action="<?= site_url('password/forgot') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" name="username" class="form-control" value="<?= esc(old('username')) ?>" autocomplete="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email terdaftar</label>
                    <input id="email" name="email" type="email" class="form-control" value="<?= esc(old('email')) ?>" autocomplete="email" required>
                </div>
                <button class="btn btn-primary w-100" type="submit">Kirim tautan reset</button>
            </form>
        <?php elseif ($mode === 'reset') : ?>
            <h1 class="h4 mt-4">Buat password baru</h1>
            <p class="text-secondary">Gunakan password minimal 8 karakter.</p>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>

            <form action="<?= site_url('password/reset') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="token" value="<?= esc($token ?? '') ?>">
                <div class="mb-3">
                    <label for="password" class="form-label">Password baru</label>
                    <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" minlength="8" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Ulangi password baru</label>
                    <input id="password_confirm" name="password_confirm" type="password" class="form-control" autocomplete="new-password" minlength="8" required>
                </div>
                <button class="btn btn-primary w-100" type="submit">Simpan password baru</button>
            </form>
        <?php else : ?>
            <h1 class="h4 mt-4">Tautan tidak berlaku</h1>
            <p class="text-secondary">Tautan reset tidak valid atau sudah kedaluwarsa. Minta tautan baru untuk melanjutkan.</p>
            <a class="btn btn-primary w-100" href="<?= site_url('password/forgot') ?>">Minta tautan baru</a>
        <?php endif; ?>

        <a class="d-block text-center mt-4" href="<?= site_url('login') ?>">Kembali ke login</a>
    </main>
</body>
</html>
