<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class TokoAuth implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session('id_toko') || !session('email')) {
            // Get the current URI string
            $currentURI = uri_string();

            // Create a CodeIgniter\HTTP\URI object
            $uriObject = new \CodeIgniter\HTTP\URI($currentURI);

            // Get the full URL as a string
            $fullURL = $uriObject->getPath();

            session()->setFlashdata('error', 'Login untuk melanjutkan');
            return redirect()->to(base_url('/toko/auth/login?next=' . $fullURL));
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}
