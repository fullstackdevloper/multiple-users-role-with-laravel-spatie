<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository extends BaseRepository
{
    /**
     * Constructor for the PostRepository.
     *
     * @param  Post  $post
     * @return void
     */
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }

    /**
     * Add a new post.
     *
     * @param  array  $post
     * @return mixed
     */
    public function addPost(array $post)
    {
        return $this->create(['name' => $post['name'], 'description' => $post['description']]);
    }

    /**
     * Update an existing post.
     *
     * @param  array  $post_data
     * @param  int  $post
     * @return mixed
     */
    public function updatePost(array $post_data, $post)
    {
        return $this->updateByCriteria(['id' => $post], ['name' => $post_data['name'], 'description' => $post_data['description']]);
    }
}
