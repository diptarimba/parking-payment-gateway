{{--

<x-sidebarPHC icons="" title="" />

<x-sidebarPHC>

    <x-sidebarCFP>
    </x-sidebarCFP>

</x-sidebarPHC>

--}}

<li class="nav-item">
    <span class="nav-link  collapsed  d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
        data-bs-target="#{{$target}}">
        <span>
            <span class="sidebar-icon">
                <i class="{{ $icons }} me-2"></i>
            </span>
            <span class="sidebar-text">{{ $title }}</span>
        </span>
        <span class="link-arrow">
            <i class="fa-solid fa-angle-down me-2"></i>
        </span>
    </span>
    <div class="multi-level collapse" role="list" id="{{$target}}" aria-expanded="false">
        <ul class="flex-column nav">
            {{ $slot }}
        </ul>
    </div>
</li>
