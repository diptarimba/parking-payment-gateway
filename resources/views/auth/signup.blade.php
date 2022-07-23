@extends('layouts.main')

@section('tab-title', 'Sign Up')

@section('body')

    <main>

        <section class="mt-5 mt-lg-5 mb-5 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image"
                    data-background-lg="../../assets/img/illustrations/signin.svg">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Create Account</h1>
                            </div>
                            {{-- Success Alert --}}
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
                            <form action="{{ route('register.post') }}" class="mt-4" method="POST">
                                @csrf
                                <!-- Form -->
                                <div class="form-group mb-4"><label for="name">Name</label>
                                    <div class="input-group"><span class="input-group-text" id="basic-addon1">
                                            <i class="fa-solid fa-user"></i>
                                        </span><input type="text" name="name" class="form-control"
                                            placeholder="John Doe" id="name" autofocus required></div>
                                </div><!-- End of Form -->
                                <!-- Form -->
                                <div class="form-group mb-4"><label for="username">Username</label>
                                    <div class="input-group"><span class="input-group-text" id="basic-addon1">
                                            <i class="fa-solid fa-user-pen"></i>
                                        </span><input type="text" name="username" class="form-control" placeholder="John"
                                            id="username" autofocus required></div>
                                </div><!-- End of Form -->
                                <!-- Form -->
                                <div class="form-group mb-4"><label for="email">Your Email</label>
                                    <div class="input-group"><span class="input-group-text" id="basic-addon1">
                                            <i class="fa-solid fa-envelope"></i>
                                        </span><input type="email" name="email" class="form-control"
                                            placeholder="example@company.com" id="email" autofocus required></div>
                                </div><!-- End of Form -->
                                <div class="form-group">
                                    <!-- Form -->
                                    <div class="form-group mb-4"><label for="password">Your Password</label>
                                        <div class="input-group"><span class="input-group-text" id="basic-addon2">
                                                <i class="fa-solid fa-lock"></i>
                                            </span><input type="password" name="password" placeholder="Password"
                                                class="form-control" id="password" required></div>
                                    </div><!-- End of Form -->
                                    <!-- Form -->
                                    <div class="form-group mb-4"><label for="password_confirmation">Confirm Password</label>
                                        <div class="input-group"><span class="input-group-text" id="basic-addon2">
                                                <i class="fa-solid fa-lock"></i>
                                            </span><input type="password" name="password_confirmation"
                                                placeholder="Confirm Password" class="form-control"
                                                id="password_confirmation" required></div>
                                    </div><!-- End of Form -->
                                    <div class="mb-4">
                                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                                value="" id="remember">
                                            <label class="form-check-label fw-normal mb-0" for="remember">I agree to the <a
                                                    href="#" class="fw-bold">terms and conditions</a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid"><button type="submit" class="btn btn-gray-800">Sign up</button></div>
                            </form>
                            <div class="d-flex justify-content-center align-items-center mt-4"><span
                                    class="fw-normal">Already have an
                                    account? <a href="{{route('login.index')}}" class="fw-bold">Login here</a></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
