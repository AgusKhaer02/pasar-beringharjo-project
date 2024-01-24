<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Frontend\Toko\Product;
use App\Models\Frontend\Toko\Toko;

class Denah extends BaseController
{
    protected $tokoModel;
    protected $produkModel;
    function __construct()
    {
        $this->tokoModel = new Toko();
        $this->produkModel = new Product();
    }

    public function index($page = 1): string
    {
        $perPage = 5;
        $data = [
            "toko" => [
                "data" => $this->tokoModel->paginate($perPage),
                "page" => $this->tokoModel->pager,
                "coords" => []
            ]
        ];

        // Fetching only the 'coordinate' column
        $coords = $this->tokoModel->select('coordinate')->findAll();
        // Initialize an array to store decoded coordinates
        $decodedCoords = [];

        // Iterate over the $coords array and decode each JSON string
        foreach ($coords as $jsonCoord) {
            // Decode JSON string to associative array
            $decodedCoord = json_decode($jsonCoord['coordinate'], true);

            // Add the decoded coordinate to the array
            $decodedCoords[] = $decodedCoord;
        }

        // Convert the resulting array to JSON
        $unitedCoordsJson = json_encode($decodedCoords);

        $data['toko']['coords'] = $unitedCoordsJson;

        return view('frontend/pages/denah/denah', $data);
    }


    public function filterDenah($los = "semua", $lantai = 1, $posisi = "Barat")
    {
        // nanti aja ya

    }

    public function detailProduk($slug) {
        $data = [
            "produk" => $this->produkModel->where('slug', $slug)->first(),
        ];
        return view('frontend/pages/denah/toko/product/detail-product', $data);
    }

    public function detailToko($slug)
    {
        $detail = $this->tokoModel->where("slug", $slug)->first();

        $data = [
            "toko" => $detail,
            "produk" => $this->produkModel->where('id_toko', $detail['id_toko'])->findAll(),
            "coords" => $detail['coordinate'],
        ];
        return view('frontend/pages/denah/toko/detail-toko', $data);
    }
}
