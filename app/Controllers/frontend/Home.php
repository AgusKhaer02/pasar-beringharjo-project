<?php

namespace App\Controllers\frontend;

use App\Controllers\BaseController;
use App\Models\PostModel;

class Home extends BaseController
{
    protected $postModel;
    function __construct(){
        $this->postModel = new PostModel();
    }
    public function index(): string
    {
        $data = [
            "recommendedPost" => $this->postModel->getPost(),
            "posts" => $this->postModel->getPost(),
        ];
        return view('frontend/pages/home', $data);
    }
}
