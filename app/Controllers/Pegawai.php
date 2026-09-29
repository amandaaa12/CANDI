<?php

namespace App\Controllers;

use App\Models\AgendaModel;
use App\Models\AgendaDokumentasiModel;

class Pegawai extends BaseController
{
    protected $agendaModel;
    protected $dokumentasiModel;

    public function __construct()
    {
        $this->agendaModel = new AgendaModel();
        $this->dokumentasiModel = new AgendaDokumentasiModel();
    }


    /**
     * Mengecek apakah user sudah login
     * dan memiliki role sebagai pegawai.
     */
    private function cekAkses()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $role = session()->get('role');

        if (!in_array($role, ['Karyawan Dindik', 'Guru Sekolah'], true)) {
            return redirect()->to('/admin');
        }

        return null;
    }


    /**
     * Dashboard Pegawai
     *
     * Hanya menampilkan agenda milik
     * akun yang sedang login.
     */
    public function index()
    {
        $redirect = $this->cekAkses();

        if ($redirect !== null) {
            return $redirect;
        }

        date_default_timezone_set('Asia/Jakarta');

        $userId = session()->get('user_id');

        $agenda = $this->agendaModel
            ->where('user_id', $userId)
            ->orderBy('tanggal', 'DESC')
            ->orderBy('waktu', 'DESC')
            ->findAll();

        $data = [
            'title'  => 'CANDI - Dashboard Pegawai',
            'agenda' => $agenda,
            'nama'   => session()->get('nama'),
            'role'   => session()->get('role')
        ];

        return view('pegawai/dashboard', $data);
    }


    /**
     * Halaman Agenda Pegawai
     *
     * Hanya menampilkan agenda milik
     * akun yang sedang login.
     */
    public function agenda()
    {
        $redirect = $this->cekAkses();

        if ($redirect !== null) {
            return $redirect;
        }

        date_default_timezone_set('Asia/Jakarta');

        $userId = session()->get('user_id');

        $agenda = $this->agendaModel
            ->where('user_id', $userId)
            ->orderBy('tanggal', 'DESC')
            ->orderBy('waktu', 'DESC')
            ->findAll();

        $data = [
            'title'  => 'Agenda Kegiatan',
            'agenda' => $agenda,
            'nama'   => session()->get('nama'),
            'role'   => session()->get('role')
        ];

        return view('pegawai/agenda', $data);
    }


    /**
     * Form Tambah Agenda
     */
    public function tambah()
    {
        $redirect = $this->cekAkses();

        if ($redirect !== null) {
            return $redirect;
        }

        $data = [
            'title' => 'Tambah Agenda',
            'nama'  => session()->get('nama'),
            'role'  => session()->get('role')
        ];

        return view('pegawai/tambah_agenda', $data);
    }


    /**
     * Simpan Agenda dari Pegawai
     *
     * Agenda otomatis menjadi milik akun
     * yang sedang login.
     */
    public function simpan()
    {
        $redirect = $this->cekAkses();

        if ($redirect !== null) {
            return $redirect;
        }

        $tanggal = $this->request->getPost('tanggal');
        $tanggalSelesai = $this->request->getPost('tanggal_selesai');
        $waktu = $this->request->getPost('waktu');
        $namaKegiatan = $this->request->getPost('nama_kegiatan');
        $tempat = $this->request->getPost('tempat');
        $pejabatNarasumber = $this->request->getPost('pejabat_narasumber');
        $peserta = $this->request->getPost('peserta');
        $deskripsi = $this->request->getPost('deskripsi');

        /*
         * Validasi sederhana
         */
        if (
            empty($tanggal) ||
            empty($waktu) ||
            empty($namaKegiatan) ||
            empty($tempat)
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Tanggal, waktu, nama kegiatan, dan tempat wajib diisi.'
                );
        }

        /*
         * Ambil ID akun yang sedang login
         */
        $userId = session()->get('user_id');

        /*
         * Simpan agenda beserta user_id
         */
        $data = [
            'user_id'            => $userId,
            'tanggal'            => $tanggal,
            'tanggal_selesai'    => !empty($tanggalSelesai)
                ? $tanggalSelesai
                : null,
            'waktu'              => $waktu,
            'nama_kegiatan'      => $namaKegiatan,
            'tempat'             => $tempat,
            'pejabat_narasumber' => $pejabatNarasumber,
            'peserta'            => $peserta,
            'deskripsi'          => $deskripsi
        ];

        /*
         * Simpan ke database
         */
        $this->agendaModel->insert($data);

        return redirect()
            ->to('/pegawai/agenda')
            ->with(
                'success',
                'Agenda berhasil ditambahkan.'
            );
    }


    /**
     * Detail Agenda
     *
     * Hanya bisa membuka agenda
     * milik akun yang sedang login.
     */
    public function detail($id)
    {
        $redirect = $this->cekAkses();

        if ($redirect !== null) {
            return $redirect;
        }

        $userId = session()->get('user_id');

        /*
         * Cari berdasarkan:
         * 1. ID agenda
         * 2. user_id pemilik agenda
         */
        $agenda = $this->agendaModel
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        /*
         * Jika bukan milik akun yang login
         */
        if (!$agenda) {
            return redirect()
                ->to('/pegawai/agenda')
                ->with(
                    'error',
                    'Data kegiatan tidak ditemukan atau bukan milik akun Anda.'
                );
        }

        /*
         * Ambil dokumentasi
         */
        $dokumentasi = $this->dokumentasiModel
            ->where('agenda_id', $id)
            ->orderBy('id', 'ASC')
            ->findAll();

        $data = [
            'title'       => 'Detail Kegiatan',
            'agenda'      => $agenda,
            'dokumentasi' => $dokumentasi,
            'nama'        => session()->get('nama'),
            'role'        => session()->get('role')
        ];

        return view('pegawai/detail_agenda', $data);
    }


    /**
     * Halaman Laporan Pegawai
     *
     * Hanya menampilkan agenda milik
     * akun yang sedang login.
     */
    public function laporan()
    {
        $redirect = $this->cekAkses();

        if ($redirect !== null) {
            return $redirect;
        }

        date_default_timezone_set('Asia/Jakarta');

        $userId = session()->get('user_id');

        $agenda = $this->agendaModel
            ->where('user_id', $userId)
            ->orderBy('tanggal', 'DESC')
            ->orderBy('waktu', 'DESC')
            ->findAll();

        $data = [
            'title'  => 'Laporan',
            'agenda' => $agenda,
            'nama'   => session()->get('nama'),
            'role'   => session()->get('role')
        ];

        return view('pegawai/laporan', $data);
    }


    /**
     * Cetak Laporan Kegiatan
     *
     * Pegawai hanya boleh mencetak
     * agenda milik akun sendiri.
     */
    public function cetak($id)
    {
        $redirect = $this->cekAkses();

        if ($redirect !== null) {
            return $redirect;
        }

        date_default_timezone_set('Asia/Jakarta');

        $userId = session()->get('user_id');

        /*
         * Cari agenda berdasarkan:
         * ID agenda + user_id akun login
         */
        $agenda = $this->agendaModel
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        /*
         * Jika agenda bukan milik akun login,
         * jangan izinkan membuka laporan.
         */
        if (!$agenda) {
            return redirect()
                ->to('/pegawai/laporan')
                ->with(
                    'error',
                    'Kamu tidak memiliki akses untuk mencetak laporan kegiatan tersebut.'
                );
        }

        /*
         * Ambil dokumentasi agenda
         */
        $dokumentasi = $this->dokumentasiModel
            ->where('agenda_id', $id)
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('pegawai/laporan_cetak', [
            'title'       => 'Laporan Kegiatan',
            'agenda'      => $agenda,
            'dokumentasi' => $dokumentasi
        ]);
    }
}