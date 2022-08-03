<div class="mb-2 col-xl-4 col-sm-4 col-12">
    <div class="card card-outline card-primary mt-2 border-0">
        <div class="card-body">
            <div class="row d-block d-xl-flex align-items-center">
                <div
                    class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                    <div class="icon-shape icon-shape-secondary rounded me-4 me-sm-0">
                        <i class="{{$icon}}"></i>
                    </div>
                    <div class="d-sm-none">
                        <h2 class="fw-extrabold h5">{{$text}}</h2>
                        <h3 class="mb-1 {{$adder ?? ''}}">{{number_format($value, 0, ",", ".")}}</h3>
                    </div>
                </div>
                <div class="col-12 col-xl-7 px-xl-0">
                    <div class="d-none d-sm-block">
                        <h2 class="h6 text-gray-400 mb-0">{{$text}}</h2>
                        <h3 class="fw-extrabold mb-2 {{$adder ?? ''}}">{{number_format($value, 0, ",", ".")}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
