<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    protected $table = 'pendaftaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_registrasi', 'user_id', 'paket_id', 'nama', 'no_hp', 'alamat', 'tenor', 'tanggal_pasang', 'jam_pasang', 'status'];
}