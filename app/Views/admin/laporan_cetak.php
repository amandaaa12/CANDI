<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php
date_default_timezone_set('Asia/Jakarta');

$namaKegiatan = $agenda['nama_kegiatan'] ?? '-';
$tanggalMulai = $agenda['tanggal'] ?? null;
$tanggalSelesai = $agenda['tanggal_selesai'] ?? null;
$waktu = $agenda['waktu'] ?? null;
$tempat = $agenda['tempat'] ?? '-';
$narasumber = $agenda['pejabat_narasumber'] ?? '-';
$peserta = $agenda['peserta'] ?? '-';
$deskripsi = $agenda['deskripsi'] ?? '-';

$dokumentasi = $dokumentasi ?? [];


/* =========================================================
   FORMAT TANGGAL INDONESIA
========================================================= */

function formatTanggalIndonesia($tanggal)
{
    if (!$tanggal) {
        return '-';
    }

    $bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    $timestamp = strtotime($tanggal);

    return date('d', $timestamp) . ' ' .
        $bulan[(int) date('m', $timestamp)] . ' ' .
        date('Y', $timestamp);
}


/* =========================================================
   TANGGAL KEGIATAN
========================================================= */

if ($tanggalMulai) {

    if (
        $tanggalSelesai &&
        $tanggalSelesai != $tanggalMulai
    ) {

        $tanggalKegiatan =
            formatTanggalIndonesia($tanggalMulai)
            . ' s/d '
            . formatTanggalIndonesia($tanggalSelesai);

    } else {

        $tanggalKegiatan =
            formatTanggalIndonesia($tanggalMulai);
    }

} else {

    $tanggalKegiatan = '-';
}


/* =========================================================
   WAKTU
========================================================= */

$waktuKegiatan = '-';

if ($waktu) {

    $waktuKegiatan =
        date('H:i', strtotime($waktu)) . ' WIB';

}


/* =========================================================
   TANGGAL CETAK
   Mengikuti tanggal saat laporan dibuka/dicetak
========================================================= */

$tanggalCetak = formatTanggalIndonesia(
    date('Y-m-d')
);

?>

<style>

/* =========================================================
   AREA LAPORAN
========================================================= */

.laporan-wrapper {

    background: #e9eef5;

    padding: 25px;

}


/* =========================================================
   KERTAS A4
========================================================= */

.laporan-page {

    width: 210mm;

    height: 297mm;

    margin: 0 auto;

    background: white;

    position: relative;

    box-sizing: border-box;

    padding: 14mm 15mm 18mm;

    overflow: hidden;

    box-shadow: 0 4px 18px rgba(0,0,0,.12);

}


/* =========================================================
   HEADER
========================================================= */

.laporan-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    height: 72px;

}


/* LOGO DINAS */

.logo-dindik {

    width: 150px;

    height: 65px;

    object-fit: contain;

    object-position: left center;

}


/* LOGO CANDI */

.logo-candi {

    width: 145px;

    height: 65px;

    object-fit: contain;

    object-position: right center;

}


/* =========================================================
   GARIS HEADER
========================================================= */

.header-line {

    width: 100%;

    height: 4px;

    margin-top: 8px;

    margin-bottom: 20px;

    background: linear-gradient(
        90deg,
        #075db5,
        #1689df,
        #b9def7
    );

    border-radius: 5px;

}


/* =========================================================
   JUDUL
========================================================= */

.judul {

    text-align: center;

    margin-bottom: 18px;

}


.judul h1 {

    margin: 0;

    color: #123b75;

    font-size: 25px;

    font-weight: 800;

    letter-spacing: .5px;

}


.judul h2 {

    margin: 4px 0 8px;

    color: #123b75;

    font-size: 14px;

    font-weight: 700;

}


.judul-garis {

    width: 55px;

    height: 3px;

    background: #1476ca;

    margin: auto;

    border-radius: 5px;

}


/* =========================================================
   JUDUL BAGIAN
========================================================= */

.section-title {

    display: flex;

    align-items: center;

    gap: 8px;

    background: #e7f3fc;

    border: 1px solid #c5ddf2;

    border-radius: 6px 6px 0 0;

    padding: 6px 9px;

    color: #123b75;

    font-size: 12px;

    font-weight: 700;

}


