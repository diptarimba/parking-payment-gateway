<div class="mb-2">
    <div  class="col-form-label">{{ $label }}</div>
    <select class="form-control" {{ $multiple }} data-placeholder="{{ $placeholder }}" name="{{ $name }}">
        @if(is_array($value))
        @foreach ($items as $id => $name)
            <option value="{{ $id }}" @if (isset($value[$id])) selected @endif>{{ $name }}</option>
        @endforeach
        @else
        @foreach ($items as $id => $name)
            <option value="{{ $id }}" @if (@$value == $id) selected @endif>{{ $name }}</option>
        @endforeach
        @endif
    </select>
</div>
