@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="profile">
        <h1>Welcome, {{ $user->name }}</h1>
        <!-- Other profile content here -->

        <div class="mt-3">
            <a href="{{ route('users.edit', $user->username) }}" class="btn btn-primary">Edit Profile</a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                Delete Profile
            </button>
        </div>
    </div>

    <!-- Display user's tweets -->
    <div class="mt-5">
        <h2>{{ $user->name }}'s Tweets</h2>
        @if ($tweets->count() > 0)
        <div class="row g-3">
            @foreach ($tweets as $tweet)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">{{ Str::limit($tweet->content, 50) }}</p>
                            <small class="text-muted">Posted on {{ $tweet->created_at->format('Y-m-d H:i:s') }}</small>
                            <div class="mt-3">
                                <a href="{{ route('tweets.show', $tweet) }}" class="btn btn-primary">Show</a>
                                @auth
                                    @if (auth()->user()->id === $tweet->user_id)
                                        <a href="{{ route('tweets.edit', $tweet) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('tweets.destroy', $tweet) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this tweet?')">Delete</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <p>No tweets yet.</p>
        @endif
    </div>


    <!-- Delete Profile Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete your profile? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('users.delete', $user->username) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
