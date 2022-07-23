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
            <table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec">
                <thead>
                    <th>No</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Vehicle Type</th>
                    <th>Cost</th>
                    <th>Action</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </x-slot>
</x-cards.single>
@endsection

@section('footer-custom')
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap5.min.js')}}"></script>
<script>
    $(document).ready(() => {
        var table = $('.datatables-target-exec').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('history.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', sortable: false, orderable: false,
                searchable: false},
            {data: 'check_in', name: 'check_in'},
            {data: 'check_out', name: 'check_out'},
            {data: 'vehicle', name: 'vehicle'},
            {data: 'cost', name: 'cost'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });
    })
</script>
@endsection
