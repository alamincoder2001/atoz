@extends("layouts.backend_master")

@section("title", "Admin Dashboard")
@section("breadcrumb_title", "Admin Dashboard")
@section("breadcrumb_item", "Admin Dashboard")

@section("content")
    <Dashboard admin_id="{{Auth::guard('admin')->user()->id}}" role="{{Auth::guard('admin')->user()->role}}"></Dashboard>
@endsection