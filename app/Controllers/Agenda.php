<?php

namespace App\Controllers;

use App\Models\AgendaModel;
use App\Models\AgendaDokumentasiModel;

class Agenda extends BaseController
{
    protected $agendaModel;
    protected $dokumentasiModel;

    public function __construct()
    {
        $this->agendaModel = new AgendaModel();
        $this->dokumentasiModel = new AgendaDokumentasiModel();
    }


    // =========================================================
    // TAMPILKAN AGENDA
    // =========================================================

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

        $agenda = $this->agendaModel
            ->orderBy('tanggal', 'DESC')
            ->orderBy('waktu', 'DESC')
            ->findAll();

        $status = $this->request->getGet('status');

        if (!empty($status)) {

            $agenda = array_values(
                array_filter($agenda, function ($item) use ($status) {

                    if (
                        empty($item['tanggal']) ||
                        empty($item['waktu'])
                    ) {
                        return false;
                    }

                    $waktuAcara = strtotime(
                        $item['tanggal'] . ' ' . $item['waktu']
                    );

                    $waktuSekarang = time();

                    $selisih = $waktuAcara - $waktuSekarang;

                    if ($selisih > 0) {

                        $statusAgenda = 'akan-datang';

                    } elseif (abs($selisih) <= (3 * 60 * 60)) {

                        $statusAgenda = 'sedang';

                    } else {

                        $statusAgenda = 'selesai';
                    }

                    if ($status === 'aktif') {

                        return in_array(
                            $statusAgenda,
                            ['akan-datang', 'sedang']
                        );
                    }

                    return $statusAgenda === $status;
                })
            );
        }

