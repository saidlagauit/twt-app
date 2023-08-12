@extends('layouts.app')

@section('title', 'Tweet - Status')

@section('content')
    <div class="col-md-8 mx-auto">
        <div class="single-page bg-body-tertiary p-3 rounded">

            @auth
                @if (auth()->user()->id === $tweet->user_id)
                    <a href="{{ route('tweets.edit', $tweet) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('tweets.destroy', $tweet) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                    </form>
                @endif
            @endauth

            <p>{!! Parsedown::instance()->text($tweet->content) !!}</p>
            <strong>Posted by {{ $tweet->user->name }} on {{ $tweet->created_at->format('Y-m-d') }}</strong>

            @auth
                <form class="border-top border-bottom py-2 my-2" action="{{ route('comments.store', $tweet) }}" method="POST"
                    autocomplete="off">
                    @csrf

                    <div class="input-group">
                        <textarea id="createContent" name="content" class="form-control @error('content') is-invalid @enderror"
                            placeholder="Write a comment..."></textarea>
                        <button type="submit" class="btn btn-primary">Post Comment</button>
                    </div>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </form>
            @endauth

            @if ($tweet->comments->count() > 0)
                <div class="mt-4">
                    <h2 class="mb-3">Comments</h2>
                    <ul class="list-group">
                        @foreach ($tweet->comments as $comment)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="mb-1">{{ $comment->content }}</p>
                                        <small class="text-muted">Commented by {{ $comment->user->name }} on
                                            {{ $comment->created_at->format('Y-m-d H:i:s') }}</small>
                                    </div>
                                    @auth
                                        @if (auth()->user()->id === $comment->user_id)
                                            <form action="{{ route('comments.destroy', [$tweet, $comment]) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p>No comments yet.</p>
            @endif


        </div>
    </div>

@endsection
