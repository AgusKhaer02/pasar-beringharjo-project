<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;

class Gallery extends BaseController
{
    // protected $postModel;
    // function __construct(){
    //     $this->postModel = new PostModel();
    // }
    public function index(): string
    {
        // $data = [
        //     "recommendedPost" => $this->postModel->getPost(),
        //     "post" => $this->postModel->detailPost($slug),
        // ];
        return view('frontend/pages/gallery/gallery');
    }
}
