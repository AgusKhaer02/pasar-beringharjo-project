<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\PostModel;

class Post extends BaseController
{

    protected $postModel;
    function __construct(){
        $this->postModel = new PostModel();
    }
    public function detail($slug): string
    {
        $data = [
            "recommendedPost" => $this->postModel->getPost(),
            "post" => $this->postModel->detailPost($slug),
        ];
        return view('frontend/pages/post/detail', $data);
    }
}
