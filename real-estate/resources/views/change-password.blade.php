@extends('layouts.app')

@section('content')
<section class="page-section">
    <div class="form-container">
        <h2 class="page-title">Reset Your Password</h2>

        @if ($errors->any())
            <div class="error-container">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('password.update')}}" class="form-card">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-input" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="confirm-password" class="form-label">New Password</label>
                <input type="confirm-password" name="password" id="confirm-password" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label"> Confirm New Password</label>
                <input type="password" name="confirm-password" id="password" class="form-input" required>
            </div>
            <div class="form-group">
                <button type="submit" class="submit-button">
                    Reset Password
                </button>
            </div>

@endsection
