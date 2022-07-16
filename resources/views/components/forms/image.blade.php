<div class="form-group">
    <label class="col-form-label">{{ $label }}</label>
    <input type="file" name="{{ $name }}" class="form-control" 
        {{ @$attributes['props']->multiple ? 'multiple' : '' }}
    >
</div>
