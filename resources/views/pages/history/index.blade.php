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
<x-cards.single>
    <x-slot name="header">
        <x-cards.header title="History"/>
    </x-slot>
    <x-slot name="body">
    </x-slot>
</x-cards.single>
@endsection

@section('footer-custom')
    
@endsection