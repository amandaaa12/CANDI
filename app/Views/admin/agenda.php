<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<style>

    /* ==========================================
       ANIMASI
       ========================================== */

    .animate-pulse {
        animation: pulse-animation 1.5s infinite;
    }

    @keyframes pulse-animation {

        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.65;
        }

        100% {
            opacity: 1;
        }

    }


    /* ==========================================
       HEADER
       ========================================== */

    .agenda-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .agenda-title {
        font-size: 1.55rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .agenda-subtitle {
        color: #64748b;
        margin: 0;
        font-size: 0.9rem;
    }


    /* ==========================================
       CARD
       ========================================== */

    .agenda-card {
        background: #ffffff;
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.06);
    }


    /* ==========================================
       FILTER
       ========================================== */

    .filter-box {
        background: #f8fafc;
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 18px;
    }

    .filter-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }

    .filter-control {
        height: 42px;
        border: 1px solid #dbe3ee;
        border-radius: 9px;
        font-size: 0.85rem;
        color: #334155;
    }

    .filter-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }

    .search-wrapper {
        position: relative;
    }

    .search-wrapper i {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        z-index: 2;
    }

    .search-input {
        padding-left: 38px;
    }


    /* ==========================================
       TOMBOL RESET
       ========================================== */

    .btn-reset-filter {
    height: 42px;
    border: 1px solid #5495de;
    background: #98c5ff;
    color: #2563eb;
    border-radius: 9px;
    font-size: 0.85rem;
    font-weight: 600;
    transition: 0.2s;
}

.btn-reset-filter:hover {
    background: #3b79ff;
    border-color: #2563eb;
    color: #ffffff;
}

    /* ==========================================
       TABEL
       ========================================== */

    .table-agenda {
        margin-bottom: 0;
    }

    .table-agenda thead th {
        background: #f8fafc;
        color: #0f172a;
        font-size: 0.78rem;
        font-weight: 700;
        border-bottom: 1px solid #e2e8f0;
        padding: 15px 12px;
        white-space: nowrap;
    }

    .table-agenda tbody td {
        font-size: 0.82rem;
        vertical-align: middle;
        padding: 15px 12px;
        border-bottom: 1px solid #edf2f7;
    }

    .table-agenda tbody tr:last-child td {
        border-bottom: none;
    }


    /* ==========================================
       WARNA BARIS AGENDA
       ========================================== */

    .agenda-merah td {
        background-color: #ff7b7b !important;
        color: #7a0000 !important;
        font-weight: 600;
    }

    .agenda-kuning td {
        background-color: #ffd84d !important;
        color: #5c4500 !important;
        font-weight: 600;
    }

    .agenda-hijau td {
        background-color: #72e08b !important;
        color: #075b1a !important;
        font-weight: 600;
    }

    .agenda-selesai td {
        background-color: #ffffff !important;
        color: #333333 !important;
    }

    .agenda-merah:hover td {
        background-color: #ff5c5c !important;
    }

    .agenda-kuning:hover td {
        background-color: #ffc928 !important;
    }

    .agenda-hijau:hover td {
        background-color: #4fdc6e !important;
    }

    .agenda-selesai:hover td {
        background-color: #f5f5f5 !important;
    }


    /* ==========================================
       TOMBOL AKSI
       ========================================== */

    .btn-aksi {
        border: none;
        border-radius: 7px;
        padding: 7px 10px;
        font-size: 0.75rem;
        margin: 2px;
        text-decoration: none !important;
        font-weight: 500;
        transition: 0.2s;
        white-space: nowrap;
    }


    /* EDIT */

    .btn-edit {
        background: #ffc107;
        color: #212529 !important;
    }

    .btn-edit:hover {
        background: #e0a800;
        color: #212529 !important;
    }


    /* HAPUS */

    .btn-hapus {
        background: #dc3545;
        color: #ffffff !important;
    }

    .btn-hapus:hover {
        background: #bb2d3b;
        color: #ffffff !important;
    }


    /* DETAIL */

    .btn-detail {
        background: #0d6efd;
        color: #ffffff !important;
    }

    .btn-detail:hover {
        background: #0b5ed7;
        color: #ffffff !important;
    }


    /* ==========================================
       TOMBOL TAMBAH
       ========================================== */

    .btn-tambah {
        background: #0d6efd;
        color: #ffffff !important;
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none !important;
        transition: 0.2s;
    }

    .btn-tambah:hover {
        background: #0b5ed7;
        color: #ffffff !important;
    }


    /* ==========================================
       MODAL
       ========================================== */

    .modal-icon-box {
        width: 48px;
        height: 48px;
        background-color: #e7f1ff;
        color: #0d6efd;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }

    .modal .form-control {
        border-radius: 9px;
        border: 1px solid #dbe3ee;
        font-size: 0.85rem;
    }

    .modal .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }


    /* ==========================================
       KETERANGAN WARNA
       ========================================== */

    .legend-box {
        background: #eef5ff;
        border-radius: 12px;
        padding: 16px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.78rem;
        color: #475569;
    }

    .legend-circle {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        display: inline-block;
    }


    /* ==========================================
       DATA TIDAK DITEMUKAN
       ========================================== */

    .no-result {
        display: none;
    }


    /* ==========================================
       RESPONSIVE
       ========================================== */

    @media (max-width: 768px) {

        .agenda-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .btn-tambah {
            width: 100%;
            text-align: center;
        }

    }

