<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<style>
    .edit-container {
        padding: 30px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        color: #243b5a;
    }

    .page-header p {
        margin: 5px 0 0;
        color: #667085;
        font-size: 15px;
    }

    .btn-kembali {
        background: white;
        border: 1px solid #d9dee8;
        color: #333;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-kembali:hover {
        background: #f5f7fa;
    }

    .form-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        margin-bottom: 5px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #344054;
    }

    .form-control {
        width: 100%;
        padding: 11px 13px;
        border: 1px solid #d9dee8;
        border-radius: 8px;
        font-size: 14px;
        box-sizing: border-box;
        outline: none;
        font-family: inherit;
    }

    .form-control:focus {
        border-color: #2864e8;
        box-shadow: 0 0 0 3px rgba(40, 100, 232, 0.1);
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .upload-box {
        border: 1px solid #d9dee8;
        border-radius: 8px;
        padding: 15px;
        background: #fafbfc;
    }

    .upload-info {
        margin-top: 8px;
        color: #667085;
        font-size: 13px;
    }

    .existing-title {
        margin-top: 20px;
        margin-bottom: 12px;
        font-weight: 600;
        color: #344054;
    }

    .photo-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .photo-item {
        width: 150px;
        border: 1px solid #e4e7ec;
        border-radius: 8px;
        overflow: hidden;
        background: white;
    }

    .photo-item img {
        width: 150px;
        height: 110px;
        object-fit: cover;
        display: block;
    }

    .photo-delete {
        display: block;
        text-align: center;
        padding: 8px;
        background: #dc3545;
        color: white;
        text-decoration: none;
        font-size: 13px;
    }

    .photo-delete:hover {
        background: #bb2d3b;
        color: white;
    }

    .no-photo {
        padding: 15px;
        background: #f8f9fa;
        border: 1px dashed #d0d5dd;
        border-radius: 8px;
        color: #667085;
        font-size: 14px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eaecf0;
    }

    .btn-batal {
        padding: 11px 20px;
        border: 1px solid #d0d5dd;
        background: white;
        color: #344054;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-batal:hover {
        background: #f5f5f5;
    }

    .btn-simpan {
        padding: 11px 22px;
        border: none;
        background: #1769e0;
        color: white;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
    }

    .btn-simpan:hover {
        background: #1256bd;
    }

    @media (max-width: 768px) {
        .edit-container {
            padding: 15px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
    }
</style>


<div class="edit-container">

    <!-- HEADER -->
    <div class="page-header">

        <div>
            <h1>Edit Agenda</h1>
            <p>Ubah data kegiatan Dinas Pendidikan Kota Kediri</p>
        </div>

        <a
            href="<?= site_url('admin/agenda') ?>"
            class="btn-kembali"
        >
            ← Kembali
        </a>

    </div>


    <!-- FORM CARD -->
    <div class="form-card">

        <?php
        /*
         * Ambil ID agenda terlebih dahulu.
         * Dengan cara ini ID tidak langsung dipanggil
         * di dalam atribut action form.
         */
        $agendaId = isset($agenda['id']) ? (int) $agenda['id'] : 0;
        ?>

        <form
            action="<?= base_url('admin/agenda/update/' . $agendaId) ?>"
            method="post"
            enctype="multipart/form-data"
        >

            <?= csrf_field() ?>


            <div class="form-grid">

                <!-- TANGGAL KEGIATAN -->
                <div class="form-group">

                    <label for="tanggal">
                        Tanggal Kegiatan
                    </label>

                    <input
                        type="date"
                        id="tanggal"
                        name="tanggal"
                        class="form-control"
                        value="<?= esc($agenda['tanggal'] ?? '') ?>"
                        required
                    >

                </div>


                <!-- TANGGAL SELESAI -->
                <div class="form-group">

                    <label for="tanggal_selesai">
                        Tanggal Selesai
                    </label>

                    <input
                        type="date"
                        id="tanggal_selesai"
                        name="tanggal_selesai"
                        class="form-control"
                        value="<?= esc($agenda['tanggal_selesai'] ?? '') ?>"
                    >

                </div>


                <!-- WAKTU -->
                <div class="form-group">

                    <label for="waktu">
                        Waktu Kegiatan
                    </label>

                    <input
                        type="time"
                        id="waktu"
                        name="waktu"
                        class="form-control"
                        value="<?= esc($agenda['waktu'] ?? '') ?>"
                        required
                    >

                </div>


                <!-- NAMA KEGIATAN -->
                <div class="form-group">

                    <label for="nama_kegiatan">
                        Nama Kegiatan
                    </label>

                    <input
                        type="text"
                        id="nama_kegiatan"
                        name="nama_kegiatan"
                        class="form-control"
                        value="<?= esc($agenda['nama_kegiatan'] ?? '') ?>"
                        placeholder="Masukkan nama kegiatan"
                        required
                    >

                </div>


                <!-- TEMPAT -->
                <div class="form-group full">

                    <label for="tempat">
                        Tempat Kegiatan
                    </label>

                    <input
                        type="text"
                        id="tempat"
                        name="tempat"
                        class="form-control"
                        value="<?= esc($agenda['tempat'] ?? '') ?>"
                        placeholder="Masukkan tempat kegiatan"
                    >

                </div>


                <!-- PEJABAT / NARASUMBER -->
                <div class="form-group full">

                    <label for="pejabat_narasumber">
                        Pejabat / Narasumber
                    </label>

                    <input
                        type="text"
                        id="pejabat_narasumber"
                        name="pejabat_narasumber"
                        class="form-control"
                        value="<?= esc($agenda['pejabat_narasumber'] ?? '') ?>"
                        placeholder="Masukkan pejabat atau narasumber"
                    >

                </div>


                <!-- PESERTA -->
                <div class="form-group full">

                    <label for="peserta">
                        Peserta
                    </label>

                    <textarea
                        id="peserta"
                        name="peserta"
                        class="form-control"
                        placeholder="Masukkan jumlah atau keterangan peserta"
                    ><?= esc($agenda['peserta'] ?? '') ?></textarea>

                </div>


                <!-- DESKRIPSI -->
                <div class="form-group full">

                    <label for="deskripsi">
                        Deskripsi Kegiatan
                    </label>

                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        class="form-control"
                        placeholder="Masukkan deskripsi kegiatan"
                    ><?= esc($agenda['deskripsi'] ?? '') ?></textarea>

                </div>


                <!-- DOKUMENTASI -->
                <div class="form-group full">

                    <label for="dokumentasi">
                        📷 Dokumentasi Kegiatan
                    </label>

                    <div class="upload-box">

                        <input
                            type="file"
                            id="dokumentasi"
                            name="dokumentasi[]"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                            multiple
                        >

                        <div class="upload-info">
                            Pilih beberapa foto sekaligus.
                            Format JPG, PNG, atau WEBP.
                            Maksimal 5 foto.
                        </div>

                    </div>


                    <!-- DOKUMENTASI LAMA -->
                    <div class="existing-title">
                        Dokumentasi yang Sudah Tersimpan
                    </div>

                    <?php if (!empty($dokumentasi)): ?>

                        <div class="photo-grid">

                            <?php foreach ($dokumentasi as $foto): ?>

                                <div class="photo-item">

                                    <img
                                        src="<?= base_url('uploads/dokumentasi/' . esc($foto['nama_file'])) ?>"
                                        alt="Dokumentasi kegiatan"
                                    >

                                    <a
                                        href="<?= site_url('admin/agenda/dokumentasi/hapus/' . (int) $foto['id']) ?>"
                                        class="photo-delete"
                                        onclick="return confirm('Hapus foto dokumentasi ini?')"
                                    >
                                        🗑 Hapus Foto
                                    </a>

                                </div>

                            <?php endforeach; ?>

                        </div>

                    <?php else: ?>

                        <div class="no-photo">
                            Belum ada dokumentasi untuk agenda ini.
                        </div>

                    <?php endif; ?>

                </div>

            </div>


            <!-- BUTTON -->
            <div class="form-actions">

                <a
                    href="<?= site_url('admin/agenda') ?>"
                    class="btn-batal"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn-simpan"
                >
                    💾 Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>


<?= $this->endSection() ?>