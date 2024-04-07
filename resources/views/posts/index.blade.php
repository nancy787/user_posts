@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="card-text">{{ $post->content }}</p>
                </div>
                @if (Auth::check() && Auth::user()->role === 'admin')
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
             @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Pagination links -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    {{ $posts->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection