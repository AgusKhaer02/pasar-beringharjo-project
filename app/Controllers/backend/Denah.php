<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\LosModel;

class Denah extends BaseController
{
    protected $losModel;
    public function __construct() {
        // membuat objek dari penerbit model
        $this->losModel = new LosModel();
    }

    public function index(): string
    {
        $data = [
            "title" => "Denah",
            "los" => $this->losModel->getDenah(),
        ];

        return view('backend/pages/denah/index',$data);
    }

    // // form add
    // public function formInsert(): string
    // {
    //     session();
    //     $data = [
    //         "title" => "Add new Denah",
    //         "validation" => \Config\Services::validation(),
    //     ];

    //     return view('backend/pages/denahs/form-add',$data);
    // }

    // // form edit
    // public function formUpdate(string $slug): string
    // {
    //     session();
    //     $data = [
    //         "title" => "Edit Denah",
    //         "denah" => $this->losModel->detailDenah($slug),
    //         "validation" => \Config\Services::validation(),
    //     ];

    //     return view('backend/pages/denahs/form-edit',$data);
    // }
    
    // // update
    // public function update()
    // {
    //     $validate = [
    //         "id" => [
    //             "rules" => "required",
    //             "errors" => [
    //                 "required" => "{field} harus diisi!",
    //             ]
    //         ],
    //         "title" => [
    //             "rules" => "required",
    //             "errors" => [
    //                 "required" => "{field} harus diisi!",
    //             ]
    //         ],

    //         "image" => [
    //             "rules" => "max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]",
    //             "errors" => [
    //                 "max_size" => "ukuran gambar terlalu besar",
    //                 "is_image" => "yang ada pilih bukan gambar",
    //                 "mime_in" => "Format gambar anda tidak sesuai!"
    //             ]
    //         ],

    //         "tags" => [
    //             "rules" => "required",
    //             "errors" => [
    //                 "required" => "{field} harus diisi!",
    //             ]
    //         ],
    //         "content" => [
    //             "rules" => "required",
    //             "errors" => [
    //                 "required" => "{field} harus diisi!",
    //             ]
    //         ],
      
    //     ];
    //     $validation = \Config\Services::validation();
    //     //menerima nilai dari form
    //     $data= $this->request->getVar();
    //     //  dd($data);
    //     if (!$this->validate($validate)) {

    //         dd($validation);
    //         // dd($validation);
    //         session()->setFlashData("error","Kesalahan pada saat input");
    //         //echo("<script>alert('Kesalahan pada saat input')</script>");
    //         return redirect()->back()->withInput()->with("validation", $validation);
    //     }
       
    //     // mengambil gambar denah dari form
    //     $fileDenah = $this->request->getFile('image');
    //     $denahImageName = "";
    //     $dataDenah = $this->losModel->where('slug',$data['slug'])->first();

    //     if($fileDenah->getError() == 4){
    //         $denahImageName = $dataDenah['img'];
    //     }else {
    //         //memberikan nama denah baru

    //         // jika nama file bukan "default.png" maka gunakan nama file dari tablenya
    //         // jika nama filenya default.png, diharuskan untuk generate name baru, jadi biar nggak ke replace file default.pngnya
    //         $denahImageName = ($dataDenah['img'] == "default.png") ? $fileDenah->getRandomName() : $dataDenah['img'];
    //         $fileDenah->move('images/denah/', $denahImageName, true);
    //     }

    //     $update = [
    //         "title" => $data['title'],
    //         "content" => $data['content'],
    //         "tags" => $data['tags'],
    //         "slug" => url_title($data['title'], '-', true),
    //         "img" => $denahImageName
    //     ];
        
    //     // gunakan replace untuk update datanya
    //     $simpan = $this->losModel->update($data['id'], $update);
        
    //     if ($simpan) {
    //         session()->setFlashData("success", "Denah berhasil ditambahkan!");
    //         return redirect()->to(base_url('/admin/denahs/'));
    //     }else {
    //         session()->setFlashData("error", "Denah gagal ditambahkan!");
    //         return redirect()->to(base_url('/admin/denahs/'));
    //     }
        
    // }


    // // insert
    // public function insert()
    // {
    //     $validate = [
    //         "title" => [
    //             "rules" => "required",
    //             "errors" => [
    //                 "required" => "{field} harus diisi!",
    //             ]
    //         ],

    //         "image" => [
    //             "rules" => "max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]",
    //             "errors" => [
    //                 "max_size" => "ukuran gambar terlalu besar",
    //                 "is_image" => "yang ada pilih bukan gambar",
    //                 "mime_in" => "Format gambar anda tidak sesuai!"
    //             ]
    //         ],

    //         "tags" => [
    //             "rules" => "required",
    //             "errors" => [
    //                 "required" => "{field} harus diisi!",
    //             ]
    //         ],
    //         "content" => [
    //             "rules" => "required",
    //             "errors" => [
    //                 "required" => "{field} harus diisi!",
    //             ]
    //         ],
    //     ];
    //     // dd($this->validate($validate));
    //     $validation = \Config\Services::validation();
        
    //     if (!$this->validate($validate)) {
    //         // pindah/redirect ke halaman create dan mengirimkan inputnya beserta validasinya
    //         // withInput ini bisa menampilkan nilai dari form ke form lagi, jadi tidak perlu diisi ulang semuanya
    //         // dd($validation);
    //         session()->setFlashData("error","Kesalahan pada saat input");

    //         return redirect()->back()->withInput()->with("validation", $validation);
    //     }
    //     // menerima nilai dari form
    //     $data = $this->request->getVar();

    //     // mengambil gambar denah dari form
    //     $fileDenah = $this->request->getFile('image');
    //     $denahImageName = "";
    //     if ($fileDenah->getError() == 4) {
    //         $denahImageName = "default.png";
    //     }else {
    //         // memberikan nama denah baru
    //         $denahImageName = $fileDenah->getRandomName();
            
    //         $fileDenah->move('images/denah/',$denahImageName);
    //     }

    //     $insert = [
    //         "id" => generateUuid(),
    //         "title" => $data['title'],
    //         "content" => $data['content'],
    //         "tags" => $data['tags'],
    //         "img" => $denahImageName,
    //         "status" => "published",
    //         "slug" => url_title($data['title'], '-', true),
    //         "id_author" => "900d5535-a013-11ee-903f-1cb72c965d78"
    //     ];

        
    //     // dd($insert);
    //     $simpan = $this->losModel->insert($insert);
    //     // dd($simpan);
    //     if ($simpan) {
    //         session()->setFlashdata("success", "Denah berhasil ditambahkan!");
    //         return redirect()->to(base_url('/admin/denahs/'));
    //     }else {
    //         session()->setFlashdata("error", "Denah gagal ditambahkan!");
    //         return redirect()->to(base_url('/admin/denahs/'));
    //     }
    // }
    // // delete

    // public function delete(string $slug) {
    //     $dataDenah = $this->losModel->where('slug',$slug)->first();

    //     if ($dataDenah['img'] != "default.png" && file_exists('images/denah/' . $dataDenah['img'])) {
    //         unlink("images/denah/" . $dataDenah['img']);
    //     }

    //     $hapus = $this->losModel->where('slug',$slug)->delete();
    //     if ($hapus) {
    //         session()->setFlashdata("success", "Denah berhasil dihapuskan!");
    //         return redirect()->to(base_url('/admin/denahs/'));
    //     }else {
    //         session()->setFlashdata("error", "Denah gagal dihapuskan!");
    //         return redirect()->to(base_url('/admin/denahs/'));
    //     }
    // }
}
