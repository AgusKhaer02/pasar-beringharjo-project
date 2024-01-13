<?php

namespace App\Models\Frontend\Toko;

use CodeIgniter\Model;

class ImageProduct extends Model
{
    protected $table = "img_produk";
    // tidak menggunakan created_date/updated_date
    protected $useTimestamps = false;
    protected $primaryKey = 'id';
    
    // tabel-tabel yang diizinkan
    protected $allowedFields = ['id','id_produk','img'];

}