.section-number {

    width: 23px;

    height: 23px;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #0875d1;

    color: white;

    border-radius: 5px;

    font-size: 11px;

}


/* =========================================================
   TABEL INFORMASI
========================================================= */

.info-table {

    width: 100%;

    border-collapse: collapse;

    border: 1px solid #d3e1ed;

    border-top: none;

    font-size: 10.5px;

}


.info-table td {

    padding: 6px 8px;

    border-bottom: 1px solid #dbe6ef;

    vertical-align: top;

}


.info-table tr:last-child td {

    border-bottom: none;

}


.info-label {

    width: 22%;

    background: #f5faff;

    color: #123b75;

    font-weight: 700;

}


.info-colon {

    width: 3%;

    text-align: center;

    font-weight: 700;

    color: #123b75;

}


.info-value {

    color: #263b55;

}


/* =========================================================
   DESKRIPSI
========================================================= */

.deskripsi-box {

    border: 1px solid #d3e1ed;

    border-top: none;

    padding: 9px 11px;

    min-height: 55px;

    font-size: 10.5px;

    line-height: 1.5;

    color: #263b55;

    text-align: justify;

}


/* =========================================================
   DOKUMENTASI
========================================================= */

.dokumentasi-box {

    border: 1px solid #d3e1ed;

    border-top: none;

    padding: 8px;

}


/*
   SEMUA FOTO UKURAN SAMA
*/

.dokumentasi-grid {

    display: grid;

    grid-template-columns: repeat(5, 1fr);

    gap: 7px;

}


.dokumentasi-foto {

    width: 100%;

    height: 100px;

    object-fit: cover;

    border-radius: 5px;

    border: 1px solid #d2dce6;

    display: block;

}


/* =========================================================
   PLACEHOLDER FOTO
========================================================= */

.no-foto {

    width: 100%;

    height: 100px;

    display: flex;

    align-items: center;

    justify-content: center;

    border: 1px dashed #cbd5e1;

    background: #f8fafc;

    color: #7b8794;

    border-radius: 5px;

    font-size: 10px;

}


/* =========================================================
   TANDA TANGAN
========================================================= */

.tanda-tangan {

    width: 48%;

    margin-left: auto;

    margin-top: 20px;

    text-align: center;

    color: #263b55;

    font-size: 10.5px;

}


.ttd-space {

    height: 58px;

}


.nama-kepala {

    font-weight: 700;

    text-decoration: underline;

}


.nip-kepala {

    margin-top: 2px;

}


/* =========================================================
   FOOTER
========================================================= */

.footer {

    position: absolute;

    bottom: 0;

    left: 0;

    right: 0;

    height: 12mm;

    background: #0874d1;

    color: white;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 0 15mm;

    box-sizing: border-box;

    font-size: 8px;

}


/* =========================================================
   TOMBOL CETAK
========================================================= */

.tombol-cetak {

    position: fixed;

    right: 25px;

    top: 20px;

    z-index: 9999;

}


/* =========================================================
   PRINT
========================================================= */

@media print {

    @page {

        size: A4;

        margin: 0;

    }


    html,
    body {

        width: 210mm;

        height: 297mm;

        margin: 0;

        padding: 0;

        background: white !important;

    }


    .sidebar,
    .topbar,
    .tombol-cetak,
    .no-print {

        display: none !important;

    }


    .main-wrapper {

        margin-left: 0 !important;

    }


    .content-container {

        padding: 0 !important;

    }


    .laporan-wrapper {

        padding: 0 !important;

        margin: 0 !important;

        background: white !important;

    }


    .laporan-page {

        width: 210mm;

        height: 297mm;

        margin: 0;

        box-shadow: none;

        page-break-after: auto;

    }

}

</style>


<!-- =========================================================
     TOMBOL CETAK
========================================================= -->

<div class="tombol-cetak no-print">

    <button
        type="button"
        onclick="window.print()"
        class="btn btn-primary shadow"
    >

        <i class="bi bi-printer"></i>

        Cetak Laporan

    </button>

</div>


<!-- =========================================================
     LAPORAN
========================================================= -->

<div class="laporan-wrapper">


