<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'CANDI - Catatan Notulensi dan Dokumentasi' ?></title>


    <!-- GOOGLE FONT -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >


    <!-- BOOTSTRAP -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- BOOTSTRAP ICONS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >


    <style>

        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }


        /* =========================================
           BODY
        ========================================= */

        body {
            margin: 0;
            background-color: #f1f5f9;
            color: #334155;
            overflow-x: hidden;
        }


        /* =========================================
           SIDEBAR
        ========================================= */

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;

            background: linear-gradient(
                180deg,
                #0f172a 0%,
                #1e293b 60%,
                #1d3557 100%
            );

            color: #ffffff;
            z-index: 1000;

            display: flex;
            flex-direction: column;

            box-shadow:
                4px 0 20px rgba(15, 23, 42, 0.15);
        }


        /* =========================================
           LOGO CANDI
        ========================================= */

        .sidebar-brand {
            width: 100%;
            height: 115px;
            padding: 8px 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-bottom:
                1px solid rgba(255, 255, 255, 0.08);

            overflow: hidden;
        }


        .logo-candi {
            width: 220px;
            height: 90px;

            object-fit: contain;
            object-position: center;

            display: block;
        }


        /* =========================================
           MENU SIDEBAR
        ========================================= */

        .sidebar-menu {
            list-style: none;
            padding: 1.25rem 0.85rem;
            margin: 0;

            display: flex;
            flex-direction: column;
            flex: 1;
        }


        .sidebar-menu li {
            list-style: none;
        }


        .sidebar-menu .nav-link {
            color: #94a3b8;

            padding: 0.8rem 1rem;

            border-radius: 12px;

            display: flex;
            align-items: center;

            gap: 12px;

            font-weight: 500;
            font-size: 0.9rem;

            text-decoration: none;

            margin-bottom: 6px;

            transition: all 0.2s ease;
        }


        .sidebar-menu .nav-link i {
            width: 22px;
            font-size: 1.05rem;
        }


        .sidebar-menu .nav-link:hover {
            color: #ffffff;

            background-color:
                rgba(255, 255, 255, 0.08);
        }


        /* =========================================
           MENU AKTIF
        ========================================= */

        .sidebar-menu .nav-link.active {
            color: #ffffff;

            background: #2563eb;

            font-weight: 600;

            box-shadow:
                0 4px 12px rgba(37, 99, 235, 0.35);
        }


        /* =========================================
           MENU KELUAR
        ========================================= */

        .sidebar-menu .logout-item {
            margin-top: auto;
        }


        .sidebar-menu .logout-item .nav-link {
            color: #ff6b6b !important;
        }


        .sidebar-menu .logout-item .nav-link i {
            color: #ff6b6b !important;
        }


        /* Hover menu keluar */

        .sidebar-menu .logout-item .nav-link:hover {
            background: #dc3545 !important;

            color: #ffffff !important;
        }


        .sidebar-menu .logout-item .nav-link:hover i {
            color: #ffffff !important;
        }


        /* =========================================
           MAIN WRAPPER
        ========================================= */

        .main-wrapper {
            margin-left: 250px;
            min-height: 100vh;
        }


        /* =========================================
           TOPBAR
        ========================================= */

        .topbar {
            height: 70px;

            background: #2563eb;

            color: #ffffff;

            padding: 0 2rem;

            display: flex;
            align-items: center;
            justify-content: space-between;

            box-shadow:
                0 2px 10px rgba(37, 99, 235, 0.15);
        }


        .topbar-title {
            font-size: 1.15rem;

            font-weight: 600;

            margin: 0;

            color: #ffffff;
        }


        /* =========================================
           PROFILE USER
        ========================================= */

        .admin-profile {
            display: flex;
            align-items: center;

            gap: 12px;

            color: #ffffff;
        }


        .profile-icon {
            width: 48px;
            height: 48px;

            border-radius: 50%;

            background:
                rgba(255, 255, 255, 0.18);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 16px;

            font-weight: 600;

            color: #ffffff;

            flex-shrink: 0;
        }


        .profile-info {
            display: flex;

            flex-direction: column;

            justify-content: center;

            line-height: 1.2;
        }


        .profile-name {
            color: #ffffff;

            font-size: 15px;

            font-weight: 600;
        }


        .profile-role {
            color:
                rgba(255, 255, 255, 0.75);

            font-size: 12px;

            margin-top: 4px;
        }


        /* =========================================
           CONTENT
        ========================================= */

        .content-container {
            padding: 2rem;
        }


        /* =========================================
           CARD
        ========================================= */

        .card-custom {
            background: #ffffff;

            border: none;

            border-radius: 16px;

            box-shadow:
                0 4px 15px rgba(0, 0, 0, 0.03);

            margin-bottom: 1.5rem;

            padding: 1.5rem;
        }


        /* =========================================
           BUTTON PRIMARY
        ========================================= */

        .btn-primary-custom {
            background-color: #2563eb;

            color: #ffffff;

            border: none;

            border-radius: 8px;

            padding: 0.6rem 1.2rem;

            font-weight: 500;

            font-size: 0.9rem;

            transition: all 0.2s ease;
        }


        .btn-primary-custom:hover {
            background-color: #1d4ed8;

            color: #ffffff;
        }


        /* =========================================
           TABLE
        ========================================= */

        .table-custom {
            margin-bottom: 0;
        }


        .table-custom th {
            background-color: #f8fafc;

            color: #0f172a;

            font-weight: 600;

            font-size: 0.88rem;

            padding: 1rem;

            border-bottom:
                2px solid #e2e8f0;
        }


        .table-custom td {
            padding: 1rem;

            vertical-align: middle;

            font-size: 0.88rem;

            color: #334155;

            border-bottom:
                1px solid #f1f5f9;
        }


        /* =========================================
           BUTTON AKSI
        ========================================= */

        .btn-action {
            font-size: 0.8rem;

            padding: 0.35rem 0.65rem;

            border-radius: 6px;

            border:
                1px solid #e2e8f0;

            background-color: #f8fafc;

            color: #334155;

            font-weight: 500;

            margin-right: 3px;

            transition: all 0.2s;
        }


        .btn-action:hover {
            background-color: #e2e8f0;

            color: #0f172a;
        }


        /* =========================================
           FORM
        ========================================= */

        .form-control {
            border-radius: 8px;
        }


        .form-control:focus {
            border-color: #60a5fa;

            box-shadow:
                0 0 0 0.2rem
                rgba(37, 99, 235, 0.15);
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 991.98px) {

            .sidebar {
                margin-left: -250px;
            }


            .main-wrapper {
                margin-left: 0;
            }

        }

    </style>

