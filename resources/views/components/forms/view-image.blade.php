<label class="col-form-label" for="{{$id}}">{{ $label }}</label>
<div class="card mb-2" style="width: 18rem;">
    {{-- <div class="card-title">
        <h5 class="card-title">{{ $label }}</h5>
    </div> --}}
    <div class="card-body">
        <img src="{{ $src }}" id="{{$id}}" class="card-img-top" alt="...">
        {{-- <h5 class="card-title">{{ $label }}</h5> --}}
    </div>
</div>
@push('footer-add')
<script src="{{asset('assets/js/imageReview.js')}}"></script>
@endpush
