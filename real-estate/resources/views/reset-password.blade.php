@extends('layouts.app')
@section('content')

    <style>
        .form-container {
            max-width: 28rem;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .page-section {
            padding-top: 4rem;
            padding-bottom: 4rem;
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 1rem;
            text-align: center;
        }

        .page-subtitle {
            font-size: 1rem;
            color: #6b7280;
            text-align: center;
            margin-bottom: 2rem;
        }

        .error-container {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .success-container {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .error-list {
            list-style-type: disc;
            padding-left: 1.25rem;
        }

        .form-card {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: #374151;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }

        .submit-button {
            width: 100%;
            padding: 0.75rem;
            background-color: #1e40af;
            color: white;
            font-weight: 500;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .submit-button:hover {
            background-color: #1e3a8a;
        }

        .form-footer {
            font-size: 0.875rem;
            color: #4b5563;
            text-align: center;
            margin-top: 1rem;
        }

        .link {
            color: #1e40af;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }
    </style>

    <section class="page-section">
        <div class="form-container">
            @if ($errors->any())
                <div class="error-container">
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="success-container">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.send') }}" class="form-card">
                @csrf
                <h2 class="page-title">Forgot Password</h2>
                <p class="page-subtitle">Please enter your account email to reset your password</p>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-input" value="{{ old('email') }}"
                        required>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-button">
                        Send Reset Link
                    </button>
                </div>

                <div class="form-footer">
                    Remember your password? <a href="{{ route('login.show') }}" class="link">Back to Login</a>
                </div>
            </form>
        </div>
    </section>

@endsection
