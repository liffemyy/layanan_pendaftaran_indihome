<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketModel extends Model
{
    protected $table = 'paket';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_paket', 'kecepatan', 'harga', 'deskripsi', 'kecepatan_promo', 'tipe_bayar', 'kategori', 'kecepatan_judul', 'tab_kategori', 'jumlah_perangkat', 'ott', 'biaya_pasang'];
}