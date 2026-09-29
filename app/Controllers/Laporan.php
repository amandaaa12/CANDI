<?php

namespace App\Controllers;

use App\Models\AgendaModel;
use App\Models\AgendaDokumentasiModel;

class Laporan extends BaseController
{
    protected $agendaModel;
    protected $dokumentasiModel;

    public function __construct()
    {
        $this->agendaModel = new AgendaModel();
        $this->dokumentasiModel = new AgendaDokumentasiModel();
    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

        $agenda = $this->agendaModel
            ->orderBy('tanggal', 'DESC')
            ->orderBy('waktu', 'DESC')
            ->findAll();

        return view('admin/laporan', [
            'title'  => 'Laporan',
            'agenda' => $agenda
        ]);
    }


    public function cetak($id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $agenda = $this->agendaModel->find($id);

        if (!$agenda) {

            return redirect()
                ->to('/admin/laporan')
                ->with(
                    'error',
                    'Data kegiatan tidak ditemukan.'
                );
        }


        $dokumentasi = $this->dokumentasiModel
            ->where('agenda_id', $id)
            ->orderBy('id', 'ASC')
            ->findAll();


        return view(
            'admin/laporan_cetak',
            [
                'title' => 'Laporan Kegiatan',
                'agenda' => $agenda,
                'dokumentasi' => $dokumentasi
            ]
        );
    }
}