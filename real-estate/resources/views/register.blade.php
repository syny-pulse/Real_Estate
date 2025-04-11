@extends('layouts.app')
@section('content')

<style>
    .form-container {
        max-width: 32rem;
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
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .error-container {
        background-color: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
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
        margin-bottom: 1rem;
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
        <h2 class="page-title">Create Your Account</h2>
        
        @if ($errors->any())
            <div class="error-container">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{route('register.store')}}" enctype="multipart/form-data" class="form-card">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-input" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-input" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="number" name="phone" id="phone" class="form-input" value="{{ old('phone') }}" required>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" rows="3" class="form-input">{{ old('address') }}</textarea>
            </div>

            <div class="form-group">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-input" required>
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Property Owner</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="profile_image" class="form-label">Profile Image</label>
                <input type="file" name="profile_image" id="profile_image" class="form-input" required>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-button">
                    Register
                </button>
            </div>
            
            <p class="form-footer">
                By submitting this form, I am agreeing to the PropertyFinder 
                <a href="{{route('legal.terms')}}" class="link">Terms</a> and 
                <a href="{{route('privacy.policy')}}" class="link">Privacy Policy</a>
            </p>
            
            <div class="form-footer" style="margin-top: 1rem;">
                Already have an account? <a href="{{route('login.show')}}" class="link">Login</a>
            </div>
        </form>
    </div>
</section>

@endsection