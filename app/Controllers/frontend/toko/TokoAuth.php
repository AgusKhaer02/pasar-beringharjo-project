<?php

namespace App\Controllers\Frontend\Toko;

use App\Controllers\BaseController;
use App\Models\Frontend\Toko\AuthModel;
use App\Models\Frontend\Toko\TokoEmailConfirm;
use CodeIgniter\I18n\Time;
use Config\Services;

class TokoAuth extends BaseController
{

    protected $authModel;
    protected $emailSMTP;
    protected $emailConfirm;

    function __construct()
    {
        $this->authModel = new AuthModel();
        $this->emailConfirm = new TokoEmailConfirm();
        $this->emailSMTP = Services::email();
    }
    function login()
    {
        if (session('id_toko') && session('email')) {
            return redirect()->to(base_url('toko/home'));
        }
        return view('frontend/pages/toko/auth/login');
    }

    function register()
    {
        return view('frontend/pages/toko/auth/register');
    }

    public function submitRegister()
    {
        $data = $this->request->getVar();
        if ($this->checkExistingEmail($data['email'])) {
            session()->setFlashdata("error", "Email sudah terdaftar dalam sistem ini");
            return redirect()->to(base_url('/toko/auth/register'))->withInput();
        }
        $uuid = service('uuid');
        $uuid4 = $uuid->uuid4();
        $dataRegister = [
            'id_toko' => $uuid4->toString(),
            'name' => $data['name'],
            'slug' => url_title($data['name'], '-', true),
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            // NEXT UPGRADE
            'id_lokasi' => 1,
            "verified" => 0
        ];

        $insert = $this->authModel->insert($dataRegister);
        // dd($insert);
        // buat mendeteksi apa yang sebenernya terjadi di query sebelumnya
        // $lastQuery = $this->authModel->getLastQuery();

        // save() ini untuk insert/update
        // save() akan update jika kolom yang primarykey disisipi nilai oleh kita
        // sedangkan save() akan menyimpan data baru ketika kolom yang primary key tidak di sisipi nilai alias NULL

        if ($insert == 0) {
            $confirmCode = $this->makeConfirmationCode($uuid4->toString());
            if (!$confirmCode) {
                session()->setFlashdata("error", "Kesalahan tak terduga");
                return redirect()->to(base_url('/toko/auth/register'));
            }
            $this->emailSMTP->setFrom("aguskkhaer@gmail.com", "Pasar Beringharjo");
            $this->emailSMTP->setTo($data['email']);

            $this->emailSMTP->setSubject("Verifikasi Email Anda | Pasar Beringharjo");
            $this->emailSMTP->setMessage("Terima kasih telah mendaftarkan toko anda di platform kami\nSilahkan konfirmasi email terlebih dahulu sebelum masuk ke halaman berikutnya\n <a href='" . base_url('toko/auth/confirm-email/' . $confirmCode) . "'>Konfirmasi Email</a>\nMohon ABAIKAN jika bukan anda");

            $this->emailSMTP->send();
            return redirect()->to(base_url('/toko/auth/success-register'));
        } else {
            session()->setFlashdata("error", "Tidak dapat register, pastikan anda input form dengan benar");
            return redirect()->to(base_url('/toko/auth/register'))->withInput();
        }
    }

    public function checkExistingEmail($email): bool
    {
        $this->authModel->where("email", $email);
        $this->authModel->select("email");
        $res = $this->authModel->first();

        return ($res !== null);
    }


    function resendEmailConfirm($idToko)
    {
        $remake = $this->makeConfirmationCode($idToko);
        if (!$remake) {
            session()->setFlashdata('error', 'Konfirmasi Email Gagal, silahkan coba lagi');
            return redirect()->to(base_url('/toko/auth/resend-email'));
        }

        session()->setFlashdata('success ', 'Berhasil! Anda boleh masuk ke tahap selanjutnya');
        return redirect()->to(base_url('/toko/auth/login'))->withInput();
    }