</style>


<!-- ==========================================
     HEADER
     ========================================== -->

<div class="agenda-header">

    <div>

        <h3 class="agenda-title">
            Agenda Kegiatan
        </h3>

        <p class="agenda-subtitle">
            Kelola agenda kegiatan Dinas Pendidikan Kota Kediri
        </p>

    </div>


    <button
        type="button"
        class="btn-tambah"
        data-bs-toggle="modal"
        data-bs-target="#modalAgenda">

        <i class="bi bi-plus-lg me-1"></i>
        Tambah Agenda Baru

    </button>

</div>


<!-- ==========================================
     PESAN BERHASIL
     ========================================== -->

<?php if (session()->getFlashdata('success')) : ?>

    <div class="alert alert-success alert-dismissible fade show rounded-3">

        <i class="bi bi-check-circle me-1"></i>

        <?= session()->getFlashdata('success') ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

<?php endif; ?>


<!-- ==========================================
     PESAN ERROR
     ========================================== -->

<?php if (session()->getFlashdata('error')) : ?>

    <div class="alert alert-danger alert-dismissible fade show rounded-3">

        <i class="bi bi-exclamation-triangle me-1"></i>

        <?= session()->getFlashdata('error') ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

<?php endif; ?>


<!-- ==========================================
     FILTER
     ========================================== -->

<div class="agenda-card p-3 mb-3">

    <div class="filter-box mb-0">

        <div class="row g-3">

            <!-- FILTER BULAN -->

            <div class="col-md-3">

                <label class="filter-label">
                    Filter Bulan
                </label>

                <select
                    id="filterBulan"
                    class="form-select filter-control">

                    <option value="semua">
                        Semua Bulan
                    </option>

                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>

                </select>

            </div>


            <!-- FILTER STATUS -->

            <div class="col-md-3">

                <label class="filter-label">
                    Status Kegiatan
                </label>

                <select
                    id="filterStatus"
                    class="form-select filter-control">

                    <option value="semua">
                        Semua Status
                    </option>

                    <option value="akan-datang">
                        Akan Datang
                    </option>

                    <option value="sedang">
                        Sedang Berlangsung
                    </option>

                    <option value="selesai">
                        Selesai
                    </option>

                </select>

            </div>


            <!-- PENCARIAN -->

            <div class="col-md-3">

                <label class="filter-label">
                    Cari Agenda
                </label>

                <div class="search-wrapper">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        id="searchAgenda"
                        class="form-control filter-control search-input"
                        placeholder="Cari nama kegiatan, tempat..."
                    >

                </div>

            </div>


            <!-- RESET -->

            <div class="col-md-3 d-flex align-items-end">

                <button
                    type="button"
                    id="btnResetFilter"
                    class="btn btn-reset-filter w-100">

                    <i class="bi bi-arrow-counterclockwise me-1"></i>

                    Reset

                </button>

            </div>

        </div>

    </div>

