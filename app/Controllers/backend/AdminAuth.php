<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\AdminAuthModel;

class AdminAuth extends BaseController
{
    protected $authModel;

    function __construct(){
        $this->authModel = new AdminAuthModel();
    }
    function login()
    {
        if (session('id_admin') && session('email')) {
            return redirect()->to(base_url('toko/home'));
        }
        return view('backend/pages/auth/login');
    }

    function logout() {
        session()->destroy();
        return redirect()->to(base_url('admin/auth/'));
    }

    public function authenticate()
    {
        $data = $this->request->getVar();

        $dataAdmin = $this->authModel->where('username',$data['username'])->first();
        if ($dataAdmin != null) {
            // pengecekan password dari form input dengan password dari table admin
            $authenticatePassword = password_verify($data['password'], $dataAdmin['password']);
            if ($authenticatePassword) {

                $dataSession = [
                    "id_admin" => $dataAdmin['id_admin'],
                    "username" => $dataAdmin['username'],
                ];

                session()->set($dataSession);
                $this->gotoNextPageIfExists($data);
                // kalo semialkan mau pindah ke halaman berikutnya, jadi nggak harus lewat home dulu!

                return redirect()->to(base_url('/admin/dashboard'));
            } else {
                session()->setFlashdata('error', 'Password tidak sesuai!');
                return redirect()->to(base_url('/admin/auth/login'))->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Email tidak tidak sesuai!');
            return redirect()->to(base_url('/admin/auth/login'))->withInput();
        }
    }

    function gotoNextPageIfExists($data) {
        if (isset($data['next'])) {
            $next = $data['next'];
            return redirect()->to(base_url($next));
        }
    }
}
