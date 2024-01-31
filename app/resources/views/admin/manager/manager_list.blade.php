@extends('layouts.backend_master')

@push('admin_style')

@endpush

@section('title', 'Area Manageer List')
@section('breadcrumb_title', 'Area Manageer List')
@section('breadcrumb_item', 'Area Manageer List')

@section('content')
    <area-manager-list admin_id="{{Auth::guard('admin')->user()->id}}" role="{{Auth::guard('admin')->user()->role}}"></area-manager-list>
@endsection
