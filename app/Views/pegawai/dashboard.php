<?= $this->extend('pegawai/layout') ?>

<?= $this->section('content') ?>

<?php

date_default_timezone_set('Asia/Jakarta');

$sekarang = time();

/* =========================================================
   DATA AGENDA
   ========================================================= */

$agenda = $agenda ?? [];

$totalAgenda = count($agenda);

$akanDatang = 0;
$sedangBerlangsung = 0;
$selesai = 0;

$agendaMendatang = [];


/* =========================================================
   HITUNG STATUS AGENDA
   ========================================================= */

foreach ($agenda as $item) {

    $waktuAcara = strtotime(
        $item['tanggal'] . ' ' . $item['waktu']
    );

    $selisih = $waktuAcara - $sekarang;

    if ($selisih > 0) {

        $akanDatang++;

        $agendaMendatang[] = $item;

    } elseif (abs($selisih) <= (3 * 60 * 60)) {

        $sedangBerlangsung++;

    } else {

        $selesai++;
    }
}


/* =========================================================
   URUTKAN AGENDA MENDATANG
   ========================================================= */

usort($agendaMendatang, function ($a, $b) {

    $tanggalA = strtotime(
        $a['tanggal'] . ' ' . $a['waktu']
    );

    $tanggalB = strtotime(
        $b['tanggal'] . ' ' . $b['waktu']
    );

    return $tanggalA <=> $tanggalB;
});


$agendaMendatang = array_slice(
    $agendaMendatang,
    0,
    4
);


/* =========================================================
   NAMA BULAN
   ========================================================= */

$bulanNama = [
    1  => 'Jan',
    2  => 'Feb',
    3  => 'Mar',
    4  => 'Apr',
    5  => 'Mei',
    6  => 'Jun',
    7  => 'Jul',
    8  => 'Agu',
    9  => 'Sep',
    10 => 'Okt',
    11 => 'Nov',
    12 => 'Des'
];


/* =========================================================
   STATISTIK BULANAN
   ========================================================= */

$statistikBulan = array_fill(
    1,
    12,
    0
);

foreach ($agenda as $item) {

    $bulan = (int) date(
        'n',
        strtotime($item['tanggal'])
    );

    $statistikBulan[$bulan]++;
}

$nilaiMaksimal = max(
    1,
    max($statistikBulan)
);


/* =========================================================
   USER
   ========================================================= */

$namaUser = session()->get('nama') ?? 'Pengguna';

?>

<style>

/* =========================================================
   DASHBOARD
========================================================= */

.dashboard-page {
    padding-bottom: 35px;
}


/* =========================================================
   WELCOME
========================================================= */

.welcome-section {
    position: relative;

    min-height: 180px;

    padding: 28px 34px;

    border-radius: 18px;

    background: linear-gradient(
        135deg,
        #eef6ff 0%,
        #f8fbff 55%,
        #e7f3ff 100%
    );

    overflow: hidden;

    margin-bottom: 22px;
}


.welcome-title {
    color: #102a56;

    font-size: 2rem;

    font-weight: 700;

    margin-bottom: 7px;
}


.welcome-text {
    color: #587092;

    font-size: 0.95rem;

    margin-bottom: 0;
}


/* =========================================================
   LOGO CANDI
========================================================= */

.welcome-decoration {
    position: absolute;

    right: 45px;

    top: 50%;

    transform: translateY(-50%);

    width: 120px;

    height: 120px;

    display: flex;

    align-items: center;

    justify-content: center;

    opacity: 0.9;
}


.welcome-decoration img {
    width: 110px;

    height: 110px;

    object-fit: contain;

    display: block;
}


/* =========================================================
   STAT CARD
========================================================= */

.stat-card {
    border: none;

    border-radius: 16px;

    padding: 20px;

    min-height: 125px;

    display: flex;

    align-items: center;

    gap: 16px;

    position: relative;

    overflow: hidden;

    cursor: pointer;

    box-shadow:
        0 5px 18px rgba(15, 42, 86, 0.08);

    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease;
}


