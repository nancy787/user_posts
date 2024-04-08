@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    <!-- Example of a logout button in a Blade view or layout file -->
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div>
                      <a href=" {{route('posts.index') }}"> See All your posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
