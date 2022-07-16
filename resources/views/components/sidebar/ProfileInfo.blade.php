{{--
<x-sidebar.ProfileInfo src="../../assets/img/team/profile-picture-3.jpg" name="Jane" nameButton="Sign Out"
    linkButton="../../pages/examples/sign-in.html" /> --}}
<div class="d-flex align-items-center">
    <div class="avatar-lg me-4">
        <img src="{{$src}}" class="card-img-top rounded-circle border-white" alt="Bonnie Green">
    </div>
    <div class="d-block">
        <h2 class="h5 mb-3">Hi, {{$name}}</h2>
        <a href="{{$linkButton}}" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
            <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                </path>
            </svg>
            {{$nameButton}}
        </a>
    </div>
</div>
