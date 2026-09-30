<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= ($mode ?? 'request') === 'reset'
            ? 'Buat Password Baru'
            : 'Lupa Password' ?>
        - CANDI
    </title>


    <!-- BOOTSTRAP -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- BOOTSTRAP ICON -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >


    <style>

        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f1f5f9;

            font-family: Arial, sans-serif;
        }


        .reset-card {
            width: 100%;

            max-width: 430px;

            background: #ffffff;

            border-radius: 18px;

            padding: 35px;

            box-shadow:
                0 10px 35px
                rgba(0, 0, 0, 0.08);
        }


        .logo {
            text-align: center;

            margin-bottom: 25px;
        }


        .logo h2 {
            margin: 0;

            color: #2563eb;

            font-weight: 700;

            letter-spacing: 1px;
        }


        .logo p {
            margin: 5px 0 0;

            color: #64748b;

            font-size: 13px;
        }


        .title {
            text-align: center;

            font-size: 22px;

            font-weight: 600;

            color: #0f172a;

            margin-bottom: 8px;
        }


        .subtitle {
            text-align: center;

            color: #64748b;

            font-size: 14px;

            line-height: 1.6;

            margin-bottom: 25px;
        }


        .form-label {
            font-size: 14px;

            font-weight: 600;

            color: #334155;
        }


        .form-control {
            height: 46px;

            border-radius: 9px;

            border: 1px solid #cbd5e1;

            padding-left: 13px;
        }


        .form-control:focus {
            border-color: #2563eb;

            box-shadow:
                0 0 0 3px
                rgba(37, 99, 235, 0.12);
        }


        /* =========================================
           PASSWORD
        ========================================= */

        .password-wrapper {
            position: relative;
        }


        .password-wrapper .form-control {
            padding-right: 48px;
        }


        .toggle-password {
            position: absolute;

            right: 10px;

            top: 50%;

            transform: translateY(-50%);

            width: 35px;

            height: 35px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: none;

            background: transparent;

            color: #64748b;

            cursor: pointer;

            border-radius: 6px;
        }


        .toggle-password:hover {
            color: #2563eb;

            background: #eff6ff;
        }


        .toggle-password i {
            font-size: 18px;
        }


        /* =========================================
           BUTTON
        ========================================= */

        .btn-reset {
            width: 100%;

            height: 46px;

            margin-top: 8px;

            border: none;

            border-radius: 9px;

            background: #2563eb;

            color: #ffffff;

            font-weight: 600;

            transition: 0.2s;
        }


        .btn-reset:hover {
            background: #1d4ed8;

            color: #ffffff;
        }


        /* =========================================
           ALERT
        ========================================= */

        .alert {
            font-size: 13px;

            border-radius: 9px;

            margin-bottom: 20px;
        }


        /* =========================================
           BACK LOGIN
        ========================================= */

        .back-login {
            display: block;

            text-align: center;

            margin-top: 20px;

            color: #2563eb;

            text-decoration: none;

            font-size: 14px;
        }


        .back-login:hover {
            text-decoration: underline;
        }


        /* =========================================
           USERNAME
        ========================================= */

        .username-info {
            background: #eff6ff;

            color: #1e40af;

            border-radius: 9px;

            padding: 10px 12px;

            font-size: 13px;

            margin-bottom: 20px;

            text-align: center;
        }

    </style>

</head>


<body>


