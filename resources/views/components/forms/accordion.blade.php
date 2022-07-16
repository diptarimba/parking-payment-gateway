<div class="accordion-item">
    <h2 class="accordion-header" id="{{ $uniqueIdHeading }}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $uniqueIdItem }}"
            aria-expanded="true" aria-controls="{{ $uniqueIdItem }}">
            {{ $header }}
        </button>
    </h2>
    <div class="accordion-collapse collapse" id="{{ $uniqueIdItem }}" aria-labelledby="{{ $uniqueIdHeading }}"
        data-bs-parent="#{{ $parentName }}">
        <div class="accordion-body pt-0">
            {{ $body }}
        </div>
    </div>
</div>
