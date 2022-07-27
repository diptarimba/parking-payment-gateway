@extends('layouts.page')

@section('tab-title', 'Checkout')

@section('header-custom')
<script type="text/javascript"
	      src="https://app.sandbox.midtrans.com/snap/snap.js"
	      data-client-key="{{config('midtrans.client_key')}}"></script>
@endsection

@section('content')
<x-breadcrumbs
    category="Checkout"
    href="{{route('checkout.index')}}"
    current="index"
/>
<x-cards.single>
    <x-slot name="header">
        <x-cards.header title="Ready Check Out"/>
    </x-slot>
    <x-slot name="body">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>Check In</th>
                    <td>{{$check_in}}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>{{$parking->parking_detail->first()->parking_location->name}}</td>
                </tr>
                <tr>
                    <th>Type Vehicle</th>
                    <td>{{$parking->parking_detail->first()->vehicle->name}}</td>
                </tr>
                <tr>
                    <th>Cost</th>
                    <td><span class="dynamic-cost"></span></td>
                </tr>
            </tbody>
        </table>
        <button id="pay-button" class="btn btn-success text-white mx-1 my-1">Bayar & Checkout</button>
    </x-slot>
</x-cards.single>
<!-- Modal -->
<div class="modal fade" id="qrcode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">QR Code</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="text-center">
            <img id="img-qrcode" style="max-width: 200px" src="" alt="">
        </div>
        </div>
        <div class="modal-footer">
          <a href="" class="btn gopay-pay btn-success">Pay Gopay!</a>
          <a href="path_to_file" class="btn qris-download btn-warning" download="qrcode">Download</a>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Confirm</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('footer-custom')
<script>
    $(document).ready(() => {

        function refresh() {
            var status = $('.dynamic-cost')
            $.ajax({
                    url: '{{route('checkout.index')}}',
                    dataType: 'json',
                    type: 'get',
                    success: function(data) { // check if available
                        // status.text('Waiting for Scanning!');
                        if (typeof data.cost !== 'undefined') { // get and check data value
                            var cost = new Intl.NumberFormat().format(data.cost)
                            console.log(cost)
                            status.text('Rp. ' + cost);
                        }

                        if (typeof data.result !== 'undefined') { // get and check data value
                            if(data.result === 'paid'){
                                clearTimeout(timer)
                                window.location.href = '{{route('history.index')}}';
                            }
                        }
                    },
                    error: function() { // error logging
                        console.log('Error!');
                    }
                });

            // make Ajax call here, inside the callback call:
            timer = setTimeout(refresh, 10000);
            // ...
        }

        // initial call, or just call refresh directly
        var timer = setTimeout(refresh, 1000);

	      // For example trigger on button clicked, or any time you need
	      var payButton = document.getElementById('pay-button');
	      payButton.addEventListener('click', function () {
            // Update Web Check
            $.ajax({
                    url: '{{route('checkout.index')}}',
                    dataType: 'json',
                    data: {
                        parking_type: 'checkout'
                    },
                    type: 'get',
                    success: function(data) { // check if available
                        // status.text('Waiting for Scanning!');
                        console.log(data);
                        if(data.result === 'created')
                        {
                            window.localStorage.setItem('qr-code', data.data.qr_code );
                            window.localStorage.setItem('gopay', data.data.gopay );
                        }

                        $('#img-qrcode').attr('src', window.localStorage.getItem('qr-code'))
                        $('.qris-download').attr('href', window.localStorage.getItem('qr-code'))
                        $('.gopay-pay').attr('href', window.localStorage.getItem('gopay'))
                        $('#qrcode').modal('toggle');
                    },
                    error: function() { // error logging
                        console.log('Error!');
                    }
                });
	        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token

	      });
    })
</script>
@endsection
