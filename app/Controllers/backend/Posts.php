<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\PostModel;

class Posts extends BaseController
{

    protected $postModel;
    public function __construct() {
        // membuat objek dari penerbit model
        $this->postModel = new PostModel();
    }

    public function index(): string
    {
        $data = [
            "title" => "Post",
            "posts" => $this->postModel->getPost(),
        ];

        return view('backend/pages/posts/index',$data);
    }

    // form add
    public function formInsert(): string
    {
        session();
        $data = [
            "title" => "Add new Post",
            "validation" => \Config\Services::validation(),
        ];

        return view('backend/pages/posts/form-add',$data);
    }

    // form edit
    public function formUpdate(string $slug): string
    {
        session();
        $data = [
            "title" => "Edit Post",
            "post" => $this->postModel->detailPost($slug),
            "validation" => \Config\Services::validation(),
        ];

        return view('backend/pages/posts/form-edit',$data);
    }
    
    // update
    public function update()
    {
        $validate = [
            "id" => [
                "rules" => "required",
                "errors" => [
                    "required" => "{field} harus diisi!",
                ]
            ],
            "title" => [
                "rules" => "required",
                "errors" => [
                    "required" => "{field} harus diisi!",
                ]
            ],

            "image" => [
                "rules" => "max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]",
                "errors" => [
                    "max_size" => "ukuran gambar terlalu besar",
                    "is_image" => "yang ada pilih bukan gambar",
                    "mime_in" => "Format gambar anda tidak sesuai!"
                ]
            ],

            "tags" => [
                "rules" => "required",
                "errors" => [
                    "required" => "{field} harus diisi!",
                ]
            ],
            "content" => [
                "rules" => "required",
                "errors" => [
                    "required" => "{field} harus diisi!",
                ]
            ],
      
        ];
        $validation = \Config\Services::validation();
        //menerima nilai dari form
        $data= $this->request->getVar();
        //  dd($data);
        if (!$this->validate($validate)) {

            dd($validation);
            // dd($validation);
            session()->setFlashData("error","Kesalahan pada saat input");
            //echo("<script>alert('Kesalahan pada saat input')</script>");
            return redirect()->back()->withInput()->with("validation", $validation);
        }
       
        // mengambil gambar post dari form
        $filePost = $this->request->getFile('image');
        $postImageName = "";
        $dataPost = $this->postModel->where('slug',$data['slug'])->first();

        if($filePost->getError() == 4){
            $postImageName = $dataPost['img'];
        }else {
            //memberikan nama post baru

            // jika nama file bukan "default.png" maka gunakan nama file dari tablenya
            // jika nama filenya default.png, diharuskan untuk generate name baru, jadi biar nggak ke replace file default.pngnya
            $postImageName = ($dataPost['img'] == "default.png") ? $filePost->getRandomName() : $dataPost['img'];
            $filePost->move('images/post/', $postImageName, true);
        }

        $update = [
            "title" => $data['title'],
            "content" => $data['content'],
            "tags" => $data['tags'],
            "slug" => url_title($data['title'], '-', true),
            "img" => $postImageName
        ];
        
        // gunakan replace untuk update datanya
        $simpan = $this->postModel->update($data['id'], $update);
        
        if ($simpan) {
            session()->setFlashData("success", "Post berhasil ditambahkan!");
            return redirect()->to(base_url('/admin/posts/'));
        }else {
            session()->setFlashData("error", "Post gagal ditambahkan!");
            return redirect()->to(base_url('/admin/posts/'));
        }
        
    }


    // insert
    public function insert()
    {
        $validate = [
            "title" => [
                "rules" => "required",
                "errors" => [
                    "required" => "{field} harus diisi!",
                ]
            ],

            "image" => [
                "rules" => "max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]",
                "errors" => [
                    "max_size" => "ukuran gambar terlalu besar",
                    "is_image" => "yang ada pilih bukan gambar",
                    "mime_in" => "Format gambar anda tidak sesuai!"
                ]
            ],

            "tags" => [
                "rules" => "required",
                "errors" => [
                    "required" => "{field} harus diisi!",
                ]
            ],
            "content" => [
                "rules" => "required",
                "errors" => [
                    "required" => "{field} harus diisi!",
                ]
            ],
        ];
        // dd($this->validate($validate));
        $validation = \Config\Services::validation();
        
        if (!$this->validate($validate)) {
            // pindah/redirect ke halaman create dan mengirimkan inputnya beserta validasinya
            // withInput ini bisa menampilkan nilai dari form ke form lagi, jadi tidak perlu diisi ulang semuanya
            // dd($validation);
            session()->setFlashData("error","Kesalahan pada saat input");

            return redirect()->back()->withInput()->with("validation", $validation);
        }
        // menerima nilai dari form
        $data = $this->request->getVar();

        // mengambil gambar post dari form
        $filePost = $this->request->getFile('image');
        $postImageName = "";
        if ($filePost->getError() == 4) {
            $postImageName = "default.png";
        }else {
            // memberikan nama post baru
            $postImageName = $filePost->getRandomName();
            
            $filePost->move('images/post/',$postImageName);
        }

        $insert = [
            "id" => generateUuid(),
            "title" => $data['title'],
            "content" => $data['content'],
            "tags" => $data['tags'],
            "img" => $postImageName,
            "status" => "published",
            "slug" => url_title($data['title'], '-', true),
            "id_author" => "900d5535-a013-11ee-903f-1cb72c965d78"
        ];

        
        // dd($insert);
        $simpan = $this->postModel->insert($insert);
        // dd($simpan);
        if ($simpan) {
            session()->setFlashdata("success", "Post berhasil ditambahkan!");
            return redirect()->to(base_url('/admin/posts/'));
        }else {
            session()->setFlashdata("error", "Post gagal ditambahkan!");
            return redirect()->to(base_url('/admin/posts/'));
        }
    }
    // delete

    public function delete(string $slug) {
        $dataPost = $this->postModel->where('slug',$slug)->first();

        if ($dataPost['img'] != "default.png" && file_exists('images/post/' . $dataPost['img'])) {
            unlink("images/post/" . $dataPost['img']);
        }

        $hapus = $this->postModel->where('slug',$slug)->delete();
        if ($hapus) {
            session()->setFlashdata("success", "Post berhasil dihapuskan!");
            return redirect()->to(base_url('/admin/posts/'));
        }else {
            session()->setFlashdata("error", "Post gagal dihapuskan!");
            return redirect()->to(base_url('/admin/posts/'));
        }
    }
}
