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
                            clearTimeout(timer)
                            window.location.href = '{{route('history.index')}}';
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
                        checkout_type: 'checkout'
                    },
                    type: 'get',
                    success: function(data) { // check if available
                        // status.text('Waiting for Scanning!');
                        var tokenBayar = data.token
                        window.snap.pay(tokenBayar, {
                            onSuccess: function(result){
                                /* You may add your own implementation here */
                                alert("payment success!"); console.log(result);
                            },
                            onPending: function(result){
                                /* You may add your own implementation here */
                                alert("wating your payment!"); console.log(result);
                            },
                            onError: function(result){
                                /* You may add your own implementation here */
                                alert("payment failed!"); console.log(result);
                            },
                            onClose: function(){
                                /* You may add your own implementation here */
                                alert('you closed the popup without finishing the payment');
                            }
                        })
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
