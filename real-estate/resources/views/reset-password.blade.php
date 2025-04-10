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
<form method="POST" action="{{route('password.send')}}">
    @csrf
    <p>Forgot Password</p>
    <p>Please enter your account email to reset your password</p>
    <div class="">
        <label for="email" class="">Email</label>
        <input type="email" name="email" id="email" class="" value="{{ old('email') }}" required>
    </div>

    <div class="">
        <button type="submit" class="">
            Send
        </button>
    </div>
</form>
@endsection

