@extends('layouts.page')

@section('tab-title', 'Sign In')

@section('content')
<section class="vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center d-flex align-items-center justify-content-center">
                <div>
                    <img class="img-fluid w-75" src="{{asset('assets/img/illustrations/404.svg')}}" alt="404 not found">
                    <h1 class="mt-5">Page not <span class="fw-bolder text-primary">found</span></h1>
                    <p class="lead my-4">Oops! Looks like you followed a bad link. If you think this is a problem with us, please tell us.</p>
                    <a href="/" class="btn btn-gray-800 d-inline-flex align-items-center justify-content-center mb-4">
                        <i class="fa-solid fa-arrow-left-long fa-fw"></i>
                        Back to homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@section()
