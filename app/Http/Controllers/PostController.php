<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'title'=> ['required', 'max:100', 'string'],
            'body'=> ['required', 'string'],
        ]);

        Post::create([...$data, 
            'user_id'=> $request->user()->id
        ]);

        return to_route('posts.index')->with('success', 'Post Created Successfully');
    }

    // DELETE POST
    public function deletePost(Post $post){
        $post->delete();
        return to_route('posts.index')->with('success', 'Post Deleted Successfully');
    }

    // EDIT POST VIEW
    public function editPostView(Post $post){
        if(Auth::user()->id==$post->user_id){
            return view('posts.editPost', [
                'post'=> $post,
                'comments'=>$post->comment()->with('user')->paginate(5)
            ]);
        }else{
            return redirect()->back();
        }
    }

    // EDIT POST ACTION
    public function editPostAction(Request $request, Post $post){
        $data = $request->validate([
            'title'=>['required', 'max:100', 'string'],
            'body'=>['required', 'string']
        ]);

        $post->update($data);

        return to_route('showPost', $post)->with('success', 'Post Updated successfully');
    }
}
