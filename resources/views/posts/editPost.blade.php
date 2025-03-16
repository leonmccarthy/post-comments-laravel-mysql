@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="card">
        <div class="card-header">
            Edit Post
        </div>
        <div class="card-body">

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

   
         <form action="{{ route('editPostAction', $post) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea class="form-control" id="body" name="body" rows="5">{{ $post->body }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Edit Post</button>

            <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
        </form>

          <ul class="list-group list-group-flush">
            <h5 class="my-3">Comments</h5>
            
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