</div>


<!-- ==========================================
     TABEL
     ========================================== -->

<div class="agenda-card">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-agenda">

                <thead>

                    <tr>

                        <th class="ps-4">
                            No
                        </th>

                        <th>
                            Tanggal & Waktu
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Nama Kegiatan
                        </th>

                        <th>
                            Tempat
                        </th>

                        <th>
                            Narasumber
                        </th>

                        <th class="text-end pe-4">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody id="agendaTableBody">

                    <?php if (!empty($agenda)) : ?>

                        <?php $no = 1; ?>


                        <?php foreach ($agenda as $item) : ?>

                            <?php

                            date_default_timezone_set('Asia/Jakarta');

                            /*
                             * WAKTU ACARA
                             */

                            $tanggalWaktu =
                                $item['tanggal'] . ' ' . $item['waktu'];

                            $waktuAcara =
                                strtotime($tanggalWaktu);

                            $waktuSekarang =
                                time();

                            $selisih =
                                $waktuAcara - $waktuSekarang;


                            /*
                             * DEFAULT STATUS
                             */

                            $row_class = 'agenda-selesai';
                            $badge_class = 'bg-light text-dark border';
                            $status_text = 'Selesai';
                            $status_filter = 'selesai';


                            /*
                             * ACARA SUDAH DIMULAI
                             */

                            if ($selisih <= 0) {

                                $sudahBerjalan =
                                    abs($selisih);


                                /*
                                 * 0 - 3 JAM
                                 */

                                if ($sudahBerjalan <= 3 * 60 * 60) {

                                    $row_class =
                                        'agenda-hijau';

                                    $badge_class =
                                        'bg-success text-white';

                                    $status_text =
                                        'Sedang Berlangsung';

                                    $status_filter =
                                        'sedang';

                                }


                                /*
                                 * LEBIH DARI 3 JAM
                                 */

                                else {

                                    $row_class =
                                        'agenda-selesai';

                                    $badge_class =
                                        'bg-light text-dark border';

                                    $status_text =
                                        'Selesai';

                                    $status_filter =
                                        'selesai';

                                }

                            }


                            /*
                             * ACARA BELUM DIMULAI
                             */

                            else {

                                $jam =
                                    floor($selisih / 3600);

                                $menit =
                                    floor($selisih / 60);


                                /*
                                 * <= 1 JAM
                                 */

                                if ($selisih <= 1 * 60 * 60) {

                                    $row_class =
                                        'agenda-merah';

                                    $badge_class =
                                        'bg-danger text-white animate-pulse';

                                    $status_filter =
                                        'akan-datang';


                                    if ($menit < 1) {

                                        $status_text =
                                            'Sebentar Lagi';

                                    } else {

                                        $status_text =
                                            $menit . ' Menit Lagi';

                                    }

                                }


                                /*
                                 * > 1 JAM
                                 */

                                else {

                                    $row_class =
                                        'agenda-kuning';

                                    $badge_class =
                                        'bg-warning text-dark';

                                    $status_filter =
                                        'akan-datang';


                                    if ($selisih < 24 * 60 * 60) {

                                        $status_text =
                                            $jam . ' Jam Lagi';

                                    } else {

                                        $hari =
                                            floor(
                                                $selisih /
                                                (24 * 60 * 60)
                                            );


                                        if ($hari == 1) {

                                            $status_text =
                                                '1 Hari Lagi';

                                        } else {

                                            $status_text =
                                                $hari . ' Hari Lagi';

                                        }

                                    }

                                }

                            }

                            ?>


                            <!-- BARIS DATA -->

                            <tr
                                class="<?= $row_class ?> agenda-row"
                                data-bulan="<?= date('m', strtotime($item['tanggal'])) ?>"
                                data-status="<?= $status_filter ?>"
                                data-search="<?= strtolower(
                                    esc(
                                        $item['nama_kegiatan'] . ' ' .
                                        $item['tempat'] . ' ' .
                                        ($item['pejabat_narasumber'] ?? '') . ' ' .
                                        ($item['peserta'] ?? '') . ' ' .
                                        ($item['deskripsi'] ?? '')
                                    )
                                ) ?>"
                            >


                                <!-- NOMOR -->

                                <td class="ps-4 fw-semibold">

                                    <?= $no++ ?>

                                </td>


                                <!-- TANGGAL -->

                                <td>

                                    <div class="fw-semibold">

                                        <i class="bi bi-calendar3 me-1"></i>

                                        <?= date(
                                            'd-m-Y',
                                            strtotime($item['tanggal'])
                                        ) ?>

                                    </div>


                                    <?php if (!empty($item['tanggal_selesai'])) : ?>

                                        <small>

                                            s/d

                                            <?= date(
                                                'd-m-Y',
                                                strtotime($item['tanggal_selesai'])
                                            ) ?>

                                        </small>

                                    <?php endif; ?>


                                    <small class="d-block">

                                        <i class="bi bi-clock me-1"></i>

                                        <?= date(
                                            'H:i',
                                            strtotime($item['waktu'])
                                        ) ?>

                                        WIB

                                    </small>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <span
                                        class="badge rounded-pill px-3 py-2 <?= $badge_class ?>">

                                        <?php if ($status_text === 'Sedang Berlangsung') : ?>

                                            <i class="bi bi-play-fill me-1"></i>

                                        <?php elseif ($status_text === 'Selesai') : ?>

                                            <i class="bi bi-check-circle me-1"></i>

                                        <?php else : ?>

                                            <i class="bi bi-clock me-1"></i>

                                        <?php endif; ?>


                                        <?= $status_text ?>

                                    </span>

                                </td>


                                <!-- NAMA KEGIATAN -->

                                <td class="fw-semibold">

                                    <?= esc(
                                        $item['nama_kegiatan']
                                    ) ?>

                                </td>


                                <!-- TEMPAT -->

                                <td>

                                    <i class="bi bi-geo-alt me-1"></i>

                                    <?= esc(
                                        $item['tempat']
                                    ) ?>

                                </td>


                                <!-- NARASUMBER -->

                                <td>

                                    <?= !empty($item['pejabat_narasumber'])
                                        ? esc($item['pejabat_narasumber'])
                                        : '-' ?>

                                </td>


                                <!-- AKSI -->

                                <td class="text-end pe-4">


                                    <!-- EDIT -->

                                    <a
                                        href="<?= base_url(
                                            'admin/agenda/edit/' . $item['id']
                                        ) ?>"
                                        class="btn btn-aksi btn-edit"
                                        title="Edit Agenda">

                                        <i class="bi bi-pencil"></i>
                                        Edit

                                    </a>


                                    <!-- HAPUS -->

                                    <a
                                        href="<?= base_url(
                                            'admin/agenda/hapus/' . $item['id']
                                        ) ?>"
                                        class="btn btn-aksi btn-hapus"
                                        title="Hapus Agenda"
                                        onclick="return confirm('Yakin ingin menghapus agenda ini?')">

                                        <i class="bi bi-trash"></i>
                                        Hapus

                                    </a>


                                    <!-- DETAIL -->

                                    <a
                                        href="<?= base_url(
                                            'admin/agenda/detail/' . $item['id']
                                        ) ?>"
                                        class="btn btn-aksi btn-detail"
                                        title="Detail Agenda">

                                        <i class="bi bi-file-text"></i>
                                        Detail

                                    </a>

                                </td>

                            </tr>


                        <?php endforeach; ?>


                        <!-- TIDAK ADA HASIL FILTER -->

                        <tr
                            id="noResult"
                            class="no-result">

                            <td
                                colspan="7"
                                class="text-center py-5 text-muted">

                                <i
                                    class="bi bi-search fs-2 d-block mb-2">
                                </i>

                                Data agenda tidak ditemukan.

                            </td>

                        </tr>


                    <?php else : ?>

                        <tr>

                            <td
                                colspan="7"
                                class="text-center text-muted py-5">

                                <i
                                    class="bi bi-inbox fs-2 d-block mb-2">
                                </i>

                                Belum ada data agenda kegiatan.

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- ==========================================
     KETERANGAN WARNA
     ========================================== -->