.stat-card:hover {

    transform: translateY(-5px);

    box-shadow:
        0 12px 25px rgba(15, 42, 86, 0.14);
}


.stat-card-link {
    display: block;
    text-decoration: none;
    color: inherit;
}


.stat-card-link:hover {
    color: inherit;
}


/* =========================================================
   SPARKLE
========================================================= */

.stat-card::after {

    content: "✦";

    position: absolute;

    top: 10px;

    right: 15px;

    font-size: 18px;

    font-weight: bold;

    opacity: 0;

    transform:
        scale(0)
        rotate(-30deg);

    pointer-events: none;
}


.stat-card.active::after {

    opacity: 1;

    color: #ffffff;

    animation:
        sparklePop 0.55s ease forwards;
}


.stat-card::before {

    content: "✦";

    position: absolute;

    top: 30px;

    right: 38px;

    font-size: 10px;

    opacity: 0;

    transform: scale(0);

    pointer-events: none;
}


.stat-card.active::before {

    opacity: 0.9;

    color: #ffffff;

    animation:
        sparkleSmall 0.65s ease forwards;
}


@keyframes sparklePop {

    0% {
        opacity: 0;
        transform:
            scale(0)
            rotate(-30deg);
    }

    40% {
        opacity: 1;
        transform:
            scale(1.6)
            rotate(15deg);
    }

    70% {
        opacity: 1;
        transform:
            scale(1.1)
            rotate(5deg);
    }

    100% {
        opacity: 1;
        transform:
            scale(1.2)
            rotate(10deg);
    }
}


@keyframes sparkleSmall {

    0% {
        opacity: 0;
        transform:
            scale(0)
            translateY(5px);
    }

    50% {
        opacity: 1;
        transform:
            scale(1.4)
            translateY(-2px);
    }

    100% {
        opacity: 0.8;
        transform:
            scale(1)
            translateY(0);
    }
}


/* =========================================================
   ICON
========================================================= */

.stat-icon {

    width: 54px;

    height: 54px;

    min-width: 54px;

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 1.4rem;

    transition:
        transform 0.25s ease;
}


.stat-card:hover .stat-icon {

    transform:
        scale(1.08);
}


/* =========================================================
   TEKS
========================================================= */

.stat-title {

    color: #294b78;

    font-size: 0.82rem;

    font-weight: 700;

    margin-bottom: 5px;
}


.stat-number {

    color: #0b2f63;

    font-size: 1.8rem;

    font-weight: 800;

    line-height: 1.1;
}


.stat-description {

    color: #657c9d;

    font-size: 0.72rem;

    margin-top: 5px;
}


/* =========================================================
   WARNA STATISTIK
========================================================= */

.stat-blue {
    background: #e4f0ff;
}


.stat-blue .stat-icon {

    background: #c8e1ff;

    color: #0969e8;
}


.stat-green {
    background: #fff0a8;
}


.stat-green .stat-icon {

    background: #ffd84d;

    color: #956900;
}


.stat-yellow {
    background: #bdf3cf;
}


.stat-yellow .stat-icon {

    background: #65d98b;

    color: #08752f;
}


.stat-purple {
    background: #eee7ff;
}


.stat-purple .stat-icon {

    background: #d9caff;

    color: #7146e8;
}


/* =========================================================
   CONTENT CARD
========================================================= */

.dashboard-card {

    background: #ffffff;

    border: none;

    border-radius: 17px;

    box-shadow:
        0 5px 20px rgba(15, 42, 86, 0.06);

    overflow: hidden;
}


.dashboard-card-header {

    padding: 18px 20px 12px;

    display: flex;

    align-items: center;

    justify-content: space-between;
}


.dashboard-card-title {

    color: #102a56;

    font-size: 0.98rem;

    font-weight: 700;

    margin: 0;
}


.dashboard-card-title i {

    color: #0d6efd;

    margin-right: 7px;
}


