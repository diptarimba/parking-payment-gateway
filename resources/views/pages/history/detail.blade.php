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
        <x-cards.header title="Checkout"/>
    </x-slot>
    <x-slot name="body">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>Check In</th>
                    <td>{{Carbon\Carbon::parse($parkingDetail->check_in)->format('d F Y H:i:s A')}}</td>
                </tr>
                <tr>
                    <th>Check Out</th>
                    <td>{{Carbon\Carbon::parse($parkingDetail->check_out)->format('d F Y H:i:s A')}}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>{{$parkingDetail->parking_detail->first()->parking_location->name}}</td>
                </tr>
                <tr>
                    <th>Type Vehicle</th>
                    <td>{{$parkingDetail->parking_detail->first()->vehicle->name}}</td>
                </tr>
                <tr>
                    <th>Cost</th>
                    <td>Rp. {{number_format($cost, 0, ",", ".")}}</td>
                </tr>
                <tr>
                    <th>Transaction Time</th>
                    <td>{{Carbon\Carbon::parse($transactionTime)->format('d F Y H:i:s A')}}</td>
                </tr>
                <tr>
                    <th>Transaction Status</th>
                    <td>{{$transactionStatus}}</td>
                </tr>
            </tbody>
        </table>
    </x-slot>
</x-cards.single>
@endsection

@section('footer-custom')

@endsection