<div class="laporan-page">


    <!-- =====================================================
         HEADER LOGO
    ====================================================== -->

    <div class="laporan-header">


        <!-- LOGO DINAS -->

        <img
            src="<?= base_url('assets/logo dindik.png') ?>"
            class="logo-dindik"
            alt="Logo Dinas Pendidikan"
        >


        <!-- LOGO CANDI -->

        <img
            src="<?= base_url('assets/CANDI.png') ?>"
            class="logo-candi"
            alt="Logo CANDI"
        >


    </div>


    <div class="header-line"></div>


    <!-- =====================================================
         JUDUL
    ====================================================== -->

    <div class="judul">

        <h1>
            LAPORAN KEGIATAN
        </h1>

        <h2>
            DINAS PENDIDIKAN KOTA KEDIRI
        </h2>

        <div class="judul-garis"></div>

    </div>


    <!-- =====================================================
         1. INFORMASI KEGIATAN
    ====================================================== -->

    <div class="section-title">

        <div class="section-number">
            1
        </div>

        Informasi Kegiatan

    </div>


    <table class="info-table">


        <tr>

            <td class="info-label">
                Nama Kegiatan
            </td>

            <td class="info-colon">
                :
            </td>

            <td class="info-value">
                <?= esc($namaKegiatan) ?>
            </td>

        </tr>


        <tr>

            <td class="info-label">
                Tanggal
            </td>

            <td class="info-colon">
                :
            </td>

            <td class="info-value">
                <?= esc($tanggalKegiatan) ?>
            </td>

        </tr>


        <tr>

            <td class="info-label">
                Waktu
            </td>

            <td class="info-colon">
                :
            </td>

            <td class="info-value">
                <?= esc($waktuKegiatan) ?>
            </td>

        </tr>


        <tr>

            <td class="info-label">
                Tempat
            </td>

            <td class="info-colon">
                :
            </td>

            <td class="info-value">
                <?= esc($tempat) ?>
            </td>

        </tr>


        <tr>

            <td class="info-label">
                Narasumber
            </td>

            <td class="info-colon">
                :
            </td>

            <td class="info-value">
                <?= esc($narasumber) ?>
            </td>

        </tr>


        <tr>

            <td class="info-label">
                Peserta
            </td>

            <td class="info-colon">
                :
            </td>

            <td class="info-value">
                <?= nl2br(esc($peserta)) ?>
            </td>

        </tr>


    </table>


    <br>


    <!-- =====================================================
         2. DESKRIPSI
    ====================================================== -->

    <div class="section-title">

        <div class="section-number">
            2
        </div>

        Deskripsi Kegiatan

    </div>


    <div class="deskripsi-box">

        <?= nl2br(esc($deskripsi)) ?>

    </div>


    <br>


    <!-- =====================================================
         3. DOKUMENTASI
    ====================================================== -->

    <div class="section-title">

        <div class="section-number">
            3
        </div>

        Dokumentasi Kegiatan

    </div>


    <div class="dokumentasi-box">


        <?php if (!empty($dokumentasi)): ?>


            <div class="dokumentasi-grid">


                <?php foreach (
                    array_slice($dokumentasi, 0, 5)
                    as $foto
                ): ?>


                    <img
                        src="<?= base_url(
                            'uploads/dokumentasi/' .
                            $foto['nama_file']
                        ) ?>"
                        class="dokumentasi-foto"
                        alt="Dokumentasi kegiatan"
                    >


                <?php endforeach; ?>


            </div>


        <?php else: ?>


            <div class="no-foto">

                Belum ada dokumentasi kegiatan.

            </div>


        <?php endif; ?>


    </div>


    <!-- =====================================================
         TANDA TANGAN
    ====================================================== -->

    <div class="tanda-tangan">


        Kediri, <?= esc($tanggalCetak) ?>


        <br>


        Kepala Dinas Pendidikan Kota Kediri


        <div class="ttd-space"></div>


        <div class="nama-kepala">

            Drs. Mandung Sulaksono

        </div>


        <div class="nip-kepala">

            NIP : 196701021986021003

        </div>


    </div>


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <div class="footer">

        <span>
            Dinas Pendidikan Kota Kediri
        </span>

        <span>
            CANDI — Catatan Notulensi dan Dokumentasi
        </span>

        <span>
            Pendidikan Berkualitas Untuk Generasi Unggul
        </span>

    </div>


</div>

</div>


<?= $this->endSection() ?>