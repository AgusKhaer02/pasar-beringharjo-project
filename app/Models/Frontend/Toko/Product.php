<?php

namespace App\Models\Frontend\Toko;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table = "produk";
    // tidak menggunakan created_date/updated_date
    protected $useTimestamps = false;
    protected $primaryKey = 'id';
    
    // tabel-tabel yang diizinkan
    protected $allowedFields = ['id','id_toko','slug','nama','jenis','harga','stok'];
}