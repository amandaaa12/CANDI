<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Akun - CANDI</title>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <style>

        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: #eef2f7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* =========================
           CONTAINER
        ========================== */

        .login-card-container {
            width: 100%;
            max-width: 950px;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.12);
        }

        /* =========================
           PANEL KIRI
        ========================== */

        .brand-section {
            background: linear-gradient(
                145deg,
                #0f172a 0%,
                #1e293b 50%,
                #1e3a8a 100%
            );

            color: #ffffff;
            padding: 3rem 2.5rem;

            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;

            text-align: center;
            position: relative;
        }

        .brand-section::after {
            content: '';

            position: absolute;

            width: 220px;
            height: 220px;

            background: rgba(59, 130, 246, 0.15);

            border-radius: 50%;

            bottom: -50px;
            right: -50px;

            filter: blur(40px);

            pointer-events: none;
        }

        .brand-content {
            margin: auto 0;

            display: flex;
            flex-direction: column;
            align-items: center;

            width: 100%;

            position: relative;
            z-index: 2;
        }

        /* =========================
           LOGO CANDI
        ========================== */

        .logo-box {
            width: 190px;
            height: 190px;

            background: rgba(255, 255, 255, 0.15);

            backdrop-filter: blur(10px);

            border: 1px solid rgba(255, 255, 255, 0.25);

            border-radius: 22px;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;

            padding: 0;

            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .brand-logo-img {
            width: 100%;
            height: 100%;

            object-fit: contain;

            display: block;
        }

        /* =========================
           PANEL KANAN
        ========================== */

        .form-section {
            padding: 3.5rem 3rem;
        }

        .form-control-custom {
            border: none;

            border-bottom: 2px solid #e2e8f0;

            border-radius: 0;

            padding: 0.75rem 0.5rem;

            font-size: 0.95rem;

            background: transparent;

            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            box-shadow: none;

            border-color: #2563eb;

            background: transparent;
        }

        .input-group-text-custom {
            background: transparent;

            border: none;

            border-bottom: 2px solid #e2e8f0;

            border-radius: 0;

            color: #64748b;

            padding-left: 0;
        }

        /* =========================
           TOGGLE PASSWORD
        ========================== */

        .btn-toggle-password {
            background: transparent;

            border: none;

            border-bottom: 2px solid #e2e8f0;

            border-radius: 0;

            color: #64748b;

            cursor: pointer;

            padding-right: 0.5rem;

            transition: color 0.3s ease;
        }

        .btn-toggle-password:hover {
            color: #2563eb;
        }

        .form-control-custom:focus ~ .input-group-text-custom,
        .input-group:focus-within .input-group-text-custom,
        .input-group:focus-within .btn-toggle-password {
            border-color: #2563eb;
            color: #2563eb;
        }

        /* =========================
           TOMBOL DAFTAR
        ========================== */

        .btn-navy {
            background: #1e3a8a;

            color: #ffffff;

            border: none;

            padding: 0.85rem;

            border-radius: 12px;

            font-weight: 600;

            font-size: 1rem;

            letter-spacing: 0.5px;

            transition: all 0.3s ease;

            box-shadow: 0 8px 20px rgba(30, 58, 138, 0.25);
        }

        .btn-navy:hover {
            background: #1e293b;

            color: #ffffff;

            transform: translateY(-2px);

            box-shadow: 0 12px 25px rgba(15, 23, 42, 0.35);
        }

        /* =========================
           ROLE SELECT
        ========================== */

        .role-select {
            appearance: auto;
            cursor: pointer;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 991px) {

            .form-section {
                padding: 2.5rem 2rem;
            }

        }

        @media (max-width: 576px) {

            body {
                padding: 10px;
            }

            .login-card-container {
                border-radius: 18px;
            }

            .form-section {
                padding: 2rem 1.5rem;
            }

        }

    </style>

</head>

<body>

    <div class="login-card-container">

        <div class="row g-0">

            <!-- =====================================
                 PANEL KIRI: BRANDING
            ====================================== -->

            <div class="col-lg-5 brand-section d-none d-lg-flex">

                <div class="brand-content">

                    <!-- LOGO CANDI -->

                    <div class="logo-box mb-4">

                        <img
                            src="<?= base_url('assets/CANDI.png') ?>"
                            alt="Logo CANDI"
                            class="brand-logo-img">

                    </div>

                    <h2 class="fw-bold fs-2 mb-2 text-white">
                        CANDI
                    </h2>

                    <p class="text-white fs-6 fw-semibold mb-1">
                        Catatan Agenda Dan Dokumentasi
                    </p>

                    <p class="text-white small fw-bold tracking-wide mt-1">
                        DINAS PENDIDIKAN KOTA KEDIRI
                    </p>

                </div>

                <div class="w-100 pt-3 border-top border-secondary border-opacity-25">

                    <p class="small text-white-50 mb-0">
                        &copy; 2026 CANDI System.
                    </p>

                </div>

            </div>


            <!-- =====================================
                 PANEL KANAN: FORM REGISTRASI
            ====================================== -->

            <div class="col-lg-7 form-section bg-white">

                <div class="mb-4">

                    <h4
                        class="fw-bold mb-1"
                        style="color: #0f172a;">

                        Buat Akun Baru

                    </h4>

                    <p class="text-muted small">
                        Lengkapi formulir di bawah ini untuk membuat akun CANDI.
                    </p>

                </div>


                <!-- =================================
                     FLASH MESSAGE
                ================================== -->

                <?php if (session()->getFlashdata('error')): ?>

                    <div class="alert alert-danger alert-dismissible fade show small">

                        <i class="bi bi-exclamation-circle me-2"></i>

                        <?= esc(session()->getFlashdata('error')) ?>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>

                    </div>

                <?php endif; ?>


                <?php if (session()->getFlashdata('success')): ?>

                    <div class="alert alert-success alert-dismissible fade show small">

                        <i class="bi bi-check-circle me-2"></i>

                        <?= esc(session()->getFlashdata('success')) ?>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>

                    </div>

                <?php endif; ?>


                <!-- =================================
                     FORM REGISTER
                ================================== -->

                <form
                    action="/register/simpan"
                    method="post">

                    <?= csrf_field() ?>


                    <!-- NAMA LENGKAP -->

                    <div class="mb-4">

                        <label class="form-label small fw-semibold text-secondary">
                            Nama Lengkap
                        </label>

                        <div class="input-group">

                            <span class="input-group-text input-group-text-custom">

                                <i class="bi bi-person"></i>

                            </span>

                            <input
                                type="text"
                                name="nama"
                                class="form-control form-control-custom"
                                placeholder="Masukkan nama lengkap"
                                value="<?= old('nama') ?>"
                                required
                                autofocus>

                        </div>

                    </div>


                    <!-- USERNAME -->

                    <div class="mb-4">

                        <label class="form-label small fw-semibold text-secondary">
                            Username
                        </label>

                        <div class="input-group">

                            <span class="input-group-text input-group-text-custom">

                                <i class="bi bi-envelope"></i>

                            </span>

                            <input
                                type="text"
                                name="username"
                                class="form-control form-control-custom"
                                placeholder="Masukkan username/email"
                                value="<?= old('username') ?>"
                                required>

                        </div>

                    </div>


                    <!-- PASSWORD -->

                    <div class="mb-4">

                        <label class="form-label small fw-semibold text-secondary">
                            Password
                        </label>

                        <div class="input-group">

                            <span class="input-group-text input-group-text-custom">

                                <i class="bi bi-lock"></i>

                            </span>

                            <input
                                type="password"
                                name="password"
                                id="regPassword"
                                class="form-control form-control-custom"
                                placeholder="Buat password"
                                required>

                            <button
                                type="button"
                                class="btn-toggle-password"
                                onclick="togglePassword('regPassword', 'eyeIconReg')">

                                <i
                                    class="bi bi-eye-slash"
                                    id="eyeIconReg">
                                </i>

                            </button>

                        </div>

                    </div>


                    <!-- KONFIRMASI PASSWORD -->

                    <div class="mb-4">

                        <label class="form-label small fw-semibold text-secondary">
                            Konfirmasi Password
                        </label>

                        <div class="input-group">

                            <span class="input-group-text input-group-text-custom">

                                <i class="bi bi-shield-lock"></i>

                            </span>

                            <input
                                type="password"
                                name="password_confirm"
                                id="regConfirmPassword"
                                class="form-control form-control-custom"
                                placeholder="Ulangi password"
                                required>

                            <button
                                type="button"
                                class="btn-toggle-password"
                                onclick="togglePassword(
                                    'regConfirmPassword',
                                    'eyeIconRegConfirm'
                                )">

                                <i
                                    class="bi bi-eye-slash"
                                    id="eyeIconRegConfirm">
                                </i>

                            </button>

                        </div>

                    </div>


                    <!-- ROLE -->

                    <div class="mb-4">

                        <label class="form-label small fw-semibold text-secondary">
                            Daftar Sebagai
                        </label>

                        <div class="input-group">

                            <span class="input-group-text input-group-text-custom">

                                <i class="bi bi-person-badge"></i>

                            </span>

                            <select
                                name="role"
                                class="form-control form-control-custom role-select"
                                required>

                                <option value="">
                                    -- Pilih Role --
                                </option>

                                <option value="Karyawan Dindik"
                                    <?= old('role') === 'Karyawan Dindik' ? 'selected' : '' ?>>
                                    Karyawan Dindik
                                </option>

                                <option value="Guru Sekolah"
                                    <?= old('role') === 'Pegawai Sekolah' ? 'selected' : '' ?>>
                                    Pegawai Sekolah
                                </option>

                            </select>

                        </div>

                        <small class="text-muted">
                            Pilih sesuai dengan status pengguna.
                        </small>

                    </div>


                    <!-- TOMBOL DAFTAR -->

                    <div class="d-grid mb-3 mt-4">

                        <button
                            type="submit"
                            class="btn btn-navy">

                            Daftar Sekarang

                            <i class="bi bi-person-plus ms-2"></i>

                        </button>

                    </div>

                </form>


                <!-- KEMBALI KE LOGIN -->

                <div class="text-center mt-4">

                    <p class="small text-muted mb-0">

                        Sudah punya akun?

                        <a
                            href="/login"
                            class="fw-bold text-decoration-none"
                            style="color: #2563eb;">

                            Masuk di sini

                        </a>

                    </p>

                </div>


                <!-- COPYRIGHT MOBILE -->

                <div class="text-center mt-4 d-lg-none">

                    <small class="text-muted">

                        &copy; 2026 CANDI. All rights reserved.

                    </small>

                </div>

            </div>

        </div>

    </div>


    <!-- Bootstrap 5 JS Bundle -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


    <!-- Toggle Show/Hide Password -->

    <script>

        function togglePassword(inputId, iconId) {

            const passwordInput =
                document.getElementById(inputId);

            const eyeIcon =
                document.getElementById(iconId);

            if (passwordInput.type === 'password') {

                passwordInput.type = 'text';

                eyeIcon.classList.remove('bi-eye-slash');

                eyeIcon.classList.add('bi-eye');

            } else {

                passwordInput.type = 'password';

                eyeIcon.classList.remove('bi-eye');

                eyeIcon.classList.add('bi-eye-slash');

            }

        }

    </script>

</body>

</html>