<div class="reset-card">


    <!-- =========================================
         LOGO
    ========================================= -->

    <div class="logo">

        <h2>CANDI</h2>

        <p>
            Catatan Notulensi dan Dokumentasi
        </p>

    </div>


    <!-- =========================================
         PESAN ERROR
    ========================================= -->

    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger">

            <i class="bi bi-exclamation-circle me-1"></i>

            <?= esc(
                session()->getFlashdata('error')
            ) ?>

        </div>

    <?php endif; ?>


    <!-- =========================================
         PESAN SUKSES
    ========================================= -->

    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success">

            <i class="bi bi-check-circle me-1"></i>

            <?= esc(
                session()->getFlashdata('success')
            ) ?>

        </div>

    <?php endif; ?>


    <?php if (($mode ?? 'request') === 'request'): ?>


        <!-- =====================================
             FORM USERNAME
        ====================================== -->

        <div class="title">

            Lupa Password?

        </div>


        <div class="subtitle">

            Masukkan username akun kamu untuk
            membuat password baru.

        </div>


        <form
            action="<?= base_url('password/forgot') ?>"
            method="post"
        >

            <?= csrf_field() ?>


            <div class="mb-3">

                <label
                    for="username"
                    class="form-label"
                >
                    Username
                </label>


                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-control"
                    placeholder="Masukkan username"
                    value="<?= esc(
                        old('username')
                    ) ?>"
                    autocomplete="username"
                    required
                    autofocus
                >

            </div>


            <button
                type="submit"
                class="btn-reset"
            >

                Lanjutkan

            </button>

        </form>


    <?php elseif (($mode ?? '') === 'reset'): ?>


        <!-- =====================================
             FORM PASSWORD BARU
        ====================================== -->

        <div class="title">

            Buat Password Baru

        </div>


        <div class="subtitle">

            Silakan masukkan password baru
            untuk akun kamu.

        </div>


        <div class="username-info">

            Username:

            <strong>
                <?= esc($username ?? '') ?>
            </strong>

        </div>


        <form
            action="<?= base_url('password/reset') ?>"
            method="post"
        >

            <?= csrf_field() ?>


            <!-- PASSWORD BARU -->

            <div class="mb-3">

                <label
                    for="password"
                    class="form-label"
                >
                    Password Baru
                </label>


                <div class="password-wrapper">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Minimal 8 karakter"
                        autocomplete="new-password"
                        minlength="8"
                        required
                    >


                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword(
                            'password',
                            'eyePassword'
                        )"
                        aria-label="Tampilkan password"
                    >

                        <i
                            class="bi bi-eye"
                            id="eyePassword"
                        ></i>

                    </button>

                </div>

            </div>


            <!-- KONFIRMASI PASSWORD -->

            <div class="mb-3">

                <label
                    for="password_confirm"
                    class="form-label"
                >
                    Konfirmasi Password
                </label>


                <div class="password-wrapper">

                    <input
                        type="password"
                        id="password_confirm"
                        name="password_confirm"
                        class="form-control"
                        placeholder="Ulangi password"
                        autocomplete="new-password"
                        minlength="8"
                        required
                    >


                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword(
                            'password_confirm',
                            'eyeConfirm'
                        )"
                        aria-label="Tampilkan password"
                    >

                        <i
                            class="bi bi-eye"
                            id="eyeConfirm"
                        ></i>

                    </button>

                </div>

            </div>


            <button
                type="submit"
                class="btn-reset"
            >

                <i class="bi bi-check2-circle me-1"></i>

                Simpan Password

            </button>

        </form>


    <?php endif; ?>


    <!-- =========================================
         KEMBALI KE LOGIN
    ========================================= -->

    <a
        href="<?= base_url('login') ?>"
        class="back-login"
    >

        <i class="bi bi-arrow-left"></i>

        Kembali ke Login

    </a>


</div>


<!-- =========================================
     JAVASCRIPT
========================================= -->

<script>

function togglePassword(inputId, iconId)
{
    const input =
        document.getElementById(inputId);

    const icon =
        document.getElementById(iconId);


    if (!input || !icon) {
        return;
    }


    if (input.type === 'password') {

        input.type = 'text';

        icon.classList.remove(
            'bi-eye'
        );

        icon.classList.add(
            'bi-eye-slash'
        );

    } else {

        input.type = 'password';

        icon.classList.remove(
            'bi-eye-slash'
        );

        icon.classList.add(
            'bi-eye'
        );
    }
}

</script>


</body>

</html>