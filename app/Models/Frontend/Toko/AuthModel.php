<?php

namespace App\Models\Frontend\Toko;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = "toko";
    // tidak menggunakan created_date/updated_date
    protected $useTimestamps = false;

    protected $primaryKey = 'id_toko';
    
    // tabel-tabel yang diizinkan
    protected $allowedFields = ['id_toko','name','slug','email','password','verified','id_lokasi'];

    public function findToko(string $email = null, string $password = null) {
        $where = [];
        if ($email != null) { 
            $where['email'] = $email;
        }
        if ($password != null) {
            $where['password'] = $password;
        }

        // jika ada kodenya, maka tampilkan data penerbit berdasarkan kodenya
        // first() mengambil data pertama
        return $this->where($where)->first();
    }
}
