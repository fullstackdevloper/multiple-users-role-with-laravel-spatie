<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Posts;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PostsController extends Controller
{

    protected $postRepository;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function index(){
        $posts = $this->postRepository->getPaginatePosts();
        return view('posts.index',compact('posts'));
    }

    public function create(){
        return view('posts.create');
        
    }
    public function add(CreatePostRequest $request){
        $post_data = $request->validated();
        $post = $this->postRepository->addPost($post_data);
        if($post){
            return redirect()->back()->with(['status'=>'success','message'=>'Post added successfully!']);
        }else{
            return redirect()->back()->with(['status'=>'error','message'=>'Error occured!']);
        }
    }

    public function edit($post){
        $posts = Posts::find($post);
        return view('posts.edit',compact('posts'));
    }
    public function update(CreatePostRequest $request, $post){
        $post_data = $request->validated();
        $update_post = $this->postRepository->updatePost($post_data,$post);
        if($update_post){
            return redirect()->back()->with(['status'=>'success','message'=>'Post Updated Successfully!']);
        }else{
            return redirect()->back()->with(['status'=>'error','message'=>'Error occured!']);
        }
    }
    public function destroy($post){
        $post_del = $this->postRepository->destroyPost($post);
        if($post_del){
            return redirect()->back()->with(['status'=>'success','message'=>'Post Deletion Successfull!']);
        }else{
            return redirect()->back()->with(['status'=>'error','message'=>'Error occured!']);
        }
    }
}
