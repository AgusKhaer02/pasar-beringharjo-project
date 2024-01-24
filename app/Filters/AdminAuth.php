<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get the current URI string
        $currentURI = uri_string();

        // Create a CodeIgniter\HTTP\URI object
        $uriObject = new \CodeIgniter\HTTP\URI($currentURI);

        // Get the full URL as a string
        $path = rtrim($uriObject->getPath(),'/');


        // jika berada di url login
        if ($path == "admin/auth" || $path == "admin/auth/login") {
            // jika ada info admin di session
            if (session('id_admin') && session('username')) {
                // langsung ke halaman dashboard
                return redirect()->to(base_url('/admin/dashboard/'));
            }
            return;
        }

        // cek ada idadmin atau tidak, jika tdak ada, masuk ke hal login dulu
        if (!session('id_admin') || !session('username')) {
            session()->setFlashdata('error', 'Login untuk melanjutkan');
            return redirect()->to(base_url('/admin/auth/login?next=' . $path));
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
