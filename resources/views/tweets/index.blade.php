@extends('layouts.app')

@section('title', 'Tweet - Home')

@section('content')
    <div class="container">

        <div class="col-md-6 mx-auto">

            <ul class="list-group">
                @foreach ($tweets as $tweet)
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-2">
                        <p class="card-text m-0 fw-bold">{{ Str::limit($tweet->content, 25) }} - {{ $tweet->created_at->diffForHumans() }}</p>
                        <span class="badge rounded-pill">
                            <a href="{{ route('tweets.show', $tweet) }}" class="btn btn-info">Read more</a>
                        </span>
                    </li>
                @endforeach
            </ul>

        </div>
    </div>
@endsection
