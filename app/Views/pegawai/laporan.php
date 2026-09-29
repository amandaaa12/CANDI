<?= $this->extend('pegawai/layout') ?>

<?= $this->section('content') ?>

<?php
date_default_timezone_set('Asia/Jakarta');

$agenda = $agenda ?? [];

$totalKegiatan = count($agenda);
$selesai = 0;
$akanDatangProses = 0;

foreach ($agenda as $item) {

    if (
        empty($item['tanggal']) ||
        empty($item['waktu'])
    ) {
        continue;
    }

    $waktuAcara = strtotime(
        $item['tanggal'] . ' ' . $item['waktu']
    );

    $selisih = $waktuAcara - time();

    if ($selisih > 0) {
        $akanDatangProses++;
    } elseif (abs($selisih) <= (3 * 60 * 60)) {
        $akanDatangProses++;
    } else {
        $selesai++;
    }
}
?>

<style>

/* =========================================================
   CARD UTAMA
========================================================= */

.laporan-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, .04);
    border: 1px solid #e2e8f0;
}


/* =========================================================
   STATISTIK
========================================================= */

.laporan-stat {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 18px;
    min-height: 105px;

    display: flex;
    align-items: center;
    justify-content: space-between;
}

.laporan-stat-label {
    color: #64748b;
    font-size: .85rem;
    margin-bottom: 5px;
}

.laporan-stat-number {
    font-size: 1.7rem;
    font-weight: 700;
    margin: 0;
}

.laporan-stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 1.3rem;
}

.icon-total {
    background: #2563eb;
    color: white;
}

.icon-selesai {
    background: #198754;
    color: white;
}

.icon-proses {
    background: #ffc107;
    color: #212529;
}


/* =========================================================
   JUDUL
========================================================= */

.laporan-heading h5 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 4px;
}

.laporan-heading p {
    color: #64748b;
    font-size: .85rem;
    margin-bottom: 0;
}


/* =========================================================
   FILTER + SEARCH
========================================================= */

.filter-area {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.filter-bulan {
    width: 170px;
    height: 38px;
    padding: 0 12px;
    border: 1px solid #b8d0ee;
    border-radius: 6px;
    background: #ffffff;
    color: #334155;
    font-size: 13px;
    outline: none;
}

.filter-bulan:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.10);
}


/* =========================================================
   SEARCH
========================================================= */

.search-box {
    position: relative;
    width: 280px;
}

.search-box i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    font-size: 15px;
    pointer-events: none;
}

.search-box input {
    width: 100%;
    height: 38px;
    padding: 0 12px 0 36px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    outline: none;
    font-size: 13px;
    box-sizing: border-box;
    color: #334155;
}

.search-box input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.12);
}

.search-box input::placeholder {
    color: #94a3b8;
}


/* =========================================================
   TABEL
========================================================= */

.table-laporan {
    font-size: .84rem;
    margin-bottom: 0;
}

.table-laporan thead th {
    background: #f1f5f9;
    color: #0f172a;
    font-weight: 700;
    padding: 12px;
    border-bottom: 2px solid #cbd5e1;
    white-space: nowrap;
}

.table-laporan tbody td {
    padding: 12px;
    vertical-align: middle;
    color: #334155;
}

.table-laporan tbody tr:hover {
    background: #f8fafc;
}


/* =========================================================
   TOMBOL AKSI
========================================================= */

