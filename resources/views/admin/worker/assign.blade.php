@extends('layouts.backend_master')

@section('title', 'Assign Service Worker List')
@section('breadcrumb_title', 'Assign Service Worker List')
@section('breadcrumb_item', 'Assign Service Worker List')

@section('content')
<assign-worker admin_id="{{Auth::guard('admin')->user()->id}}" role="{{Auth::guard('admin')->user()->role}}"></assign-worker>
@endsection