<div class="legend-box mt-4">

    <div class="fw-bold mb-3">

        <i class="bi bi-info-circle text-primary me-1"></i>

        Keterangan Warna

    </div>


    <div class="d-flex flex-wrap gap-4">

        <div class="legend-item">

            <span
                class="legend-circle"
                style="background: #ff7b7b;">
            </span>

            Akan dimulai ≤ 1 jam lagi

        </div>


        <div class="legend-item">

            <span
                class="legend-circle"
                style="background: #ffd84d;">
            </span>

            Akan dimulai > 1 jam lagi

        </div>


        <div class="legend-item">

            <span
                class="legend-circle"
                style="background: #72e08b;">
            </span>

            Sedang berlangsung

        </div>


        <div class="legend-item">

            <span
                class="legend-circle"
                style="
                    background: #ffffff;
                    border: 1px solid #999;
                ">
            </span>

            Selesai

        </div>

    </div>

</div>


<!-- ==========================================
     MODAL TAMBAH AGENDA
     ========================================== -->

<div
    class="modal fade"
    id="modalAgenda"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content border-0 rounded-4 shadow">


            <!-- HEADER -->

            <div class="modal-header border-0 pb-0 pt-4 px-4">

                <div class="d-flex align-items-center gap-3">

                    <div class="modal-icon-box">

                        <i class="bi bi-calendar-event fs-4"></i>

                    </div>


                    <div>

                        <h5 class="modal-title fw-bold">

                            Tambah Agenda Baru

                        </h5>

                        <p class="text-muted small mb-0">

                            Masukkan informasi kegiatan Dinas Pendidikan

                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>


            <!-- FORM -->

            <form
                action="<?= base_url('admin/agenda/simpan') ?>"
                method="post"
                enctype="multipart/form-data">

                <?= csrf_field() ?>


                <div class="modal-body p-4">


                    <!-- TANGGAL -->

                    <div class="row g-3 mb-3">

                        <div class="col-md-6">

                            <label class="modal-label">
                                Tanggal Kegiatan
                            </label>

                            <input
                                type="date"
                                name="tanggal"
                                class="form-control"
                                required>

                        </div>


                        <div class="col-md-6">

                            <label class="modal-label">
                                Tanggal Selesai
                            </label>

                            <input
                                type="date"
                                name="tanggal_selesai"
                                class="form-control">

                        </div>

                    </div>


                    <!-- WAKTU -->

                    <div class="row g-3 mb-3">

                        <div class="col-md-6">

                            <label class="modal-label">
                                Waktu Kegiatan
                            </label>

                            <input
                                type="time"
                                name="waktu"
                                class="form-control"
                                required>

                        </div>


                        <div class="col-md-6">

                            <label class="modal-label">
                                Nama Kegiatan
                            </label>

                            <input
                                type="text"
                                name="nama_kegiatan"
                                class="form-control"
                                placeholder="Masukkan nama kegiatan"
                                required>

                        </div>

                    </div>


                    <!-- TEMPAT -->

                    <div class="mb-3">

                        <label class="modal-label">
                            Tempat Kegiatan
                        </label>

                        <input
                            type="text"
                            name="tempat"
                            class="form-control"
                            placeholder="Masukkan tempat kegiatan"
                            required>

                    </div>


                    <!-- NARASUMBER -->

                    <div class="mb-3">

                        <label class="modal-label">
                            Pejabat / Narasumber
                        </label>

                        <input
                            type="text"
                            name="pejabat_narasumber"
                            class="form-control"
                            placeholder="Masukkan pejabat atau narasumber">

                    </div>


                    <!-- PESERTA -->

                    <div class="mb-3">

                        <label class="modal-label">
                            Peserta
                        </label>

                        <textarea
                            name="peserta"
                            class="form-control"
                            rows="2"
                            placeholder="Masukkan jumlah peserta kegiatan"></textarea>

                    </div>


                    <!-- DESKRIPSI -->

                    <div class="mb-3">

                        <label class="modal-label">
                            Deskripsi Kegiatan
                        </label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            rows="3"
                            placeholder="Masukkan deskripsi kegiatan"></textarea>

                    </div>


                    <!-- DOKUMENTASI -->

                    <div class="mb-2">

                        <label class="modal-label">

                            <i class="bi bi-camera me-1 text-primary"></i>

                            Dokumentasi Kegiatan

                        </label>


                        <input
                            type="file"
                            name="dokumentasi[]"
                            id="dokumentasi"
                            class="form-control"
                            accept="image/jpeg,image/png,image/webp"
                            multiple>


                        <small class="text-muted d-block mt-2">

                            Pilih beberapa foto sekaligus.
                            Format JPG, PNG, atau WEBP,
                            Maksimal 5 foto.

                        </small>


                        <div
                            id="previewDokumentasi"
                            class="d-flex flex-wrap gap-2 mt-3">
                        </div>

                    </div>

                </div>


                <!-- FOOTER -->

                <div
                    class="modal-footer border-0 pt-0 pb-4 px-4">

                    <button
                        type="button"
                        class="btn btn-light px-4 rounded-3 border"
                        data-bs-dismiss="modal">

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary px-4 rounded-3">

                        <i class="bi bi-floppy me-1"></i>

                        Simpan Agenda

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<!-- ==========================================
     FILTER & PENCARIAN
     ========================================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        const filterBulan =
            document.getElementById(
                'filterBulan'
            );


        const filterStatus =
            document.getElementById(
                'filterStatus'
            );


        const searchAgenda =
            document.getElementById(
                'searchAgenda'
            );


        const btnResetFilter =
            document.getElementById(
                'btnResetFilter'
            );


        const rows =
            document.querySelectorAll(
                '.agenda-row'
            );


        const noResult =
            document.getElementById(
                'noResult'
            );


        /*
         * ==========================================
         * FUNGSI FILTER AGENDA
         * ==========================================
         */

        function filterAgenda()
        {

            const bulan =
                filterBulan.value;


            const status =
                filterStatus.value;


            const keyword =
                searchAgenda.value
                    .toLowerCase()
                    .trim();


            let jumlahTampil = 0;


            rows.forEach(
                function (row)
                {

                    const rowBulan =
                        row.dataset.bulan;


                    const rowStatus =
                        row.dataset.status;


                    const rowSearch =
                        row.dataset.search;


                    /*
                     * COCOK BULAN
                     */

                    const cocokBulan =
                        bulan === 'semua' ||
                        rowBulan === bulan;


                    /*
                     * COCOK STATUS
                     */

                    const cocokStatus =
                        status === 'semua' ||
                        rowStatus === status;


                    /*
                     * COCOK PENCARIAN
                     */

                    const cocokSearch =
                        keyword === '' ||
                        rowSearch.includes(
                            keyword
                        );


                    /*
                     * TAMPILKAN DATA
                     */

                    if (
                        cocokBulan &&
                        cocokStatus &&
                        cocokSearch
                    ) {

                        row.style.display =
                            '';

                        jumlahTampil++;

                    }

                    /*
                     * SEMBUNYIKAN DATA
                     */

                    else {

                        row.style.display =
                            'none';

                    }

                }
            );


            /*
             * PESAN DATA TIDAK DITEMUKAN
             */

            if (noResult) {

                if (jumlahTampil === 0) {

                    noResult.style.display =
                        'table-row';

                }

                else {

                    noResult.style.display =
                        'none';

                }

            }

        }


        /*
         * ==========================================
         * FILTER BULAN
         * ==========================================
         */

        filterBulan.addEventListener(
            'change',
            filterAgenda
        );


        /*
         * ==========================================
         * FILTER STATUS
         * ==========================================
         */

        filterStatus.addEventListener(
            'change',
            filterAgenda
        );


        /*
         * ==========================================
         * PENCARIAN
         * ==========================================
         */

        searchAgenda.addEventListener(
            'input',
            filterAgenda
        );


        /*
         * ==========================================
         * TOMBOL RESET
         * ==========================================
         */

        btnResetFilter.addEventListener(
            'click',
            function ()
            {

                /*
                 * Kembalikan bulan
                 */

                filterBulan.value =
                    'semua';


                /*
                 * Kembalikan status
                 */

                filterStatus.value =
                    'semua';


                /*
                 * Kosongkan pencarian
                 */

                searchAgenda.value =
                    '';


                /*
                 * Tampilkan kembali
                 * seluruh agenda
                 */

                filterAgenda();

            }
        );


        /*
         * Jalankan filter pertama kali
         */

        filterAgenda();

    }
);

