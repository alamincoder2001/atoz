@extends('layouts.backend_master')

@push('admin_style')
    <style>
        @media print
        {
            .no-print, .no-print *
            {
                display: none !important;
            }
        }



    </style>
@endpush


@section('title', 'Worker List')
@section('breadcrumb_title', 'Worker List')
@section('breadcrumb_item', 'Worker List')

@section('content')
    {{-- <h1>asdfsa</h1> --}}
    <worker-list admin_id="{{Auth::guard('admin')->user()->id}}" role="{{Auth::guard('admin')->user()->role}}"></worker-list>
@endsection
