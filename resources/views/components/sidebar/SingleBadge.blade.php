{{-- <x-sidebarS icons="" title="" href="" badge=""> --}}

    <li class="nav-item">
        <a href="{{$href}}" class="nav-link d-flex justify-content-between">
            <span>
                <span class="sidebar-icon">
                    <i class="{{ $icons }} me-2"></i>
                </span>
                <span class="sidebar-text">{{$title}}</span>
            </span>
            <span>
                <span class="badge badge-sm bg-secondary ms-1 text-gray-800">{{ $badge }}</span>
            </span>
        </a>
    </li>
