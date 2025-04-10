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
<form method="POST" action="{{route('login.check')}}">
    @csrf
    <div class="">
        <label for="email" class="">Email</label>
        <input type="email" name="email" id="email" class="" value="{{ old('email') }}" required>
    </div>

    <div class="">
        <label for="password" class="">Password</label>
        <input type="password" name="password" id="password" class="" required>
    </div>
    <p><a href="{{route('password.request')}}">Forgot Password?</a></p>
    <div class="">
        <button type="submit" class="">
            Login
        </button>
    </div>
</form>
@endsection

