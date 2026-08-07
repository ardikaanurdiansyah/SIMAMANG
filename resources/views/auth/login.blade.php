@extends('layouts.app')

@section('title', 'Login - SIMAMANG')
@section('body_class', 'narrow')

@section('content')

<h2>Login SIMAMANG</h2>

@if ($errors->any())
    <div class="alert-error">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>

    <div class="form-group">
        <label>Password</label><br>
        <input type="password" name="password" required>
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="remember">
            Ingat Saya
        </label>
    </div>

    <button type="submit">Login</button>
</form>

@endsection