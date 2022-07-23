@extends('layouts.page')

@section('tab-title', 'History')

@section('header-custom')

@endsection

@section('content')
<x-breadcrumbs
    category="History"
    href="{{route('history.index')}}"
    current="index"
/>
<x-cards.fullpage>
    <x-slot name="header">
        <x-cards.header title="History"/>
    </x-slot>
    <x-slot name="body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded">
                <thead>
                    <th>No</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Vehicle Type</th>
                    <th>Cost</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($parkingHistory as $each)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{Carbon\Carbon::parse($each->check_in)->format('d F Y H:i:s A')}}</td>
                            <td>{{Carbon\Carbon::parse($each->check_out)->format('d F Y H:i:s A') ?? 'Belum Check Out'}}</td>
                            <td>{{$each->parking_detail->vehicle->name}}</td>
                            <td>Rp. {{ number_format($each->parking_detail->payment_transaction->whereNotIn('status', ['Not Match'])->sortByDesc('id')->first()->amount, 0, ",", ".") }}</td>
                            <td><a target="_blank" href="{{route('history.detail', ['code' => $each->parking_detail->code])}}" class="btn btn-primary">History</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
</x-cards.single>
@endsection

@section('footer-custom')

@endsection
