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

        .form-input.is-invalid {
            border-color: #ef4444;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
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

        .hidden {
            display: none;
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

            <form method="POST" action="{{ route('password.update') }}" class="form-card">
                @csrf
                <h2 class="page-title">Reset Password</h2>
                <p class="page-subtitle">Please enter your new password</p>

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" class="form-input @error('email') is-invalid @enderror"
                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                        readonly>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-input @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-input" name="password_confirmation" required
                        autocomplete="new-password" oninput="checkPasswordMatch()">
                    <span id="password-match-message" class="invalid-feedback" style="display: none;">
                        <strong>Passwords do not match</strong>
                    </span>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-button" id="submit-button">
                        Reset Password
                    </button>
                </div>

                <script>
                    function checkPasswordMatch() {
                        const password = document.getElementById('password').value;
                        const confirmPassword = document.getElementById('password-confirm').value;
                        const messageElement = document.getElementById('password-match-message');
                        const submitButton = document.getElementById('submit-button');

                        if (password === confirmPassword) {
                            messageElement.style.display = 'none';
                            submitButton.disabled = false;
                        } else {
                            messageElement.style.display = 'block';
                            submitButton.disabled = true;
                        }
                    }

                    // Also check when the main password field changes
                    document.getElementById('password').addEventListener('input', checkPasswordMatch);
                </script>
            </form>
        </div>
    </section>
@endsection
