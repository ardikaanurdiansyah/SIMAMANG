@extends('layouts.app')

@section('content')

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

@endsection