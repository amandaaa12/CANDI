<?= $this->extend('pegawai/layout') ?>

<?= $this->section('content') ?>

<div class="page-title mb-4">

    <h2>Tambah Agenda</h2>

    <p>
        Tambahkan data kegiatan Dinas Pendidikan Kota Kediri.
    </p>

</div>


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


<div class="card-custom">

    <div class="mb-4">

        <h5 class="fw-bold mb-1">

            <i class="bi bi-calendar-plus text-primary me-2"></i>

            Form Tambah Agenda

        </h5>

        <p class="text-muted small mb-0">

            Isi data kegiatan dengan lengkap.

        </p>

    </div>


    <form
        action="<?= base_url('pegawai/agenda/simpan') ?>"
        method="post"
    >

        <?= csrf_field() ?>


        <!-- TANGGAL -->

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Tanggal Mulai

                </label>

                <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="<?= old('tanggal') ?>"
                    required
                >

            </div>


            <!-- TANGGAL SELESAI -->

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Tanggal Selesai

                </label>

                <input
                    type="date"
                    name="tanggal_selesai"
                    class="form-control"
                    value="<?= old('tanggal_selesai') ?>"
                >

            </div>

        </div>


        <!-- WAKTU -->

        <div class="mb-3">

            <label class="form-label fw-semibold">

                Waktu

            </label>

            <input
                type="time"
                name="waktu"
                class="form-control"
                value="<?= old('waktu') ?>"
                required
            >

        </div>


        <!-- NAMA KEGIATAN -->

        <div class="mb-3">

            <label class="form-label fw-semibold">

                Nama Kegiatan

            </label>

            <input
                type="text"
                name="nama_kegiatan"
                class="form-control"
                value="<?= old('nama_kegiatan') ?>"
                placeholder="Masukkan nama kegiatan"
                required
            >

        </div>


        <!-- TEMPAT -->

        <div class="mb-3">

            <label class="form-label fw-semibold">

                Tempat

            </label>

            <input
                type="text"
                name="tempat"
                class="form-control"
                value="<?= old('tempat') ?>"
                placeholder="Masukkan tempat kegiatan"
                required
            >

        </div>


        <!-- PEJABAT / NARASUMBER -->

        <div class="mb-3">

            <label class="form-label fw-semibold">

                Pejabat / Narasumber

            </label>

            <input
                type="text"
                name="pejabat_narasumber"
                class="form-control"
                value="<?= old('pejabat_narasumber') ?>"
                placeholder="Masukkan pejabat atau narasumber"
            >

        </div>


        <!-- PESERTA -->

        <div class="mb-3">

            <label class="form-label fw-semibold">

                Peserta

            </label>

            <textarea
                name="peserta"
                class="form-control"
                rows="3"
                placeholder="Masukkan peserta kegiatan"
            ><?= old('peserta') ?></textarea>

        </div>


        <!-- DESKRIPSI -->

        <div class="mb-4">

            <label class="form-label fw-semibold">

                Deskripsi Kegiatan

            </label>

            <textarea
                name="deskripsi"
                class="form-control"
                rows="5"
                placeholder="Tuliskan deskripsi kegiatan"
            ><?= old('deskripsi') ?></textarea>

        </div>


        <!-- BUTTON -->

        <div class="d-flex gap-2">

            <a
                href="<?= base_url('pegawai/agenda') ?>"
                class="btn btn-light"
            >

                <i class="bi bi-arrow-left me-2"></i>

                Kembali

            </a>


            <button
                type="submit"
                class="btn btn-primary"
            >

                <i class="bi bi-save me-2"></i>

                Simpan Agenda

            </button>

        </div>


    </form>

</div>


<style>

.form-label {
    color: #334155;
    font-size: 0.85rem;
}

.form-control {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 0.85rem;
}

.form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
}

.btn-primary {
    background: #2563eb;
    border-color: #2563eb;
    border-radius: 8px;
    font-size: 0.82rem;
    font-weight: 600;
    padding: 9px 15px;
}

.btn-primary:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
}

</style>


<?= $this->endSection() ?>