    function makeConfirmationCode($idToko)
    {
        $uuid = service('uuid');
        $uuid4 = $uuid->uuid4();
        // helper('time');
        // Get the current date and time
        $currentDateTime = Time::now('Asia/Jakarta', 'id_ID');

        // Add 30 minutes
        $newTime = $currentDateTime->addMinutes(15);

        $data = [
            "id_toko" => $idToko,
            "code" => $uuid4->toString(),
            "expired_at" => $newTime->toLocalizedString()
        ];

        $result = $this->emailConfirm->save($data);
        if ($result) {
            return $uuid4->toString();
        }

        return false;
    }

    public function authenticate()
    {
        $data = $this->request->getVar();

        $dataToko = $this->authModel->findToko($data['email']);
        if ($dataToko != null) {
            // cek apakah akun dari toko ini sudah konfirmasi email?
            if ($dataToko['verified'] == 0) {
                session()->setFlashdata('error', 'Sepertinya anda belum mengkonfirmasi email, silahkan cek email anda');
                return redirect()->to(base_url('/toko/auth/login'))->withInput();
            }

            $this->deleteExpiredToken($dataToko['id_toko']);

            // pengecekan password dari form input dengan password dari table admin
            $authenticatePassword = password_verify($data['password'], $dataToko['password']);
            if ($authenticatePassword) {

                $dataSession = [
                    "id_toko" => $dataToko['id_toko'],
                    "email" => $dataToko['email'],
                ];

                session()->set($dataSession);

                // kalo semialkan mau pindah ke halaman berikutnya, jadi nggak harus lewat home dulu!
                if (isset($data['next'])) {
                    $next = $data['next'];
                    return redirect()->to(base_url($next));
                }

                return redirect()->to(base_url('/toko/home'));
            } else {
                session()->setFlashdata('error', 'Password terdaftar dalam sistem kami, silakan daftarkan diri anda!');
                return redirect()->to(base_url('/toko/auth/login'))->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Email terdaftar dalam sistem kami, silakan daftarkan diri anda!');
            return redirect()->to(base_url('/toko/auth/login'))->withInput();
        }
    }

    public function successRegister()
    {
        return view('frontend/pages/toko/auth/success-register');
    }

    public function confirmEmail($code)
    {
        $currentDateTime = Time::now('Asia/Jakarta', 'id_ID');

        $this->emailConfirm->where('code', $code);
        $this->emailConfirm->select();
        $res = $this->emailConfirm->first();

        $data = $this->authModel->find($res['id_toko']);


        $sessionData = [
            "id_toko" => $data['id_toko'],
            "email" => $data['email'],
        ];

        if ($res) {
            // gagal, jika kode konfirmasi sudah kadaluarsa
            if (strtotime($res['expired_at']) < strtotime($currentDateTime)) {
                $this->emailConfirm->where('code', $code)->delete();
                session()->setFlashdata('error', 'Link Konfirmasi Email Telah Kadaluarsa, silahkan kirim kembali link konfirmasi email anda');
                return view('frontend/pages/toko/auth/email_confirmation_status');
            }

            $this->authModel->update($res['id_toko'], ["verified" => 1]);

            $this->emailConfirm->where('code', $code)->delete();
            session()->set($sessionData);
            session()->setFlashdata('success', 'Link Konfirmasi Email Berhasil, anda boleh masuk ke tahap berikutnya');
            return view('frontend/pages/toko/auth/email_confirmation_status');
        } else {
            session()->setFlashdata('error', 'Link konfirmasi sudah tidak valid');
            return view('frontend/pages/toko/auth/email_confirmation_status');
        }
    }


    function deleteExpiredToken($idToko)
    {
        $where = [
            'expired_at < NOW()',
            'id_toko' => $idToko,
        ];
        $this->emailConfirm->where($where)->delete();
    }
}
