<?php

namespace App\Models;

use CodeIgniter\Model;

class AgendaModel extends Model
{
    protected $table = 'agenda';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'tanggal',
        'tanggal_selesai',
        'waktu',
        'nama_kegiatan',
        'tempat',
        'pejabat_narasumber',
        'peserta',
        'deskripsi'
    ];
}