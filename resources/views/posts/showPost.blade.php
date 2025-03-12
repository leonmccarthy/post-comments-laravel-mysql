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
          <ul class="list-group list-group-flush">
            <h5>Comments</h5>
            @foreach ($comments as $comment)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div>
                        <p class="text-reset text-decoration-none fw-bold">{{ $comment->body }}</p>
                    </div>
                    <span class="text-sm text-gray-600">
                        {{ $comment->created_at->diffForHumans() }} by {{ $comment->user->name }}
                    </span> 
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