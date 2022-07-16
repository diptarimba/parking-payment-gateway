{{--
<x-sidebar.FloatingButtonLeft href="../../pages/upgrade-to-pro.html" icons="" title="Upgrade to Pro" /> --}}
<li class="nav-item">
    <a href="{{ $href }}" class="btn btn-secondary d-flex align-items-center justify-content-center btn-upgrade-pro">
        <span class="sidebar-icon d-inline-flex align-items-center justify-content-center">
            <i class="{{ $icons }} me-2"></i>
        </span>
        <span>{{$title}}</span>
    </a>
</li>
