@extends('layouts.page')

@section('tab-title', 'Dashboard')

@section('header-custom')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="row mt-5">
    <span class="slot-name h3"><strong>Parking Place</strong></span>
    <x-cards.home text="Available Car" adder="slot-avail-car" value="0" icon="fa-solid fa-check-to-slot" />
    <x-cards.home text="Available Motocycle" adder="slot-avail-motor" value="0" icon="fa-solid fa-check-to-slot" />
    <x-cards.home text="Slot Used" adder="slot-used" value="0" icon="fa-solid fa-registered" />
</div>
<div class="row mt-3">
    <x-cards.home text="Your Total Parking" value="{{$totalParking}}" icon="fa-solid fa-square-parking" />
    <x-cards.home text="Your Total Location" value="{{$totalLocation}}" icon="fa-solid fa-location-dot" />
</div>
@endsection

@section('footer-custom')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            width: 'resolve'
        });
    });
</script>
<script>
    $(document).ready(() => {
        $('#cariLocation').on('input', function() {
			var userText = $(this).val();

			$("#datalistOptions").find("option").each(function() {
			if ($(this).val() == userText) {
                console.log($(this).val())
                $.ajax({
                    url: '{{route('home.index')}}',
                    dataType: 'json',
                    data: {
                        location_name: userText
                    },
                    type: 'get',
                    success: function(data) { // check if available
                        // console.log('cok', data.slot.name)
                        $('.slot-avail-motor').text(data.slot.parking_slot[0].slot - data.parking_location[0][1])
                        $('.slot-avail-car').text(data.slot.parking_slot[1].slot - data.parking_location[1][1])
                        $('.slot-used').text(data.parking_location[0][1] + data.parking_location[1][1]);
                        $('.slot-name').text(data.slot.name)
                    },
                    error: function() { // error logging
                        console.log('Error!');
                    }
                });
			}
			})
		})
    })
</script>
@endsection
