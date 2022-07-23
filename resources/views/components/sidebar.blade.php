{{-- <x-sidebarPHC>

</x-sidebarPHC> --}}
<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="../../index.html">
        <img class="navbar-brand-dark" src="{{asset('assets/img/brand/light.svg')}}" alt="Volt logo" /> <img
            class="navbar-brand-light" src="{{asset('assets/img/brand/dark.svg')}}" alt="Volt logo" />
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            {{$head}}
            <x-sidebar.Toolbar />
        </div>
        <ul class="nav flex-column pt-3 pt-md-0">
            {{ $slot }}
            <x-sidebar.HeaderLogo title="Smart Parking" href="#" src="{{asset('assets/img/brand/light.svg')}}" />
            <x-sidebar.sparator />
            <x-sidebar.Single icons="fa-solid fa-house-user" title="Home" href="{{route('home.index')}}" />
            <x-sidebar.Single icons="fa-solid fa-right-to-bracket fa-fw" title="Checkin" href="{{route('checkin.index')}}" />
            <x-sidebar.Single icons="fa-solid fa-arrow-right-from-bracket fa-fw" title="Checkout" href="{{route('checkout.index')}}" />
            <x-sidebar.Single icons="fa-solid fa-clock-rotate-left fa-fw" title="History" href="{{route('history.index')}}" />
            {{-- <x-sidebar.sparator /> --}}
            {{-- <x-sidebar.SingleBadge icons="fa-solid fa-users fa-fw" title="Kanban" href="#" badge="Pro" />
            <x-sidebar.ParentHaveChild icons="fa-solid fa-table fa-fw" title="Tables" target="target1">
                <x-sidebar.ChildHaveParent href="" name="Bootstrap Tables" />
            </x-sidebar.ParentHaveChild>
            <x-sidebar.ParentHaveChild icons="fa-solid fa-file fa-fw" title="Destination" target="targetDestionation">
                <x-sidebar.ChildHaveParent href="/" name="Destination Category" />
                <x-sidebar.ChildHaveParent href="" name="Destination Image" />
                <x-sidebar.ChildHaveParent href="/" name="Destination" />
            </x-sidebar.ParentHaveChild>
            <x-sidebar.ParentHaveChild icons="fa-brands fa-bitbucket fa-fw" title="User" target="TargetUser">
                <x-sidebar.ChildHaveParent href="" name="User" />
                <x-sidebar.ChildHaveParent href="" name="User Activity" />
                <x-sidebar.ChildHaveParent href="" name="User Activity Details" />
            </x-sidebar.ParentHaveChild>
            <x-sidebar.sparator />
            <x-sidebar.SingleBadge icons="fa-solid fa-book fa-fw" title="Documentation" href="#" badge="v1.4" /> --}}
            {{-- <x-sidebar.FooterLogo href="" title="Themesburg" src="{{asset('assets/img/themesberg.svg')}}" /> --}}
        </ul>
    </div>
</nav>
