@extends('layouts.page')

@section('tab-title', 'Checkin')

@section('header-custom')

@endsection

@section('content')
    <x-breadcrumbs category="Checkin" href="{{ route('checkin.index') }}" current="index" />
    <x-cards.single>
        <x-slot name="header">
            <x-cards.header title="Ready Check In" />
        </x-slot>
        <x-slot name="body">
            <div class="text-center">
                {!! QrCode::size(200)->generate(json_encode(['user_id' => $user, 'code' => $code, 'type' => 'checkin'])) !!}
                <p class="notify">Waiting for scanning</p>
            </div>
        </x-slot>
    </x-cards.single>
@endsection

@section('footer-custom')
    <script>
        $(document).ready(() => {

            function refresh() {
                var status = $('.notify')
                $.ajax({
                        url: '{{route('checkin.index')}}',
                        dataType: 'json',
                        data: {
                            code: '{{$code}}'
                        },
                        type: 'get',
                        success: function(data) { // check if available
                            // status.text('Waiting for Scanning!');
                            console.log(data.result)
                            if (data.result === 'exist') { // get and check data value
                                clearTimeout(timer)
                                status.text('Scanned, The gates will open!');
                                window.location.href = '{{route('checkout.index')}}';
                            }
                        },
                        error: function() { // error logging
                            console.log('Error!');
                        }
                    });

                // make Ajax call here, inside the callback call:
                timer = setTimeout(refresh, 2000);
                // ...
            }

            // initial call, or just call refresh directly
            var timer = setTimeout(refresh, 2000);

        })
    </script>
@endsection
