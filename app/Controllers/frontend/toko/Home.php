<?php

namespace App\Controllers\Frontend\Toko;

use App\Controllers\BaseController;
use App\Models\Frontend\Toko\Product;
use App\Models\Frontend\Toko\Toko;

class Home extends BaseController
{
    protected $produkModel;
    protected $tokoModel;
    function __construct()
    {
        $this->produkModel = new Product();
        $this->tokoModel = new Toko();
    }

    public function index()
    {
        $produk = $this->produkModel
            ->select('produk.id, 
              (SELECT img FROM img_produk WHERE id_produk = produk.id LIMIT 1) as img_produk,
              produk.nama, 
              produk.jenis, 
              produk.harga, 
              produk.stok, 
              produk.slug')
            ->where('produk.id_toko', session('id_toko'))
            ->findAll();

        $data = [
            "produk" => $produk,
            "toko" => $this->tokoModel->find(session('id_toko')),
        ];
        return view('frontend/pages/toko/home/home', $data);
    }
}
