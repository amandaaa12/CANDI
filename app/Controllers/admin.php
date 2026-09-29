<?php

namespace App\Controllers;

use App\Models\AgendaModel;

class admin extends BaseController
{
    protected $agendaModel;

    public function __construct()
    {
        $this->agendaModel = new AgendaModel();
    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

        $agenda = $this->agendaModel
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu', 'ASC')
            ->findAll();

        $data = [
            'title' => 'CANDI - Dashboard Agenda',
            'agenda' => $agenda
        ];

        return view('admin/dashboard', $data);
    }
}