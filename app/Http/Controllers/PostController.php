<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //SHOW ALL POST
    public function index(){
        return view('posts.posts', [
            'posts' => Post::latest()->with('user')->paginate(10)
        ]);
    }

    // SHOW ONE POST
    public function showPost(Post $post){
        return view('posts.showPost', [
            'post'=> $post,
            'comments'=>$post->comment()->latest()->with('user')->paginate(5)
        ]);
    }

    // CREATE POST VIEW
    public function createPostView(){
        return view('posts.createPost');
    }

    // CREATE POST ACTION
    public function createPostAction(Request $request){
        $data = $request->validate([
            'title'=> ['required', 'max:50', 'string'],
            'body'=> ['required', 'string'],
        ]);

        Post::create([...$data, 
            'user_id'=> $request->user()->id
        ]);

        return to_route('posts.index')->with('success', 'Post Created Successfully');
    }
}
