<?php

namespace App\Controllers\Frontend\Toko;

use App\Controllers\BaseController;
use App\Models\Frontend\Toko\ImageProduct;
use App\Models\Frontend\Toko\Product as TokoProduct;

class Product extends BaseController
{
    protected $productModel;
    protected $imgProductModel;
    protected $uuid4;

    function __construct()
    {
        $uuid = service('uuid');
        $this->uuid4 = $uuid->uuid4();
        $this->productModel = new TokoProduct();
        $this->imgProductModel = new ImageProduct();
    }
    function addProduct()
    {
        return view('frontend/pages/toko/product/add');
    }

    public function insertProduct()
    {
        $data = $this->request->getVar();
        $imageFiles = $this->request->getFiles('imgProduk');

        $data = [
            "id" => null,
            "id_toko" => session('id_toko'),
            "slug" => url_title($data['nama'], '-', true),
            "nama" => $data['nama'],
            "jenis" => $data['jenis'],
            "harga" => $data['harga'],
            "stok" => $data['stok'],
        ];

        $resInsert = $this->productModel->save($data);

        if ($resInsert) {
            foreach ($imageFiles as $firstImage) {
                foreach ($firstImage as $image) {
                    if ($image->isValid()) {
                        // Move the uploaded file to a destination directory
                        $destination = 'images/toko/produk/';

                        // Get the new file name (after the move operation)
                        $newFileName = $image->getRandomName();

                        $res = $image->move($destination, $newFileName);

                        if ($res) {
                            $data = [
                                "id" => null,
                                "id_produk" => $this->productModel->getInsertID(),
                                "img" => $newFileName,
                            ];
                            $this->imgProductModel->save($data);
                        }
                    }
                }
            }


            session()->setFlashdata("success", "Berhasil tambah produk");
            return redirect()->to(base_url('/toko/home'));
        } else {

            session()->setFlashdata("error", "Gagal tambah produk");
            return redirect()->back()->withInput();
        }
    }

    public function uploadTempFiles()
    {
        // Get the incoming request instance
        $request = service('request');

        // Get the uploaded files
        $files = $request->getFiles();

        // Example: Save uploaded files to a specific directory
        $uploadDir = WRITEPATH . 'uploads/';

        // Iterate through uploaded files
        foreach ($files['file'] as $file) {
            // Check if the file has no errors
            if ($file->isValid() && !$file->hasMoved()) {
                // Move the uploaded file to the destination directory
                $file->move($uploadDir);
            }
        }

        // Return a response, e.g., JSON response with file details
        return $this->response->setJSON(['success' => true, 'message' => 'Files uploaded successfully']);
    }

    public function detailProduct($slug)
    {
        $data['detail'] = $this->productModel->where('slug', $slug)->first();
        $data['images'] = $this->imgProductModel->where('id_produk', $data['detail']['id'])->findAll();
        return view('frontend/pages/toko/product/detail-product', $data);
    }
}
