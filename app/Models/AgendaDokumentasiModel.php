<?php

namespace App\Models;

use CodeIgniter\Model;

class AgendaDokumentasiModel extends Model
{
    protected $table = 'agenda_dokumentasi';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'agenda_id',
        'nama_file',
        'created_at'
    ];

    protected $useTimestamps = false;
}