</head>


<body>


    <!-- =========================================
         SIDEBAR
    ========================================= -->

    <aside class="sidebar">


        <!-- LOGO CANDI -->

        <div class="sidebar-brand">

            <img
                src="/assets/CANDI.png"
                alt="CANDI"
                class="logo-candi"
            >

        </div>


        <!-- MENU -->

        <ul class="sidebar-menu">


            <!-- DASHBOARD -->

            <li>

                <a
                    href="<?= site_url('admin') ?>"
                    class="nav-link <?= uri_string() == 'admin' ? 'active' : '' ?>"
                >

                    <i class="bi bi-house-door"></i>

                    <span>
                        Dashboard
                    </span>

                </a>

            </li>


            <!-- AGENDA -->

            <li>

                <a
                    href="<?= site_url('admin/agenda') ?>"
                    class="nav-link <?= strpos(uri_string(), 'admin/agenda') === 0 ? 'active' : '' ?>"
                >

                    <i class="bi bi-calendar-event"></i>

                    <span>
                        Agenda Kegiatan
                    </span>

                </a>

            </li>


            <!-- LAPORAN -->

            <li>

                <a
                    href="<?= site_url('admin/laporan') ?>"
                    class="nav-link <?= strpos(uri_string(), 'admin/laporan') === 0 ? 'active' : '' ?>"
                >

                    <i class="bi bi-file-earmark-text"></i>

                    <span>
                        Laporan
                    </span>

                </a>

            </li>


            <!-- KELUAR -->

            <li class="logout-item">

                <a
                    href="<?= site_url('logout') ?>"
                    class="nav-link"
                >

                    <i class="bi bi-box-arrow-right"></i>

                    <span>
                        Keluar
                    </span>

                </a>

            </li>


        </ul>

    </aside>



    <!-- =========================================
         MAIN WRAPPER
    ========================================= -->

    <div class="main-wrapper">


        <!-- TOPBAR -->

        <header class="topbar">


            <h1 class="topbar-title">

                <?= $title ?? 'CANDI (Catatan Notulensi dan Dokumentasi)' ?>

            </h1>


            <!-- PROFILE USER YANG LOGIN -->

            <div class="admin-profile">

                <?php

                    $namaUser = session()->get('nama') ?? 'Admin';

                    $roleUser = session()->get('role') ?? 'Admin';


                    // Membuat inisial dari nama

                    $namaParts = preg_split(
                        '/\s+/',
                        trim($namaUser)
                    );

                    $inisial = '';


                    foreach (
                        array_slice($namaParts, 0, 2)
                        as $part
                    ) {

                        if ($part !== '') {

                            $inisial .= strtoupper(
                                substr($part, 0, 1)
                            );

                        }

                    }


                    if ($inisial === '') {

                        $inisial = 'A';

                    }

                ?>


                <!-- INISIAL -->

                <div class="profile-icon">

                    <?= esc($inisial) ?>

                </div>


                <!-- NAMA + ROLE -->

                <div class="profile-info">

                    <div class="profile-name">

                        <?= esc($namaUser) ?>

                    </div>


                    <div class="profile-role">

                        <?= esc($roleUser) ?>

                    </div>

                </div>


            </div>


        </header>



        <!-- =========================================
             ISI HALAMAN
        ========================================= -->

        <main class="content-container">

            <?= $this->renderSection('content') ?>

        </main>


    </div>



    <!-- BOOTSTRAP JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>