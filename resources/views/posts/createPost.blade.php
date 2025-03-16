@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Create Post
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
                
                <form action="{{ route('createPostAction') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea class="form-control" id="body" name="body" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Post</button>

                    <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection