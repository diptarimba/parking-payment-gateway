@push('header-add')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
@endpush
<div>
    <div class="form-group">
        <label for="">Location</label>
        <div id="map" style="height: 300px; z-index: 1"></div>
        <div class="row">
            <div class="col-6">
                <x-forms.text id="lat-{{ $identifier }}-input" oninput="onInput{{ $identifier }}Maps(event)" value="{{ $lat }}" name="{{ $latName }}" placeholder="Latitude" label=""></x-forms.text>
            </div>
            <div class="col-6">
                <x-forms.text id="lng-{{ $identifier }}-input" oninput="onInput{{ $identifier }}Maps(event)" value="{{ $lng }}" name="{{ $lngName }}" placeholder="Longitude" label=""></x-forms.text>
            </div>
        </div>
    </div>
</div>

@push('footer-add')
<script>
    var map{{ $identifier }} = L.map('map').setView([{{ $lat }}, {{ $lng }}], 15).on('click', onClick{{ $identifier }}Maps).on('moveend', onMove{{ $identifier }}Maps)
    var marker{{ $identifier }} = L.marker([{{ $lat }}, {{ $lng }}]).addTo(map{{ $identifier }});

    function onInput{{ $identifier }}Maps(event) {
        let latLng = L.latLng(
            $("#lat-{{ $identifier }}-input").val(),
            $("#lng-{{ $identifier }}-input").val()
        )
        setView{{ $identifier }}Maps(latLng)
    }

    function onClick{{ $identifier }}Maps(event) {
        setView{{ $identifier }}Maps(event.latlng)
    }

    function setView{{ $identifier }}Maps(latLng) {
        map{{ $identifier }}.setView(latLng)
        marker{{ $identifier }}.setLatLng(latLng)
    }

    function onMove{{ $identifier }}Maps(event) {
        $("#lat-{{ $identifier }}-input").val(map{{ $identifier }}.getCenter().lat)
        $("#lng-{{ $identifier }}-input").val(map{{ $identifier }}.getCenter().lng)
    }

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '',
        maxZoom: 18,
        tileSize: 256,
    }).addTo(map{{ $identifier }});
</script>
@endpush