.btn-lihat-laporan {
    background: #2563eb;
    color: white;
    border: none;

    padding: 7px 11px;
    border-radius: 7px;

    font-size: .78rem;
    font-weight: 600;

    text-decoration: none;

    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-lihat-laporan:hover {
    background: #1d4ed8;
    color: white;
}

.btn-cetak-laporan {
    background: #0f766e;
    color: white;
    border: none;

    padding: 7px 11px;
    border-radius: 7px;

    font-size: .78rem;
    font-weight: 600;

    text-decoration: none;

    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.btn-cetak-laporan:hover {
    background: #115e59;
    color: white;
}

.aksi-laporan {
    white-space: nowrap;
}


/* =========================================================
   PESAN HASIL PENCARIAN
========================================================= */

#pesanTidakAda {
    display: none;
    text-align: center;
    padding: 25px;
    color: #64748b;
    font-size: .9rem;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .filter-area {
        width: 100%;
    }

    .filter-bulan,
    .search-box {
        width: 100%;
    }

}


/* =========================================================
   PRINT
========================================================= */

@media print {

    .sidebar,
    .topbar,
    .filter-section,
    .no-print {
        display: none !important;
    }

    .main-wrapper {
        margin-left: 0 !important;
    }

    .content-container {
        padding: 0 !important;
    }

    .laporan-card {
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
    }

    body {
        background: white !important;
    }

}

</style>


<div class="laporan-card">

    <!-- =====================================================
         STATISTIK
    ====================================================== -->

    <div class="row g-3 mb-4">

        <!-- TOTAL KEGIATAN -->

        <div class="col-md-4">

            <div class="laporan-stat">

                <div>

                    <div class="laporan-stat-label">
                        Total Kegiatan
                    </div>

                    <h4 class="laporan-stat-number text-primary">
                        <?= $totalKegiatan ?>
                    </h4>

                </div>

                <div class="laporan-stat-icon icon-total">

                    <i class="bi bi-journal-text"></i>

                </div>

            </div>

        </div>


        <!-- SELESAI -->

        <div class="col-md-4">

            <div class="laporan-stat">

                <div>

                    <div class="laporan-stat-label">
                        Selesai
                    </div>

                    <h4 class="laporan-stat-number text-success">
                        <?= $selesai ?>
                    </h4>

                </div>

                <div class="laporan-stat-icon icon-selesai">

                    <i class="bi bi-check-circle"></i>

                </div>

            </div>

        </div>


        <!-- AKAN DATANG / PROSES -->

        <div class="col-md-4">

            <div class="laporan-stat">

                <div>

                    <div class="laporan-stat-label">
                        Akan Datang / Proses
                    </div>

                    <h4 class="laporan-stat-number text-warning">
                        <?= $akanDatangProses ?>
                    </h4>

                </div>

                <div class="laporan-stat-icon icon-proses">

                    <i class="bi bi-clock-history"></i>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         JUDUL + FILTER + SEARCH
    ====================================================== -->

    <div
        class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3 filter-section"
    >

        <div class="laporan-heading">

            <h5>
                Rekapitulasi Data Agenda
            </h5>

            <p>
                Daftar kegiatan yang ditambahkan oleh akun Anda.
            </p>

        </div>


        <div class="filter-area">

            <!-- FILTER BULAN -->

            <select
                id="filterBulanLaporan"
                class="filter-bulan"
            >

                <option value="">
                    -- Semua Bulan --
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


            <!-- SEARCH -->

            <div class="search-box">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="searchAgenda"
                    placeholder="Cari kegiatan..."
                    autocomplete="off"
                >

            </div>

        </div>

    </div>


    <!-- =====================================================
         TABEL
    ====================================================== -->

    <div class="table-responsive">

        <table
            class="table table-bordered align-middle table-laporan"
            id="tabelLaporan"
        >

            <thead>

                <tr>

                    <th
                        style="width:5%; text-align:center;"
                    >
                        No
                    </th>

                    <th style="width:20%;">
                        Nama Kegiatan
                    </th>

                    <th style="width:14%;">
                        Tanggal
                    </th>

                    <th style="width:12%;">
                        Waktu
                    </th>

                    <th style="width:15%;">
                        Tempat
                    </th>

                    <th style="width:13%;">
                        Narasumber
                    </th>

                    <th style="width:8%;">
                        Peserta
                    </th>

                    <th
                        style="width:18%; text-align:center;"
                    >
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody id="tabelLaporanBody">

                <?php if (!empty($agenda)): ?>

                    <?php foreach ($agenda as $item): ?>

                        <tr
                            data-tanggal="<?= esc($item['tanggal'] ?? '') ?>"
                        >

                            <!-- NOMOR -->

                            <td
                                class="text-center nomor-baris"
                            >
                                -
                            </td>


                            <!-- NAMA KEGIATAN -->

                            <td class="fw-bold">

                                <?= esc(
                                    $item['nama_kegiatan'] ?? '-'
                                ) ?>

                            </td>


                            <!-- TANGGAL -->

                            <td>

                                <?php if (!empty($item['tanggal'])): ?>

                                    <?= date(
                                        'd-m-Y',
                                        strtotime($item['tanggal'])
                                    ) ?>

                                    <?php if (
                                        !empty($item['tanggal_selesai']) &&
                                        $item['tanggal_selesai'] != $item['tanggal']
                                    ): ?>

                                        <br>

                                        <small class="text-muted">

                                            s/d

                                            <?= date(
                                                'd-m-Y',
                                                strtotime($item['tanggal_selesai'])
                                            ) ?>

                                        </small>

                                    <?php endif; ?>

                                <?php else: ?>

                                    -

                                <?php endif; ?>

                            </td>


                            <!-- WAKTU -->

                            <td>

                                <?php if (!empty($item['waktu'])): ?>

                                    <?= date(
                                        'H:i',
                                        strtotime($item['waktu'])
                                    ) ?>

                                    WIB

                                <?php else: ?>

                                    -

                                <?php endif; ?>

                            </td>


                            <!-- TEMPAT -->

                            <td>

                                <?= esc(
                                    $item['tempat'] ?? '-'
                                ) ?>

                            </td>


                            <!-- NARASUMBER -->

                            <td>

                                <?= esc(
                                    $item['pejabat_narasumber'] ?? '-'
                                ) ?>

                            </td>


                            <!-- PESERTA -->

                            <td>

                                <?= esc(
                                    $item['peserta'] ?? '-'
                                ) ?>

                            </td>


                            <!-- AKSI -->

                            <td
                                class="aksi-laporan text-center"
                            >

                                <!-- LIHAT -->

                                <a
                                    href="<?= base_url(
                                        'pegawai/laporan/cetak/' .
                                        (int) $item['id']
                                    ) ?>"
                                    target="_blank"
                                    class="btn-lihat-laporan"
                                >

                                    <i class="bi bi-eye"></i>

                                    Lihat

                                </a>


                                <!-- CETAK -->

                                <a
                                    href="<?= base_url(
                                        'pegawai/laporan/cetak/' .
                                        (int) $item['id']
                                    ) ?>"
                                    target="_blank"
                                    class="btn-cetak-laporan"
                                >

                                    <i class="bi bi-printer"></i>

                                    Cetak

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr id="barisKosong">

                        <td
                            colspan="8"
                            class="text-center text-muted py-4"
                        >

                            Belum ada data agenda.

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>


        <!-- PESAN PENCARIAN -->

        <div id="pesanTidakAda">

            <i
                class="bi bi-search"
                style="font-size: 25px;"
            ></i>

            <div class="mt-2">

                Data yang dicari tidak ditemukan.

            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const searchInput =
            document.getElementById(
                'searchAgenda'
            );

        const filterBulan =
            document.getElementById(
                'filterBulanLaporan'
            );

        const rows =
            document.querySelectorAll(
                '#tabelLaporanBody tr:not(#barisKosong)'
            );

        const pesanTidakAda =
            document.getElementById(
                'pesanTidakAda'
            );


        function filterData() {

            const kataKunci =
                searchInput.value
                    .toLowerCase()
                    .trim();

            const bulanDipilih =
                filterBulan.value;

            let jumlahTampil = 0;


            rows.forEach(
                function (row) {

                    const tanggal =
                        row.getAttribute(
                            'data-tanggal'
                        );


                    /*
                     * Ambil semua isi baris.
                     *
                     * Pencarian dapat dilakukan
                     * berdasarkan:
                     *
                     * - nama kegiatan
                     * - tanggal
                     * - waktu
                     * - tempat
                     * - narasumber
                     * - peserta
                     */

                    const isiBaris =
                        row.textContent
                            .toLowerCase()
                            .trim();


                    /* CEK SEARCH */

                    const cocokSearch =
                        kataKunci === '' ||
                        isiBaris.includes(
                            kataKunci
                        );


                    /* CEK BULAN */

                    let cocokBulan = true;


                    if (bulanDipilih !== '') {

                        if (tanggal) {

                            const bagianTanggal =
                                tanggal.split('-');

                            const bulanBaris =
                                bagianTanggal[1];

                            cocokBulan =
                                bulanBaris ===
                                bulanDipilih;

                        } else {

                            cocokBulan = false;

                        }

                    }


                    /* TAMPILKAN / SEMBUNYIKAN */

                    if (
                        cocokSearch &&
                        cocokBulan
                    ) {

                        row.style.display = '';

                        jumlahTampil++;

                    } else {

                        row.style.display =
                            'none';

                    }

                }
            );


            /* NOMOR OTOMATIS */

            let nomor = 1;


            rows.forEach(
                function (row) {

                    if (
                        row.style.display !==
                        'none'
                    ) {

                        const nomorCell =
                            row.querySelector(
                                '.nomor-baris'
                            );

                        if (nomorCell) {

                            nomorCell.textContent =
                                nomor++;

                        }

                    }

                }
            );


            /* PESAN TIDAK DITEMUKAN */

            if (
                jumlahTampil === 0 &&
                rows.length > 0
            ) {

                pesanTidakAda.style.display =
                    'block';

            } else {

                pesanTidakAda.style.display =
                    'none';

            }

        }


        /* KETIKA MENGETIK */

        searchInput.addEventListener(
            'input',
            filterData
        );


        /* KETIKA GANTI BULAN */

        filterBulan.addEventListener(
            'change',
            filterData
        );


        /* JALANKAN SAAT HALAMAN DIBUKA */

        filterData();

    }
);

</script>


<?= $this->endSection() ?>