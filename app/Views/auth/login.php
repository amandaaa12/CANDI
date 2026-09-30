<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - CANDI</title>


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">


    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
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


        /* =====================================
           CONTAINER UTAMA
        ====================================== */

        .login-card-container {

            width: 100%;

            max-width: 950px;

            background: #ffffff;

            border-radius: 24px;

            overflow: hidden;

            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.12);
        }


        /* =====================================
           PANEL KIRI
        ====================================== */

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
        }


        /* =====================================
           LOGO CANDI
        ====================================== */

        .logo-box {

            width: 190px;

            height: 190px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 20px;

            overflow: hidden;
        }


        .brand-logo-img {

            width: 100%;

            height: 100%;

            object-fit: contain;

            display: block;
        }


        /* =====================================
           PANEL KANAN
        ====================================== */

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


        /* =====================================
           TOGGLE PASSWORD
        ====================================== */

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


        /* =====================================
           TOMBOL LOGIN
        ====================================== */

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


        /* =====================================
           CHECKBOX
        ====================================== */

        .form-check-input:checked {

            background-color: #2563eb;

            border-color: #2563eb;
        }


        /* =====================================
           POPUP NOTIFIKASI
        ====================================== */

        .popup-notification {

            position: fixed;

            top: 25px;

            right: 25px;

            z-index: 9999;

            min-width: 320px;

            max-width: 420px;

            padding: 16px 20px;

            border-radius: 12px;

            background: #ffffff;

            box-shadow: 0 10px 35px rgba(15, 23, 42, 0.18);

            display: flex;

            align-items: center;

            gap: 12px;

            animation: popupMasuk 0.4s ease;
        }


        .popup-success {

            border-left: 5px solid #16a34a;
        }


        .popup-error {

            border-left: 5px solid #dc2626;
        }


        .popup-icon {

            width: 40px;

            height: 40px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            font-size: 20px;
        }


        .popup-success .popup-icon {

            background: #dcfce7;

            color: #16a34a;
        }


        .popup-error .popup-icon {

            background: #fee2e2;

            color: #dc2626;
        }


        .popup-content {

            flex: 1;
        }


        .popup-title {

            font-weight: 600;

            font-size: 14px;

            margin-bottom: 2px;

            color: #0f172a;
        }


        .popup-message {

            font-size: 13px;

            color: #64748b;

            margin: 0;
        }


        .popup-close {

            background: none;

            border: none;

            color: #94a3b8;

            font-size: 18px;

            cursor: pointer;

            padding: 0;
        }


        .popup-close:hover {

            color: #334155;
        }


        @keyframes popupMasuk {

            from {

                opacity: 0;

                transform: translateX(30px);
            }

            to {

                opacity: 1;

                transform: translateX(0);
            }
        }


        @keyframes popupKeluar {

            from {

                opacity: 1;

                transform: translateX(0);
            }

            to {

                opacity: 0;

                transform: translateX(30px);
            }
        }


        .popup-hide {

            animation: popupKeluar 0.4s ease forwards;
        }


        /* =====================================
           RESPONSIVE
        ====================================== */

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


            .popup-notification {

                top: 15px;

                right: 15px;

                left: 15px;

                min-width: auto;

                max-width: none;
            }

        }

    </style>

</head>


