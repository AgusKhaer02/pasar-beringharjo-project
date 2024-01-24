<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table            = 'post';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id','title','id_author','slug','content','tags','img','status','created_at','updated_at'];
    
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function getPost() {
        $this->select("post.id, CASE WHEN length(post.title) > 50 THEN CONCAT(SUBSTRING(post.title, 1, 50), '...') ELSE post.title end as title, post.img, post.slug, CASE WHEN length(post.content) > 100 THEN CONCAT(SUBSTRING(post.content, 1, 100), '...') ELSE post.content end as content, user.fullname, post.created_at, post.updated_at, post.status");
        $this->join('user','user.id = post.id_author');
        $data = $this->findAll();
        foreach ($data as $index => $value) {
            $timestamp = strtotime($data[$index]['created_at']);
            $namedDateTime = date("l, F j, Y g:i A", $timestamp);
            $data[$index]['created_at'] =  $namedDateTime;
            $data[$index]['img'] = base_url('images/post/'. $value['img']);
        }

        return $data;
    }

    function detailPost($slug) {
        $this->where('slug',$slug);
        $data = $this->first();
        $timestamp = strtotime($data['created_at']);
        $namedDateTime = date("l, F j, Y g:i A", $timestamp);
        $data['created_at'] = $namedDateTime;
        $data['img'] = base_url('images/post/'. $data['img']);

        return $data;
    }
}
