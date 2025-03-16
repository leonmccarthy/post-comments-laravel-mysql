@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card">
        <div class="card-header">
            Post
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <span class="text-sm text-gray-600">
            {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}
          </span> 
          <p class="card-text">{{ $post->body }}</p>
          
          <div class="row align-items-start my-2">
                @auth
                    @if (Auth::user()->id == $post->user_id)

                    <div class="col-4">
                        {{-- EDIT POST ROUTE--}}
                        <a href="{{ route('editPostView', $post) }}" class="btn btn-primary">Edit Post</a>
                    </div>

                    <div class="col-4">
                        {{-- DELETE POST --}}
                        <form action="{{ route('deletePost', $post) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete Post</button>
                        </form>
                    </div>
                        
                    @endif
                @endauth

          </div>

          <ul class="list-group list-group-flush">
            <h5>Comments</h5>

                 {{-- ERROR VALIDATION MESSAGE --}}
                 @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                 @endif

                {{-- ADDING COMMENT --}}
                <form action="{{ route('createComment', $post) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="body" class="form-label">Write Comment</label>
                        <textarea class="form-control" id="body" name="body" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            
            @foreach ($comments as $comment)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>
                        <p class="text-reset text-decoration-none fw-bold">{{ $comment->body }}</p>
                    </div>
                    <span class="text-sm text-gray-600">
                        {{ $comment->created_at->diffForHumans() }} by {{ $comment->user->name }}
                    </span> 

                    {{-- DELETE COMMENT --}}
                    @auth
                        @if (Auth::user()->id == $comment->user_id)
                            <form action="{{ route('deleteComment', ['post'=>$post, 'comment'=>$comment]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    @endauth
                    
                    
                </div>
            </li> 
            @endforeach
        </ul>
        <div>
            {{  $comments->fragment('comments')->links('pagination::bootstrap-5') }}
        </div>
        </div>
    </div>
</div>

    
@endsection