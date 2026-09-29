<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">
            Detail Agenda
        </h3>

        <p class="text-muted mb-0">
            Informasi lengkap kegiatan Dinas Pendidikan Kota Kediri
        </p>
    </div>

    <a
        href="<?= base_url('admin/agenda') ?>"
        class="btn btn-light border rounded-3">

        <i class="bi bi-arrow-left me-1"></i>
        Kembali

    </a>

</div>


<!-- INFORMASI KEGIATAN -->

<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body p-4">

        <div class="d-flex align-items-center gap-3 mb-4">

            <div
                style="
                    width:48px;
                    height:48px;
                    border-radius:12px;
                    background:#e7f1ff;
                    color:#0d6efd;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                ">

                <i class="bi bi-calendar-event fs-4"></i>

            </div>

            <div>

                <h5 class="fw-bold mb-1">
                    <?= esc($agenda['nama_kegiatan'] ?? '-') ?>
                </h5>

                <small class="text-muted">
                    Detail informasi kegiatan
                </small>

            </div>

        </div>


        <div class="row g-4">

            <!-- TANGGAL -->

            <div class="col-md-6">

                <div class="text-muted small mb-1">
                    Tanggal Kegiatan
                </div>

                <div class="fw-semibold">

                    <?php if (!empty($agenda['tanggal'])) : ?>

                        <?= date(
                            'd-m-Y',
                            strtotime($agenda['tanggal'])
                        ) ?>

                    <?php else : ?>

                        -

                    <?php endif; ?>


                    <?php if (!empty($agenda['tanggal_selesai'])) : ?>

                        s/d

                        <?= date(
                            'd-m-Y',
                            strtotime($agenda['tanggal_selesai'])
                        ) ?>

                    <?php endif; ?>

                </div>

            </div>


            <!-- WAKTU -->

            <div class="col-md-6">

                <div class="text-muted small mb-1">
                    Waktu Kegiatan
                </div>

                <div class="fw-semibold">

                    <?php if (!empty($agenda['waktu'])) : ?>

                        <?= date(
                            'H:i',
                            strtotime($agenda['waktu'])
                        ) ?>

                        WIB

                    <?php else : ?>

                        -

                    <?php endif; ?>

                </div>

            </div>


            <!-- TEMPAT -->

            <div class="col-md-6">

                <div class="text-muted small mb-1">
                    Tempat Kegiatan
                </div>

                <div class="fw-semibold">

                    <?= !empty($agenda['tempat'])
                        ? esc($agenda['tempat'])
                        : '-' ?>

                </div>

            </div>


            <!-- NARASUMBER -->

            <div class="col-md-6">

                <div class="text-muted small mb-1">
                    Pejabat / Narasumber
                </div>

                <div class="fw-semibold">

                    <?= !empty($agenda['pejabat_narasumber'])
                        ? esc($agenda['pejabat_narasumber'])
                        : '-' ?>

                </div>

            </div>


            <!-- PESERTA -->

            <div class="col-md-6">

                <div class="text-muted small mb-1">
                    Peserta
                </div>

                <div class="fw-semibold">

                    <?= !empty($agenda['peserta'])
                        ? nl2br(esc($agenda['peserta']))
                        : '-' ?>

                </div>

            </div>

        </div>


        <hr class="my-4">


        <!-- DESKRIPSI -->

        <div>

            <div class="text-muted small mb-2">
                Deskripsi Kegiatan
            </div>

            <div class="p-3 rounded-3 bg-light">

                <?= !empty($agenda['deskripsi'])
                    ? nl2br(esc($agenda['deskripsi']))
                    : 'Tidak ada deskripsi kegiatan.' ?>

            </div>

        </div>

    </div>

</div>


<!-- DOKUMENTASI -->

<div class="card border-0 shadow-sm rounded-4">

    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h5 class="fw-bold mb-1">

                    <i class="bi bi-images text-primary me-2"></i>

                    Dokumentasi Kegiatan

                </h5>

                <small class="text-muted">
                    Foto dokumentasi agenda
                </small>

            </div>

            <span class="badge bg-primary rounded-pill px-3 py-2">

                <?= count($dokumentasi ?? []) ?>

                Foto

            </span>

        </div>


        <?php if (!empty($dokumentasi)) : ?>

            <div class="row g-3">

                <?php foreach ($dokumentasi as $foto) : ?>

                    <div class="col-md-4 col-lg-3">

                        <div
                            class="position-relative rounded-3 overflow-hidden border"
                            style="height:180px;">

                            <img
                                src="<?= base_url(
                                    'uploads/dokumentasi/' .
                                    $foto['nama_file']
                                ) ?>"
                                alt="Dokumentasi"
                                style="
                                    width:100%;
                                    height:100%;
                                    object-fit:cover;
                                ">


                            <a
                                href="<?= base_url(
                                    'admin/agenda/dokumentasi/hapus/' .
                                    $foto['id']
                                ) ?>"
                                class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
                                onclick="return confirm('Hapus foto ini?')"
                                title="Hapus Foto">

                                <i class="bi bi-trash"></i>

                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else : ?>

            <div class="text-center py-5 text-muted">

                <i class="bi bi-image fs-1 d-block mb-3"></i>

                Belum ada dokumentasi untuk kegiatan ini.

            </div>

        <?php endif; ?>

    </div>

</div>


<?= $this->endSection() ?>