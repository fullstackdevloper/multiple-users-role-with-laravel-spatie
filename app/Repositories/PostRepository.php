<?php

namespace App\Repositories;

use App\Models\Posts;

class PostRepository extends BaseRepository
{


    public function __construct(Posts $post)
    {
        parent::__construct($post);
    }

    public function getPaginatePosts()
    {
        $posts = $this->paginate(10);
        return $posts;
    }

    public function addPost($post)
    {
        $add_post = $this->create(['name'=>$post['name'],'description'=>$post['description']]);

        return $add_post;
    }

    public function updatePost($post_data,$post){
        $update = $this->updateByCriteria(['id'=>$post],['name'=>$post_data['name'],'description'=>$post_data['description']]);
        return $update;
    }

    public function destroyPost($post)
    {
        $post = $this->deleteById($post);
        return $post;
    }
}