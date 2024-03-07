<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use App\Repositories\PostRepository;

class PostsController extends Controller
{
    protected $postRepository;
    protected $limit = 10;

    /**
     * Constructor for the PostsController.
     *
     * @param  PostRepository  $postRepository
     * @return void
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = $this->postRepository->paginate($this->limit);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  CreatePostRequest  $createPostRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePostRequest $createPostRequest)
    {
        $this->postRepository->addPost($createPostRequest->all());
        return redirect()->route('post.list')->with(['status' => 'success', 'message' => 'Post added successfully!']);
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  Post  $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     *
     * @param  CreatePostRequest  $createPostRequest
     * @param  Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CreatePostRequest $createPostRequest, Post $post)
    {
        $update_post = $this->postRepository->updatePost($createPostRequest->all(), $post->id);
        return redirect()->back()->with(['status' => 'success', 'message' => 'Post Updated Successfully!']);
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $this->postRepository->deleteById($post->id);
        return redirect()->back()->with(['status' => 'success', 'message' => 'Post Deletion Successfull!']);
    }
}
