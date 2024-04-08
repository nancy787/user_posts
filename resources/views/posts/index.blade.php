@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <a  class="btn btn-primary float-right" href="{{route('home')}}">Back to dashboard</a>
    </div>
    <div class="container mt-5">
        <h2 class="text-center mb-4">All Posts</h2>
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                        </div>
                        @if (Auth::check() && Auth::user()->role === 'admin')
                            <div class="card-footer bg-transparent border-top-0">
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination links -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
