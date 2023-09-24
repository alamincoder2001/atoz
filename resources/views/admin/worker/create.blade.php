@extends('layouts.backend_master')

@section('title', 'Create Worker')
@section('breadcrumb_title', 'Create Worker')
@section('breadcrumb_item', 'Create Worker')

@section('content')
    <Worker thana_id="{{Auth::guard('admin')->user()->thana_id}}" district_id="{{Auth::guard('admin')->user()->district_id}}" admin_id="{{Auth::guard('admin')->user()->id}}" role="{{Auth::guard('admin')->user()->role}}"></Worker>
@endsection
