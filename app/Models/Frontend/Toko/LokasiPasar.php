<?php

namespace App\Models\Frontend\Toko;

use CodeIgniter\Model;

class LokasiPasar extends Model
{
    protected $table = "lokasi_pasar";
    // tidak menggunakan created_date/updated_date
    protected $useTimestamps = false;
    protected $primaryKey = 'id';
    
    // tabel-tabel yang diizinkan
    protected $allowedFields = ['id','bagian'];
}
