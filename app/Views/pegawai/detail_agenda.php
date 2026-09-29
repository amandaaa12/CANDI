<?= $this->extend('pegawai/layout') ?>

<?= $this->section('content') ?>

<div class="page-title mb-4">

    <h2>Detail Agenda</h2>

    <p>
        Informasi lengkap kegiatan Dinas Pendidikan Kota Kediri.
    </p>

</div>


<!-- ================================
     ALERT
================================ -->

<?php if (session()->getFlashdata('success')): ?>

    <div class="alert alert-success alert-dismissible fade show">

        <i class="bi bi-check-circle me-2"></i>

        <?= esc(session()->getFlashdata('success')) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>

    </div>

<?php endif; ?>


<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger alert-dismissible fade show">

        <i class="bi bi-exclamation-circle me-2"></i>

        <?= esc(session()->getFlashdata('error')) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>

    </div>

<?php endif; ?>


<!-- ================================
     INFORMASI KEGIATAN
================================ -->

<div class="card-custom">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h5 class="fw-bold mb-1">

                <i class="bi bi-calendar-event text-primary me-2"></i>

                Informasi Kegiatan

            </h5>

            <p class="text-muted small mb-0">

                Detail data agenda kegiatan.

            </p>

        </div>


        <a
            href="<?= base_url('pegawai/agenda') ?>"
            class="btn btn-light"
        >

            <i class="bi bi-arrow-left me-2"></i>

            Kembali

        </a>

    </div>


    <!-- NAMA KEGIATAN -->

    <div class="detail-item">

        <div class="detail-label">

            <i class="bi bi-calendar-check"></i>

            Nama Kegiatan

        </div>

        <div class="detail-value fw-semibold">

            <?= esc($agenda['nama_kegiatan'] ?? '-') ?>

        </div>

    </div>


    <!-- TANGGAL -->

    <div class="detail-item">

        <div class="detail-label">

            <i class="bi bi-calendar3"></i>

            Tanggal

        </div>

        <div class="detail-value">

            <?php if (!empty($agenda['tanggal'])): ?>

                <?= date(
                    'd/m/Y',
                    strtotime($agenda['tanggal'])
                ) ?>

                <?php if (!empty($agenda['tanggal_selesai'])): ?>

                    <span class="text-muted">

                        s/d

                        <?= date(
                            'd/m/Y',
                            strtotime($agenda['tanggal_selesai'])
                        ) ?>

                    </span>

                <?php endif; ?>

            <?php else: ?>

                -

            <?php endif; ?>

        </div>

    </div>


    <!-- WAKTU -->

    <div class="detail-item">

        <div class="detail-label">

            <i class="bi bi-clock"></i>

            Waktu

        </div>

        <div class="detail-value">

            <?php if (!empty($agenda['waktu'])): ?>

                <?= date(
                    'H:i',
                    strtotime($agenda['waktu'])
                ) ?>

                WIB

            <?php else: ?>

                -

            <?php endif; ?>

        </div>

    </div>


    <!-- TEMPAT -->

    <div class="detail-item">

        <div class="detail-label">

            <i class="bi bi-geo-alt"></i>

            Tempat

        </div>

        <div class="detail-value">

            <?= esc($agenda['tempat'] ?? '-') ?>

        </div>

    </div>


    <!-- PEJABAT / NARASUMBER -->

    <div class="detail-item">

        <div class="detail-label">

            <i class="bi bi-person"></i>

            Pejabat / Narasumber

        </div>

        <div class="detail-value">

            <?= esc(
                $agenda['pejabat_narasumber'] ?? '-'
            ) ?>

        </div>

    </div>


    <!-- PESERTA -->

    <div class="detail-item">

        <div class="detail-label">

            <i class="bi bi-people"></i>

            Peserta

        </div>

        <div class="detail-value">

            <?= nl2br(
                esc($agenda['peserta'] ?? '-')
            ) ?>

        </div>

    </div>


    <!-- DESKRIPSI -->

    <div class="detail-item">

        <div class="detail-label">

            <i class="bi bi-card-text"></i>

            Deskripsi Kegiatan

        </div>

        <div class="detail-value">

            <?= nl2br(
                esc($agenda['deskripsi'] ?? '-')
            ) ?>

        </div>

    </div>

</div>


<!-- ================================
     DOKUMENTASI
================================ -->

<div class="card-custom">

    <div class="mb-4">

        <h5 class="fw-bold mb-1">

            <i class="bi bi-images text-primary me-2"></i>

            Dokumentasi Kegiatan

        </h5>

        <p class="text-muted small mb-0">

            Foto dokumentasi kegiatan.

        </p>

    </div>


    <?php if (!empty($dokumentasi)): ?>

        <div class="row g-3">

            <?php foreach ($dokumentasi as $foto): ?>

                <div class="col-6 col-md-4 col-lg-3">

                    <div class="photo-card">

                        <img
                            src="<?= base_url(
                                'uploads/dokumentasi/' .
                                $foto['nama_file']
                            ) ?>"
                            alt="Dokumentasi Kegiatan"
                        >

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <div class="text-center py-5">

            <div
                class="empty-icon mx-auto mb-3"
            >

                <i class="bi bi-image"></i>

            </div>

            <h6 class="fw-bold">

                Belum Ada Dokumentasi

            </h6>

            <p class="text-muted small mb-0">

                Belum ada foto dokumentasi untuk kegiatan ini.

            </p>

        </div>

    <?php endif; ?>

</div>


<style>

/* ================================
   DETAIL
================================ */

.detail-item {

    display: grid;

    grid-template-columns: 220px 1fr;

    gap: 20px;

    padding: 15px 0;

    border-bottom: 1px solid #edf2f7;

}


.detail-item:last-child {

    border-bottom: none;

}


.detail-label {

    color: #64748b;

    font-size: 0.84rem;

    font-weight: 600;

}


.detail-label i {

    width: 22px;

    color: #2563eb;

    margin-right: 5px;

}


.detail-value {

    color: #334155;

    font-size: 0.85rem;

    line-height: 1.7;

}


/* ================================
   FOTO
================================ */

.photo-card {

    width: 100%;

    height: 180px;

    overflow: hidden;

    border-radius: 12px;

    background: #f1f5f9;

}


.photo-card img {

    width: 100%;

    height: 100%;

    object-fit: cover;

    transition: transform 0.2s ease;

}


.photo-card:hover img {

    transform: scale(1.04);

}


/* ================================
   EMPTY
================================ */

.empty-icon {

    width: 65px;

    height: 65px;

    border-radius: 50%;

    background: #e4f0ff;

    display: flex;

    align-items: center;

    justify-content: center;

}


.empty-icon i {

    font-size: 28px;

    color: #2563eb;

}


/* ================================
   MOBILE
================================ */

@media (max-width: 768px) {

    .detail-item {

        grid-template-columns: 1fr;

        gap: 5px;

    }

}

</style>


<?= $this->endSection() ?>