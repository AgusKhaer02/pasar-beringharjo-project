<?php

namespace App\Models\Frontend\Toko;

use CodeIgniter\Model;

class Toko extends Model
{
    protected $table = "toko";
    // tidak menggunakan created_date/updated_date
    protected $useTimestamps = false;
    protected $primaryKey = 'id_toko';

    // tabel-tabel yang diizinkan
    protected $allowedFields = ['id_toko', 'name', 'email', 'address', 'coordinate', 'no_telp', 'slug', 'img_profile', 'img_cover', 'lantai', 'id_lokasi', 'password', 'verified'];

    public function confirmEmail($code)
    {
        $this->where('toko_email_confirm.email', $code);
        $this->select('toko_email_confirm.email');
        $this->join('toko_email_confirm', 'toko.id_toko = toko_email_confirm.id_toko');

        return $this->get();
    }


    function fetchToko($slug = null)
    {
        if ($slug != null) {
            $this->where('slug', $slug);
        }
        $this->select("toko.* , lokasi_pasar.bagian");
        $this->join('lokasi_pasar', function ($join) {
            $join->on('toko.id_lokasi', '=', 'lokasi_pasar.id');
        });

        return ($slug != null) ? $this->first() : $this;
    }
}
