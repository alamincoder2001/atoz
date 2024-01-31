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


@section('title', 'Worker Due List')
@section('breadcrumb_title', 'Worker Due List')
@section('breadcrumb_item', 'Worker Due List')

@section('content')
    <workerdue-list admin_id="{{Auth::guard('admin')->user()->id}}" role="{{Auth::guard('admin')->user()->role}}"></workerdue-list>
@endsection