.dashboard-link {

    color: #0d6efd;

    font-size: 0.76rem;

    text-decoration: none;
}


.dashboard-link:hover {

    text-decoration: underline;
}


/* =========================================================
   AGENDA MENDATANG
========================================================= */

.upcoming-list {

    padding: 0 20px 15px;
}


.upcoming-item {

    display: flex;

    align-items: center;

    gap: 14px;

    padding: 12px 0;

    border-bottom:
        1px solid #edf1f6;
}


.upcoming-item:last-child {

    border-bottom: none;
}


/* =========================================================
   TANGGAL
========================================================= */

.date-box {

    width: 64px;

    min-width: 64px;

    height: 58px;

    background: #eef5ff;

    border-radius: 10px;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;
}


.date-number {

    color: #12356b;

    font-size: 1.15rem;

    font-weight: 700;

    line-height: 1;
}


.date-month {

    color: #6b83a5;

    font-size: 0.58rem;

    font-weight: 600;

    margin-top: 3px;
}


/* =========================================================
   INFO AGENDA
========================================================= */

.upcoming-info {

    flex: 1;

    min-width: 0;
}


.upcoming-name {

    color: #102a56;

    font-size: 0.82rem;

    font-weight: 700;

    margin-bottom: 5px;
}


.upcoming-meta {

    color: #71819a;

    font-size: 0.68rem;
}


.upcoming-meta i {

    color: #0d6efd;

    margin-right: 3px;
}


/* =========================================================
   STATUS
========================================================= */

.status-upcoming {

    background: #e6f1ff;

    color: #0d6efd;

    border-radius: 8px;

    padding: 6px 10px;

    font-size: 0.65rem;

    font-weight: 600;

    white-space: nowrap;
}


/* =========================================================
   GRAFIK
========================================================= */

.chart-wrapper {

    padding: 10px 20px 20px;
}


.chart {

    height: 210px;

    display: flex;

    align-items: flex-end;

    gap: 9px;

    border-bottom:
        1px solid #dfe6ef;

    padding: 15px 5px 0;
}


.chart-column {

    flex: 1;

    height: 100%;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: flex-end;
}


.chart-bar {

    width: 100%;

    max-width: 28px;

    background: #dbeaff;

    border-radius:
        6px 6px 0 0;

    min-height: 5px;

    transition:
        height 0.3s ease;
}


.chart-bar.current {

    background: #0d6efd;
}


.chart-value {

    color: #0d6efd;

    font-size: 0.65rem;

    font-weight: 700;

    margin-bottom: 4px;
}


.chart-label {

    color: #70809a;

    font-size: 0.62rem;

    margin-top: 7px;
}


/* =========================================================
   MINI STAT
========================================================= */

.mini-stat {

    border-radius: 10px;

    padding: 11px;

    text-align: center;

    background: #f8fafc;
}


.mini-stat-label {

    color: #71819a;

    font-size: 0.62rem;
}


.mini-stat-number {

    color: #102a56;

    font-size: 0.95rem;

    font-weight: 700;

    margin-top: 3px;
}


/* =========================================================
   EMPTY
========================================================= */

.empty-dashboard {

    text-align: center;

    padding: 35px 15px;

    color: #8291a7;
}


.empty-dashboard i {

    font-size: 2rem;

    color: #b8c6d9;

    display: block;

    margin-bottom: 8px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .welcome-title {
        font-size: 1.45rem;
    }

    .welcome-section {
        padding: 24px;
    }

    .welcome-decoration {
        right: 15px;
        width: 80px;
        height: 80px;
    }

    .welcome-decoration img {
        width: 75px;
        height: 75px;
    }

    .upcoming-item {
        align-items: flex-start;
    }

    .status-upcoming {
        display: none;
    }

}

</style>


<!-- =========================================================
     DASHBOARD
========================================================= -->

