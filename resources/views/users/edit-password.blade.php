@extends('layouts.app')

@section('title', 'Edit Password')

@section('content')
    <div class="container">
        <h2>Edit Password for {{ $user->name }}</h2>
        <form action="{{ route('users.update.password', $user->username) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
@endsection
