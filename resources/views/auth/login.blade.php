@extends('layouts.app')
<<<<<<< HEAD
=======

@section('title', 'Login - SIMAMANG')
@section('body_class', 'narrow')

@section('content')
>>>>>>> 5b1f9aebfb41325aa54517ed974ac4ecd93d3209

@section('content')

<<<<<<< HEAD
<div class="bg-danger text-white p-5 text-center">

    <h1>BOOTSTRAP TEST</h1>

</div>

@endsection

@extends('layouts.app')

@section('title', 'Login SIMAMANG')

@section('content')

<div class="container-fluid min-vh-100 bg-light">

    <div class="row min-vh-100 justify-content-center align-items-center">

        <div class="col-12 col-sm-10 col-md-6 col-lg-4">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">

                        <div class="bg-primary text-white rounded-circle
                                    d-inline-flex align-items-center
                                    justify-content-center mb-3"
                             style="width: 80px; height: 80px;">

                            <i class="bi bi-mortarboard-fill fs-1"></i>

                        </div>

                        <h2 class="fw-bold text-primary">
                            SIMAMANG
                        </h2>

                        <p class="text-secondary mb-0">
                            Sistem Informasi Manajemen Magang
                        </p>

                    </div>


                    @if($errors->any())

                        <div class="alert alert-danger">

                            <i class="bi bi-exclamation-triangle-fill me-2"></i>

                            {{ $errors->first() }}

                        </div>

                    @endif


                    <form
                        method="POST"
                        action="{{ url('/login') }}"
                    >

                        @csrf


                        {{-- USERNAME --}}
                        <div class="mb-3">

                            <label
                                for="username"
                                class="form-label fw-semibold"
                            >
                                Username
                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-white">

                                    <i class="bi bi-person-fill text-primary"></i>

                                </span>

                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    class="form-control"
                                    placeholder="Masukkan username"
                                    value="{{ old('username') }}"
                                    required
                                >

                            </div>

                        </div>


                        {{-- PASSWORD --}}
                        <div class="mb-4">

                            <label
                                for="password"
                                class="form-label fw-semibold"
                            >
                                Password
                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-white">

                                    <i class="bi bi-lock-fill text-primary"></i>

                                </span>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Masukkan password"
                                    required
                                >

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-primary btn-lg rounded-3"
                            >

                                <i class="bi bi-box-arrow-in-right me-2"></i>

                                Login

                            </button>

                        </div>

                    </form>

                </div>

            </div>


            <div class="text-center mt-3">

                <small class="text-secondary">

                    © {{ date('Y') }} SIMAMANG

                </small>

            </div>

        </div>

    </div>

</div>

=======
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

>>>>>>> 5b1f9aebfb41325aa54517ed974ac4ecd93d3209
@endsection