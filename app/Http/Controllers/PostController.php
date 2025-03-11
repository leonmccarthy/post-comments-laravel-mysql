<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(){
        return view('posts.posts', [
            'posts' => Post::latest()->with('user')->paginate(10)
        ]);
    }
}
