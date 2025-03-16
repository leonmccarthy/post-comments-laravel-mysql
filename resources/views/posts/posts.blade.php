@extends('layouts.app')

@section('content')
<div class="container ">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <ul class="list-group list-group-flush">

        {{-- LOOPING THROUGH POST --}}
        @foreach ($posts as $post)
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div>
                    <a href="{{ route('showPost', $post) }}" class="text-reset text-decoration-none fw-bold">{{ $post->title }}</a>
                </div>
                <span class="text-sm text-gray-600">
                    {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}
                </span> 

                {{-- DELETE POST --}}
                    @auth
                        @if (Auth::user()->id == $post->user_id)
                            <form action="{{ route('deletePost', $post) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    @endauth
            </div>
            
        </li>
            
        @endforeach
    </ul>

    {{-- FOR PEVIOUS AND NEXT PAGE --}}
    <div>
        {{  $posts->links('pagination::bootstrap-5') }}
    </div>
</div>

    
@endsection