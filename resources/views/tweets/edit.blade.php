@extends('layouts.app')

@section('title', 'Tweet - Edit')

@section('content')
    <div class="container">
        <form action="{{ route('tweets.update', $tweet) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="content" class="form-label h1">Edit Tweet</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4" required>{{ $tweet->content }}</textarea>
                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
