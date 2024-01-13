<?php

namespace App\Models\Frontend\Toko;

use CodeIgniter\Model;

class TokoEmailConfirm extends Model
{
    protected $table = "toko_email_confirm";
    // tidak menggunakan created_date/updated_date
    protected $useTimestamps = false;
    
    // tabel-tabel yang diizinkan
    protected $allowedFields = ['id_toko','code','expired_at'];

}
