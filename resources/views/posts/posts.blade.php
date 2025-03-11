@extends('layouts.app')

@section('content')
<div class="container ">
    <ul class="list-group list-group-flush">
        @foreach ($posts as $post)
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div>
                    <a href="#" class="text-reset text-decoration-none fw-bold">{{ $post->title }}</a>
                </div>
                <span class="text-sm text-gray-600">
                    {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}
                </span> 
            </div>
            
        </li>
            
        @endforeach
    </ul>
    <div>
        {{  $posts->links('pagination::bootstrap-5') }}
    </div>
</div>

    
@endsection