<div class="dashboard-page">


    <!-- WELCOME -->

    <div class="welcome-section">

        <h1 class="welcome-title">

            Selamat Datang, <?= esc($namaUser) ?> 👋

        </h1>

        <p class="welcome-text">

            Kelola agenda kegiatan, dokumentasi, dan notulensi
            Dinas Pendidikan Kota Kediri.

        </p>


        <div class="welcome-decoration">

            <img
                src="<?= base_url('assets/CANDI.png') ?>"
                alt="Logo CANDI"
            >

        </div>

    </div>


    <!-- =====================================================
         STATISTIK
    ===================================================== -->

    <div class="row g-3 mb-4">


        <!-- TOTAL AGENDA -->

        <div class="col-xl-3 col-md-6">

            <a
                href="<?= base_url('pegawai/agenda') ?>"
                class="stat-card-link"
            >

                <div class="stat-card stat-blue">

                    <div class="stat-icon">

                        <i class="bi bi-calendar3"></i>

                    </div>


                    <div>

                        <div class="stat-title">
                            Total Agenda
                        </div>

                        <div class="stat-number">
                            <?= $totalAgenda ?>
                        </div>

                        <div class="stat-description">
                            Semua agenda tersimpan
                        </div>

                    </div>

                </div>

            </a>

        </div>


        <!-- AKAN DATANG -->

        <div class="col-xl-3 col-md-6">

            <div class="stat-card stat-green">

                <div class="stat-icon">

                    <i class="bi bi-play-fill"></i>

                </div>


                <div>

                    <div class="stat-title">
                        Akan Datang
                    </div>

                    <div class="stat-number">
                        <?= $akanDatang ?>
                    </div>

                    <div class="stat-description">
                        Agenda yang belum dimulai
                    </div>

                </div>

            </div>

        </div>


        <!-- SEDANG BERLANGSUNG -->

        <div class="col-xl-3 col-md-6">

            <div class="stat-card stat-yellow">

                <div class="stat-icon">

                    <i class="bi bi-clock"></i>

                </div>


                <div>

                    <div class="stat-title">
                        Sedang Berlangsung
                    </div>

                    <div class="stat-number">
                        <?= $sedangBerlangsung ?>
                    </div>

                    <div class="stat-description">
                        Agenda hari ini
                    </div>

                </div>

            </div>

        </div>


        <!-- SELESAI -->

        <div class="col-xl-3 col-md-6">

            <div class="stat-card stat-purple">

                <div class="stat-icon">

                    <i class="bi bi-check-lg"></i>

                </div>


                <div>

                    <div class="stat-title">
                        Selesai
                    </div>

                    <div class="stat-number">
                        <?= $selesai ?>
                    </div>

                    <div class="stat-description">
                        Agenda yang sudah selesai
                    </div>

                </div>

            </div>

        </div>


    </div>


    <!-- =====================================================
         AGENDA MENDATANG + STATISTIK
    ===================================================== -->

    <div class="row g-4 mb-4">


        <!-- AGENDA MENDATANG -->

        <div class="col-lg-7">

            <div class="dashboard-card h-100">


                <div class="dashboard-card-header">

                    <h5 class="dashboard-card-title">

                        <i class="bi bi-calendar-event"></i>

                        Agenda Mendatang

                    </h5>


                    <a
                        href="<?= base_url('pegawai/agenda') ?>"
                        class="dashboard-link"
                    >

                        Lihat Semua

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>


                <div class="upcoming-list">


                    <?php if (!empty($agendaMendatang)) : ?>


                        <?php foreach ($agendaMendatang as $item) : ?>

                            <?php

                            $tanggal =
                                strtotime($item['tanggal']);

                            ?>


                            <div class="upcoming-item">


                                <div class="date-box">

                                    <div class="date-number">

                                        <?= date(
                                            'd',
                                            $tanggal
                                        ) ?>

                                    </div>


                                    <div class="date-month">

                                        <?= strtoupper(
                                            $bulanNama[
                                                (int) date(
                                                    'n',
                                                    $tanggal
                                                )
                                            ]
                                        ) ?>

                                        <?= date(
                                            'Y',
                                            $tanggal
                                        ) ?>

                                    </div>

                                </div>


                                <div class="upcoming-info">

                                    <div class="upcoming-name">

                                        <?= esc(
                                            $item['nama_kegiatan']
                                        ) ?>

                                    </div>


                                    <div class="upcoming-meta">

                                        <span class="me-3">

                                            <i class="bi bi-clock"></i>

                                            <?= date(
                                                'H:i',
                                                strtotime(
                                                    $item['waktu']
                                                )
                                            ) ?>

                                            WIB

                                        </span>


                                        <span>

                                            <i class="bi bi-geo-alt"></i>

                                            <?= esc(
                                                $item['tempat']
                                            ) ?>

                                        </span>

                                    </div>

                                </div>


                                <span class="status-upcoming">

                                    Akan Datang

                                </span>


                            </div>


                        <?php endforeach; ?>


                    <?php else : ?>


                        <div class="empty-dashboard">

                            <i class="bi bi-calendar-x"></i>

                            Tidak ada agenda mendatang.

                        </div>


                    <?php endif; ?>


                </div>

            </div>

        </div>


        <!-- =================================================
             STATISTIK BULANAN
        ================================================= -->

        <div class="col-lg-5">

            <div class="dashboard-card h-100">


                <div class="dashboard-card-header">

                    <h5 class="dashboard-card-title">

                        <i class="bi bi-bar-chart"></i>

                        Statistik Agenda Bulanan

                    </h5>

                </div>


                <div class="chart-wrapper">


                    <div class="chart">


                        <?php foreach (
                            $statistikBulan
                            as $nomorBulan => $jumlah
                        ) : ?>


                            <?php

                            $tinggi =
                                ($jumlah / $nilaiMaksimal) * 100;

                            $bulanSekarang =
                                (int) date('n');

                            ?>


                            <div class="chart-column">


                                <?php if ($jumlah > 0) : ?>

                                    <div class="chart-value">

                                        <?= $jumlah ?>

                                    </div>

                                <?php endif; ?>


                                <div
                                    class="chart-bar <?= $nomorBulan === $bulanSekarang ? 'current' : '' ?>"
                                    style="height: <?= max(5, $tinggi) ?>%;"
                                >
                                </div>


                                <div class="chart-label">

                                    <?= $bulanNama[$nomorBulan] ?>

                                </div>


                            </div>


                        <?php endforeach; ?>


                    </div>


                    <!-- MINI STATISTIK -->

                    <div class="row g-2 mt-3">


                        <div class="col-3">

                            <div class="mini-stat">

                                <div class="mini-stat-label">
                                    Total
                                </div>

                                <div class="mini-stat-number">
                                    <?= $totalAgenda ?>
                                </div>

                            </div>

                        </div>


                        <div class="col-3">

                            <div class="mini-stat">

                                <div class="mini-stat-label">
                                    Akan Datang
                                </div>

                                <div class="mini-stat-number">
                                    <?= $akanDatang ?>
                                </div>

                            </div>

                        </div>


                        <div class="col-3">

                            <div class="mini-stat">

                                <div class="mini-stat-label">
                                    Sedang
                                </div>

                                <div class="mini-stat-number">
                                    <?= $sedangBerlangsung ?>
                                </div>

                            </div>

                        </div>


                        <div class="col-3">

                            <div class="mini-stat">

                                <div class="mini-stat-label">
                                    Selesai
                                </div>

                                <div class="mini-stat-number">
                                    <?= $selesai ?>
                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div>


    </div>

</div>


<script>

document.querySelectorAll('.stat-card').forEach(function(card) {

    card.addEventListener('click', function() {

        document.querySelectorAll('.stat-card').forEach(function(item) {

            item.classList.remove('active');

        });

        this.classList.add('active');

    });

});

</script>


<?= $this->endSection() ?>