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
    <div class="mb-4">
        <label for="name" class="">Name</label>
        <input type="text" name="name" id="name" class="" value="{{ old('name') }}" required>
    </div>

    <div class="mb-4">
        <label for="email" class="">Email</label>
        <input type="email" name="email" id="email" class="" value="{{ old('email') }}" required>
    </div>

    <div class="mb-4">
        <label for="password" class="">Password</label>
        <input type="password" name="password" id="password" class="" required>
    </div>

    <div class="mb-4">
        <label for="phone" class="">Phone Number</label>
        <input type="number" name="phone" id="phone" class="" value="{{ old('phone') }}">
    </div>

    <div class="mb-4">
        <label for="address" class="">Address</label>
        <textarea name="address" id="address" rows="3" class="">{{ old('address') }}</textarea>
    </div>

    <div class="mb-4">
        <label for="role" class="">Role</label>
        <select name="role" id="role" class="">
            <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
            <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Property Owner</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="profile_image" class="">Profile Image</label>
        <input type="file" name="profile_image" id="profile_image" class="">
    </div>

    <div class="">
        <button type="submit" class="">
            Submit
        </button>
    </div>
</form>
@endsection
