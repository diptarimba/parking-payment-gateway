<div class="form-group mb-2">
    <label class="col-form-label" class="form-label" for="{{$id ?? 'form'}}">{{$label}}</label>
    <input class="form-control" {{ isset($required) ? 'required' : '' }} id="{{$name ?? 'form'}}" type="{{ $type }}" id="{{$name}}"name="{{ $name }}"placeholder="{{$placeholder ?? ''}}" value="{{$value ?? ''}}">
  </div>