<body>


    <!-- =====================================
         POPUP PENDAFTARAN BERHASIL
    ====================================== -->

    <?php if (session()->getFlashdata('success')): ?>

        <div
            id="popupSuccess"
            class="popup-notification popup-success">

            <div class="popup-icon">

                <i class="bi bi-check-lg"></i>

            </div>


            <div class="popup-content">

                <div class="popup-title">

                    Berhasil!

                </div>


                <p class="popup-message">

                    <?= esc(session()->getFlashdata('success')) ?>

                </p>

            </div>


            <button
                type="button"
                class="popup-close"
                onclick="tutupPopup('popupSuccess')">

                <i class="bi bi-x"></i>

            </button>

        </div>

    <?php endif; ?>


    <!-- =====================================
         POPUP ERROR
    ====================================== -->

    <?php if (session()->getFlashdata('error')): ?>

        <div
            id="popupError"
            class="popup-notification popup-error">

            <div class="popup-icon">

                <i class="bi bi-exclamation-lg"></i>

            </div>


            <div class="popup-content">

                <div class="popup-title">

                    Pendaftaran Gagal

                </div>


                <p class="popup-message">

                    <?= esc(session()->getFlashdata('error')) ?>

                </p>

            </div>


            <button
                type="button"
                class="popup-close"
                onclick="tutupPopup('popupError')">

                <i class="bi bi-x"></i>

            </button>

        </div>

    <?php endif; ?>


    <!-- =====================================
         CONTAINER LOGIN
    ====================================== -->

    <div class="login-card-container">

        <div class="row g-0">


            <!-- =====================================
                 PANEL KIRI
            ====================================== -->

            <div class="col-lg-5 brand-section d-none d-lg-flex">

                <div class="brand-content">


                    <!-- LOGO CANDI -->

                    <div class="logo-box">

                        <img
                            src="<?= base_url('assets/CANDI.png') ?>"
                            alt="Logo CANDI"
                            class="brand-logo-img">

                    </div>


                    <!-- NAMA APLIKASI -->

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


                <!-- FOOTER -->

                <div class="w-100 pt-3 border-top border-secondary border-opacity-25">

                    <p class="small text-white-50 mb-0">

                        &copy; 2026 CANDI System.

                    </p>

                </div>

            </div>


            <!-- =====================================
                 PANEL KANAN
            ====================================== -->

            <div class="col-lg-7 form-section bg-white">


                <!-- JUDUL -->

                <div class="mb-4">

                    <h4
                        class="fw-bold mb-1"
                        style="color: #0f172a;">

                        Selamat Datang!

                    </h4>


                    <p class="text-muted small">

                        Silakan masukkan akun kamu untuk melanjutkan.

                    </p>

                </div>


                <!-- =====================================
                     FORM LOGIN
                ====================================== -->

                <form
                    action="<?= site_url('login/masuk') ?>"
                    method="post">

                    <?= csrf_field() ?>


                    <!-- USERNAME / EMAIL -->

                    <div class="mb-4">

                        <label class="form-label small fw-semibold text-secondary">

                            Username atau Email

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
                                required
                                autofocus>

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
                                id="loginPassword"
                                class="form-control form-control-custom"
                                placeholder="Masukkan password"
                                required>


                            <button
                                type="button"
                                class="btn-toggle-password"
                                onclick="togglePassword()">


                                <i
                                    class="bi bi-eye-slash"
                                    id="eyeIcon">
                                </i>


                            </button>

                        </div>

                    </div>


                    <!-- OPTIONS -->

                    <div
                        class="d-flex justify-content-between align-items-center mb-4 pb-2">


                        <div class="form-check">


                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="remember">


                            <label
                                class="form-check-label small text-secondary"
                                for="remember">

                                Ingat saya

                            </label>

                        </div>

                        <a
                            href="<?= site_url('password/forgot') ?>"
                            class="small text-decoration-none"
                            style="color: #2563eb;">
                            Lupa password?
                        </a>

                    </div>


                    <!-- TOMBOL LOGIN -->

                    <div class="d-grid mb-3">

                        <button
                            type="submit"
                            class="btn btn-navy">

                            Masuk Sekarang

                            <i class="bi bi-arrow-right ms-2"></i>

                        </button>

                    </div>


                </form>


                <!-- =====================================
                     REGISTRASI
                ====================================== -->

                <div class="text-center mt-4">

                    <p class="small text-muted mb-0">

                        Belum punya akun?


                        <a
                            href="<?= site_url('register') ?>"
                            class="fw-bold text-decoration-none"
                            style="color: #2563eb;">

                            Daftar Sekarang

                        </a>

                    </p>

                </div>


                <!-- MOBILE FOOTER -->

                <div class="text-center mt-4 d-lg-none">

                    <small class="text-muted">

                        &copy; 2026 CANDI. All rights reserved.

                    </small>

                </div>


            </div>

        </div>

    </div>


    <!-- =====================================
         BOOTSTRAP JS
    ====================================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


    <!-- =====================================
         TOGGLE PASSWORD
    ====================================== -->

    <script>

        function togglePassword() {

            const passwordInput =
                document.getElementById('loginPassword');

            const eyeIcon =
                document.getElementById('eyeIcon');


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


        // =====================================
        // MENUTUP POPUP
        // =====================================

        function tutupPopup(id) {

            const popup =
                document.getElementById(id);


            if (popup) {

                popup.classList.add('popup-hide');

                setTimeout(function () {

                    popup.remove();

                }, 400);

            }

        }


        // =====================================
        // POPUP OTOMATIS HILANG
        // =====================================

        setTimeout(function () {

            const success =
                document.getElementById('popupSuccess');

            const error =
                document.getElementById('popupError');


            if (success) {

                tutupPopup('popupSuccess');

            }


            if (error) {

                tutupPopup('popupError');

            }

        }, 5000);

    </script>


</body>

</html>