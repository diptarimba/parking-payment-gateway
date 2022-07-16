@extends('layouts.master')

@section('header')
<!-- Sweet Alert -->
<link type="text/css" href="{{asset('vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">

<!-- Notyf -->
<link type="text/css" href="{{asset('vendor/notyf/notyf.min.css')}}" rel="stylesheet">

<!-- Volt CSS -->
<link type="text/css" href="{{asset('css/volt.css')}}" rel="stylesheet">


@yield('header-custom')
@endsection

@section('body')

@component('components.sidebar')
<x-slot name="head">
    <x-sidebar.ProfileInfo src="{{asset('assets/img/team/profile-picture-3.jpg')}}" name="Administrator"
        nameButton="Sign Out" linkButton="#" />
</x-slot>
@endcomponent

<main class="content">

    @component('components.topbar')
    @endcomponent

    {{-- Success Alert --}}
    @if(session('success'))
    <x-alert type="success" msg="{{session('success')}}" />
    @endif

    {{-- Error Alert --}}
    @if(session('error'))
    <x-alert type="danger" msg="{{session('error')}}" />
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible show fade mt-2">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @yield('content')

    @component('components.setting')
    @endcomponent

    @component('components.footer')
    @endcomponent

</main>
@endsection

@section('footer')

<!-- Core -->
<script src="{{asset('vendor/@popperjs/core/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- Vendor JS -->
<script src="{{asset('vendor/onscreen/dist/on-screen.umd.min.js')}}"></script>

<!-- Slider -->
<script src="{{asset('vendor/nouislider/distribute/nouislider.min.js')}}"></script>

<!-- Smooth scroll -->
<script src="{{asset('vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')}}"></script>

<!-- Charts -->
<script src="{{asset('vendor/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset('vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>

<!-- Datepicker -->
<script src="{{asset('vendor/vanillajs-datepicker/dist/js/datepicker.min.js')}}"></script>

<!-- Sweet Alerts 2 -->
<script src="{{asset('vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>

<!-- Moment JS -->
<script src="{{asset('assets/js/moment.min.js')}}"></script>

<!-- Vanilla JS Datepicker -->
<script src="{{asset('vendor/vanillajs-datepicker/dist/js/datepicker.min.js')}}"></script>

<!-- Notyf -->
<script src="{{asset('vendor/notyf/notyf.min.js')}}"></script>

<!-- Simplebar -->
<script src="{{asset('vendor/simplebar/dist/simplebar.min.js')}}"></script>

<!-- Github buttons -->
<script async defer src="{{asset('assets/js/buttons.js')}}"></script>

<!-- Volt JS -->
<script src="{{asset('assets/js/volt.js')}}"></script>

<!-- FontAwesome -->
<script src="{{asset('assets/js/fontawesome.all.min.js')}}"></script>
<script src="{{asset('assets/js/fontawesome.regular.min.js')}}"></script>

@yield('footer-custom')
@endsection
