{{-- <x-breadcrumbs href="" current="" category=""/> --}}
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/">
                    <i class="fa-solid fa-house fa-fw"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{$href}}">{{$category}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$current}}</li>
        </ol>
    </nav>
</div>