</script>


<!-- ==========================================
     PREVIEW DOKUMENTASI
     ========================================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function ()
    {

        const input =
            document.getElementById(
                'dokumentasi'
            );


        const preview =
            document.getElementById(
                'previewDokumentasi'
            );


        if (
            !input ||
            !preview
        ) {

            return;

        }


        input.addEventListener(
            'change',
            function ()
            {

                preview.innerHTML =
                    '';


                const files =
                    Array.from(
                        this.files
                    );


                /*
                 * MAKSIMAL 5 FOTO
                 */

                if (
                    files.length > 5
                ) {

                    alert(
                        'Maksimal 5 foto dokumentasi.'
                    );


                    this.value =
                        '';


                    return;

                }


                files.forEach(
                    function (file)
                    {

                        /*
                         * CEK GAMBAR
                         */

                        if (
                            !file.type.startsWith(
                                'image/'
                            )
                        ) {

                            alert(
                                'File ' +
                                file.name +
                                ' bukan file gambar.'
                            );

                            return;

                        }


                        /*
                         * PREVIEW
                         */

                        const reader =
                            new FileReader();


                        reader.onload =
                            function (e)
                            {

                                const wrapper =
                                    document.createElement(
                                        'div'
                                    );


                                wrapper.style.width =
                                    '110px';

                                wrapper.style.height =
                                    '85px';

                                wrapper.style.borderRadius =
                                    '10px';

                                wrapper.style.overflow =
                                    'hidden';

                                wrapper.style.border =
                                    '1px solid #dbe3ee';


                                const img =
                                    document.createElement(
                                        'img'
                                    );


                                img.src =
                                    e.target.result;


                                img.style.width =
                                    '100%';

                                img.style.height =
                                    '100%';

                                img.style.objectFit =
                                    'cover';


                                wrapper.appendChild(
                                    img
                                );


                                preview.appendChild(
                                    wrapper
                                );

                            };


                        reader.readAsDataURL(
                            file
                        );

                    }
                );

            }
        );

    }
);

</script>


<?= $this->endSection() ?>