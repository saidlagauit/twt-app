@extends('layouts.app')

@section('title', 'Edit Profile - ' . $user->name)

@section('content')
    <div class="container">
        <h1>Edit Profile</h1>

        <form action="{{ route('users.update', $user->username) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="{{ route('users.edit.password', $user->username) }}" class="btn btn-outline-secondary">Edit Password</a>

        </form>
    </div>
@endsection
