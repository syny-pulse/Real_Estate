@extends('layouts.app')
@section('content')

@if ($errors->any())
    <div class="">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{route('register.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="">
        <p>Register as a Property Owner</p>
        <label for="name" class="">Name</label>
        <input type="text" name="name" id="name" class="" value="{{ old('name') }}" required>
    </div>

    <div class="">
        <label for="email" class="">Email</label>
        <input type="email" name="email" id="email" class="" value="{{ old('email') }}" required>
    </div>

    <div class="">
        <label for="password" class="">Password</label>
        <input type="password" name="password" id="password" class="" required>
    </div>

    <div class="">
        <label for="phone" class="">Phone Number</label>
        <input type="number" name="phone" id="phone" class="" value="{{ old('phone') }}"required>
    </div>

    <div class="">
        <label for="address" class="">Address</label>
        <textarea name="address" id="address" rows="3" class="">{{ old('address') }}</textarea>
    </div>

    <div class="">
        <label for="role" class="">Role</label>
        <select name="role" id="role" class="" required>
            <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
            <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Property Owner</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>

    <div class="">
        <label for="profile_image" class="">Profile Image</label>
        <input type="file" name="profile_image" id="profile_image" class=""required>
    </div>

    <div class="">
        <button type="submit" class="">
            Submit
        </button>
    </div>
    <p>Already a Property Owner on PropertyFinder, please <a href = "{{route('login.show')}}">login here</a></p>
    <p>By submitting this form, i am agreeing to the PropertyFinder <a href = "{{route('legal.terms')}}">Terms</a> and <a href = "{{route('privacy.policy')}}">privacy policy</a></p>
</form>
@endsection
