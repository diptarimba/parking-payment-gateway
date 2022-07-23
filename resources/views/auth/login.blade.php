@extends('layouts.main')

@section('tab-title', 'Sign In')

@section('body')

    <main>


        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image"
                    data-background-lg="{{ asset('assets/img/illustrations/signin.svg') }}">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Sign in to Smart Parking</h1>
                            </div>
                            @if (session('success'))
                                <x-alert type="success" msg="{{ session('success') }}" />
                            @endif

                            {{-- Error Alert --}}
                            @if (session('error'))
                                <x-alert type="danger" msg="{{ session('error') }}" />
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible show fade">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('login.post') }}" method="post" class="mt-4">
                                <!-- Form -->
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="username">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa-solid fa-users fa-fw"></i>
                                        </span>
                                        <input type="text" name="username" class="form-control" placeholder="user"
                                            id="username" autofocus required>
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="password">Your Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="fa-solid fa-lock fa-fw"></i>
                                            </span>
                                            <input type="password" name="password" placeholder="Password"
                                                class="form-control" id="password" required>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <div class="d-flex justify-content-between align-items-top mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="remember">
                                            <label class="form-check-label mb-0" for="remember">
                                                Remember me
                                            </label>
                                        </div>
                                        <div>
                                            <a href="./forgot-password.html" class="small text-right">Lost password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gray-800">Sign in</button>
                                </div>
                            </form>
                            {{-- <div class="mt-3 mb-4 text-center">
                            <span class="fw-normal">or login with</span>
                        </div>
                        <div class="d-flex justify-content-center my-4">
                            <a href="#" class="btn btn-icon-only btn-pill btn-outline-gray-500 me-2"
                                aria-label="facebook button" title="facebook button">
                                <i class="fa-brands fa-facebook-f fa-fw"></i>
                            </a>
                            <a href="#" class="btn btn-icon-only btn-pill btn-outline-gray-500 me-2"
                                aria-label="twitter button" title="twitter button">
                                <i class="fa-brands fa-twitter fa-fw"></i>
                            </a>
                            <a href="#" class="btn btn-icon-only btn-pill btn-outline-gray-500"
                                aria-label="github button" title="github button">
                                <i class="fa-brands fa-github fa-fw"></i>
                            </a>
                        </div> --}}
                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <span class="fw-normal">
                                    Not registered?
                                    <a href="{{ route('register.index') }}" class="fw-bold">Create account</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
