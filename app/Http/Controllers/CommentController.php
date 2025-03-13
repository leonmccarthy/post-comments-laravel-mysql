<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CommentController extends Controller
{
    //CREATE COMMENT
    public function createComment(Request $request, Post $post){
        $data = $request->validate([ 'body'=> ['required', 'string', 'max:255'] ]);

        // PASSING THE VALIDATED DATA TO COMMENT
        $post->comment()->create([...$data,
            'user_id'=> $request->user()->id
        ]);

        return to_route('showPost', $post)->withFragment('comments');
    }
}
