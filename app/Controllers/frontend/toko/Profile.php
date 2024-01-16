<?php

namespace App\Controllers\Frontend\Toko;

use App\Controllers\BaseController;
use App\Models\Frontend\Toko\LokasiPasar;
use App\Models\Frontend\Toko\Toko;

class Profile extends BaseController
{
    protected $tokoModel;
    protected $lokasiPasarModel;
    function __construct() {
        $this->tokoModel = new Toko();
        $this->lokasiPasarModel = new LokasiPasar();
    }

    public function editProfile()
    {
        $data = [
            "toko" => $this->tokoModel->find(session('id_toko')),
            "lokasi" => $this->lokasiPasarModel->findAll(),
            "bingMapsAPIKey" => $this->bingMapsAPIKey
        ];
        return view('frontend/pages/toko/home/edit-profile', $data);
    }


    function updateProfile() {
        $data = $this->request->getVar();

        $dataUpdate = [
            "no_telp" => $data['no_telp'],
            "address" => $data['address'],
            "coordinate" => $data['coordinate'],
            "lantai" => $data['lantai'],
            "id_lokasi" => $data['id_lokasi']
        ];

        $update = $this->tokoModel->update($data['id_toko'], $dataUpdate);

        if ($update) {
            session()->setFlashdata('success', 'Data toko anda berhasli diubah!');
            return redirect()->to(base_url('toko/home'));
        }else {
            session()->setFlashdata('error', 'Kesalahan tak terduga');
            return redirect()->back();
        }
    }

    

    function addMoreInfo() {
        $data = [
            "toko" => $this->tokoModel->find(session('id_toko'))
        ];
        return view('frontend/pages/toko/home/input-more-info', $data);
    }

    function submitMoreInfo() {
        $data = $this->request->getVar();

        $dataUpdate = [
            "no_telp" => $data['no_telp'],
            "address" => $data['address'],
            "coordinate" => $data['coordinate'],
            "lantai" => $data['lantai'],
        ];

        $update = $this->tokoModel->update($data['id_toko'], $dataUpdate);

        if ($update) {
            session()->setFlashdata('success', 'Selamat akun anda dapat digunakan, silahkan tambahkan produk anda untuk memulai!');
            return redirect()->to(base_url('toko/home'));
        }else {
            session()->setFlashdata('error', 'Kesalahan tak terduga');
            return redirect()->back();
        }
    }
}