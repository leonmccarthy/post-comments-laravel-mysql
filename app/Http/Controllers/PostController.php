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
            'comments'=>$post->comment()->with('user')->paginate(5)
        ]);

        // return dd( $id);

    }
}