        return view('admin/agenda', [
            'title'        => 'Agenda Kegiatan',
            'agenda'       => $agenda,
            'statusFilter' => $status ?? 'semua'
        ]);
    }


    // =========================================================
    // SIMPAN AGENDA
    // =========================================================

    public function simpan()
    {
        date_default_timezone_set('Asia/Jakarta');

        /*
        |--------------------------------------------------------------------------
        | Ambil data dari form
        |--------------------------------------------------------------------------
        */

        $tanggal = $this->request->getPost('tanggal');

        $tanggalSelesai = $this->request->getPost(
            'tanggal_selesai'
        );

        $waktu = $this->request->getPost('waktu');

        $namaKegiatan = $this->request->getPost(
            'nama_kegiatan'
        );

        $tempat = $this->request->getPost('tempat');

        $pejabatNarasumber = $this->request->getPost(
            'pejabat_narasumber'
        );

        $peserta = $this->request->getPost('peserta');

        $deskripsi = $this->request->getPost('deskripsi');


        /*
        |--------------------------------------------------------------------------
        | Bersihkan data
        |--------------------------------------------------------------------------
        */

        $tanggal = is_string($tanggal)
            ? trim($tanggal)
            : '';

        $tanggalSelesai = is_string($tanggalSelesai)
            ? trim($tanggalSelesai)
            : '';

        $waktu = is_string($waktu)
            ? trim($waktu)
            : '';

        $namaKegiatan = is_string($namaKegiatan)
            ? trim($namaKegiatan)
            : '';

        $tempat = is_string($tempat)
            ? trim($tempat)
            : '';

        $pejabatNarasumber = is_string($pejabatNarasumber)
            ? trim($pejabatNarasumber)
            : '';

        $peserta = is_string($peserta)
            ? trim($peserta)
            : '';

        $deskripsi = is_string($deskripsi)
            ? trim($deskripsi)
            : '';


        /*
        |--------------------------------------------------------------------------
        | Validasi tanggal
        |--------------------------------------------------------------------------
        */

        if ($tanggal === '') {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Tanggal kegiatan wajib diisi.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi format tanggal
        |--------------------------------------------------------------------------
        */

        $tanggalValid = \DateTime::createFromFormat(
            'Y-m-d',
            $tanggal
        );

        if (
            !$tanggalValid ||
            $tanggalValid->format('Y-m-d') !== $tanggal
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Format tanggal kegiatan tidak valid.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi tanggal selesai
        |--------------------------------------------------------------------------
        */

        if ($tanggalSelesai !== '') {

            $tanggalSelesaiValid =
                \DateTime::createFromFormat(
                    'Y-m-d',
                    $tanggalSelesai
                );

            if (
                !$tanggalSelesaiValid ||
                $tanggalSelesaiValid->format('Y-m-d')
                !== $tanggalSelesai
            ) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Format tanggal selesai tidak valid.'
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi waktu
        |--------------------------------------------------------------------------
        */

        if ($waktu === '') {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Waktu kegiatan wajib diisi.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi nama kegiatan
        |--------------------------------------------------------------------------
        */

        if ($namaKegiatan === '') {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Nama kegiatan wajib diisi.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Data yang akan disimpan
        |--------------------------------------------------------------------------
        */

        $data = [
            'tanggal'            => $tanggal,

            'tanggal_selesai'    =>
                $tanggalSelesai !== ''
                    ? $tanggalSelesai
                    : null,

            'waktu'              => $waktu,

            'nama_kegiatan'      => $namaKegiatan,

            'tempat'             => $tempat,

            'pejabat_narasumber' =>
                $pejabatNarasumber !== ''
                    ? $pejabatNarasumber
                    : null,

            'peserta'            =>
                $peserta !== ''
                    ? $peserta
                    : null,

            'deskripsi'          =>
                $deskripsi !== ''
                    ? $deskripsi
                    : null
        ];


        /*
        |--------------------------------------------------------------------------
        | Simpan agenda
        |--------------------------------------------------------------------------
        */

        try {

            $agendaID = $this->agendaModel->insert(
                $data,
                true
            );

        } catch (\Throwable $e) {

            log_message(
                'error',
                'Gagal menyimpan agenda: ' .
                $e->getMessage()
            );

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Agenda gagal disimpan: ' .
                    $e->getMessage()
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Cek hasil penyimpanan
        |--------------------------------------------------------------------------
        */

        if (!$agendaID) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Agenda gagal disimpan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan dokumentasi
        |--------------------------------------------------------------------------
        */

        $hasilUpload = $this->simpanDokumentasi(
            $agendaID
        );


        /*
        |--------------------------------------------------------------------------
        | Hasil
        |--------------------------------------------------------------------------
        */

        if (!$hasilUpload['success']) {

            return redirect()
                ->to('/admin/agenda')
                ->with(
                    'success',
                    'Agenda berhasil ditambahkan. ' .
                    $hasilUpload['message']
                );
        }

        return redirect()
            ->to('/admin/agenda')
            ->with(
                'success',
                'Agenda dan dokumentasi berhasil ditambahkan.'
            );
    }


    // =========================================================
    // SIMPAN FOTO DOKUMENTASI
    // =========================================================

 // =========================================================
// SIMPAN FOTO DOKUMENTASI
// =========================================================

private function simpanDokumentasi($agendaID)
{
    $files = $this->request->getFileMultiple('dokumentasi');

    // Tidak ada foto
    if (empty($files)) {
        return [
            'success' => true,
            'message' => 'Tidak ada dokumentasi.'
        ];
    }


    // =====================================================
    // FOLDER UPLOAD
    // =====================================================

    $uploadPath = FCPATH . 'uploads/dokumentasi';

    if (!is_dir($uploadPath)) {

        if (!mkdir($uploadPath, 0777, true)) {

            return [
                'success' => false,
                'message' =>
                    'Folder dokumentasi gagal dibuat.'
            ];
        }
    }


    // =====================================================
    // MAKSIMAL 5 FOTO
    // =====================================================

    $files = array_slice($files, 0, 5);

    $jumlahBerhasil = 0;


    // =====================================================
    // PROSES SETIAP FOTO
    // =====================================================

    foreach ($files as $file) {

        // Tidak ada file
        if (
            !$file ||
            $file->getError() === UPLOAD_ERR_NO_FILE
        ) {
            continue;
        }


        // Cek apakah upload valid
        if (!$file->isValid()) {

            log_message(
                'error',
                'Upload dokumentasi gagal: ' .
                $file->getErrorString()
            );

            continue;
        }


        // =================================================
        // CEK FORMAT FILE
        // =================================================

        $mimeType = $file->getMimeType();

        $allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!in_array($mimeType, $allowedTypes)) {

            log_message(
                'error',
                'Format dokumentasi tidak diizinkan: ' .
                $mimeType
            );

            continue;
        }


        // =================================================
        // NAMA FILE ACAK
        // =================================================

        $namaFile = $file->getRandomName();


        // =================================================
        // PINDAHKAN FILE
        // =================================================

        try {

            $file->move(
                $uploadPath,
                $namaFile
            );

        } catch (\Throwable $e) {

            log_message(
                'error',
                'Gagal memindahkan dokumentasi: ' .
                $e->getMessage()
            );

            continue;
        }


        // =================================================
        // CEK FILE
        // =================================================

        $filePath =
            $uploadPath .
            DIRECTORY_SEPARATOR .
            $namaFile;

        if (!is_file($filePath)) {
            continue;
        }


        // =================================================
        // SIMPAN KE DATABASE
        // =================================================

        try {

            $simpan = $this->dokumentasiModel->insert([
                'agenda_id'  => $agendaID,
                'nama_file'  => $namaFile,
                'created_at' => date('Y-m-d H:i:s')
            ]);

        } catch (\Throwable $e) {

            log_message(
                'error',
                'Gagal menyimpan dokumentasi ke database: ' .
                $e->getMessage()
            );

            // Hapus file kalau database gagal
            if (is_file($filePath)) {
                unlink($filePath);
            }

            continue;
        }


        // =================================================
        // HITUNG FOTO BERHASIL
        // =================================================

        if ($simpan) {

            $jumlahBerhasil++;

        } else {

            if (is_file($filePath)) {
                unlink($filePath);
            }
        }
    }


    // =====================================================
    // HASIL UPLOAD
    // =====================================================

    if ($jumlahBerhasil === 0) {

        return [
            'success' => false,
            'message' =>
                'Agenda tersimpan, tetapi dokumentasi tidak berhasil diupload.'
        ];
    }


    return [
        'success' => true,
        'message' =>
            $jumlahBerhasil .
            ' foto dokumentasi berhasil diupload.'
    ];
}


    // =========================================================
    // EDIT AGENDA
    // =========================================================

    public function edit($id)
    {
        $agenda =
            $this->agendaModel->find($id);


        if (!$agenda) {

            return redirect()
                ->to('/admin/agenda')
                ->with(
                    'error',
                    'Data agenda tidak ditemukan.'
                );
        }


        $dokumentasi =
            $this->dokumentasiModel
                ->where(
                    'agenda_id',
                    $id
                )
                ->orderBy(
                    'id',
                    'DESC'
                )
                ->findAll();


        return view(
            'admin/edit_agenda',
            [
                'title' =>
                    'Edit Agenda',

                'agenda' =>
                    $agenda,

                'dokumentasi' =>
                    $dokumentasi
            ]
        );
    }


    // =========================================================
    // UPDATE AGENDA
    // =========================================================

    public function update($id)
    {
        date_default_timezone_set(
            'Asia/Jakarta'
        );


        $agenda =
            $this->agendaModel->find($id);


        if (!$agenda) {

            return redirect()
                ->to('/admin/agenda')
                ->with(
                    'error',
                    'Data agenda tidak ditemukan.'
                );
        }


        $tanggal =
            trim(
                (string)
                $this->request->getPost(
                    'tanggal'
                )
            );


        $tanggalSelesai =
            trim(
                (string)
                $this->request->getPost(
                    'tanggal_selesai'
                )
            );


        $waktu =
            trim(
                (string)
                $this->request->getPost(
                    'waktu'
                )
            );


        $namaKegiatan =
            trim(
                (string)
                $this->request->getPost(
                    'nama_kegiatan'
                )
            );


        $tempat =
            trim(
                (string)
                $this->request->getPost(
                    'tempat'
                )
            );


        $pejabatNarasumber =
            trim(
                (string)
                $this->request->getPost(
                    'pejabat_narasumber'
                )
            );


        $peserta =
            trim(
                (string)
                $this->request->getPost(
                    'peserta'
                )
            );


        $deskripsi =
            trim(
                (string)
                $this->request->getPost(
                    'deskripsi'
                )
            );


        /*
        | Validasi tanggal
        */

        if ($tanggal === '') {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Tanggal kegiatan wajib diisi.'
                );
        }


        /*
        | Data update
        */

        $data = [
            'tanggal' =>
                $tanggal,

            'tanggal_selesai' =>
                $tanggalSelesai !== ''
                    ? $tanggalSelesai
                    : null,

            'waktu' =>
                $waktu,

            'nama_kegiatan' =>
                $namaKegiatan,

            'tempat' =>
                $tempat,

            'pejabat_narasumber' =>
                $pejabatNarasumber !== ''
                    ? $pejabatNarasumber
                    : null,

            'peserta' =>
                $peserta !== ''
                    ? $peserta
                    : null,

            'deskripsi' =>
                $deskripsi !== ''
                    ? $deskripsi
                    : null
        ];


        try {

            $berhasil =
                $this->agendaModel->update(
                    $id,
                    $data
                );

        } catch (\Throwable $e) {

            log_message(
                'error',
                'Gagal update agenda: ' .
                $e->getMessage()
            );

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Agenda gagal diperbarui: ' .
                    $e->getMessage()
                );
        }


        if (!$berhasil) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Agenda gagal diperbarui.'
                );
        }


        // Foto tambahan
        $this->simpanDokumentasi(
            $id
        );


        return redirect()
            ->to('/admin/agenda')
            ->with(
                'success',
                'Agenda berhasil diperbarui.'
            );
    }


    // =========================================================
    // DETAIL AGENDA
    // =========================================================

    public function detail($id)
    {
        $agenda =
            $this->agendaModel->find($id);


        if (!$agenda) {

            return redirect()
                ->to('/admin/agenda')
                ->with(
                    'error',
                    'Data agenda tidak ditemukan.'
                );
        }


        $dokumentasi =
            $this->dokumentasiModel
                ->where(
                    'agenda_id',
                    $id
                )
                ->orderBy(
                    'id',
                    'DESC'
                )
                ->findAll();


        return view(
            'admin/detail_agenda',
            [
                'title' =>
                    'Detail Agenda',

                'agenda' =>
                    $agenda,

                'dokumentasi' =>
                    $dokumentasi
            ]
        );
    }


    // =========================================================
    // HAPUS AGENDA
    // =========================================================

    public function hapus($id)
    {
        $agenda =
            $this->agendaModel->find($id);


        if (!$agenda) {

            return redirect()
                ->to('/admin/agenda')
                ->with(
                    'error',
                    'Data agenda tidak ditemukan.'
                );
        }


        /*
        | Ambil dokumentasi
        */

        $dokumentasi =
            $this->dokumentasiModel
                ->where(
                    'agenda_id',
                    $id
                )
                ->findAll();


        /*
        | Hapus file foto
        */

        foreach (
            $dokumentasi
            as $foto
        ) {

            $filePath =
                FCPATH .
                'uploads/dokumentasi/' .
                $foto['nama_file'];


            if (is_file($filePath)) {

                unlink($filePath);
            }
        }


        /*
        | Hapus data dokumentasi
        */

        $this->dokumentasiModel
            ->where(
                'agenda_id',
                $id
            )
            ->delete();


        /*
        | Hapus agenda
        */

        $this->agendaModel
            ->delete($id);


        return redirect()
            ->to('/admin/agenda')
            ->with(
                'success',
                'Agenda berhasil dihapus.'
            );
    }


    // =========================================================
    // HAPUS SATU FOTO DOKUMENTASI
    // =========================================================

    public function hapusDokumentasi($id)
    {
        $foto =
            $this->dokumentasiModel
                ->find($id);


        if (!$foto) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumentasi tidak ditemukan.'
                );
        }


        /*
        | Lokasi file
        */

        $filePath =
            FCPATH .
            'uploads/dokumentasi/' .
            $foto['nama_file'];


        /*
        | Hapus file
        */

        if (is_file($filePath)) {

            unlink($filePath);
        }


        /*
        | Hapus database
        */

        $this->dokumentasiModel
            ->delete($id);


        return redirect()
            ->back()
            ->with(
                'success',
                'Foto dokumentasi berhasil dihapus.'
            );
    }
}